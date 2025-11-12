<?php
namespace MARKETZONE\MAIN; 
use MARKETZONE\DB\DataBase;
require_once __DIR__ . '/DataBase.php';

class Products extends DataBase {
    private $response; 

    // constructor de la clase
    public function __construct($db, $user='root', $pass='straykids8_') {
        $this->response = [];
        parent::__construct($db, $user, $pass); 
    }

    // devuelve la respuesta en json
    public function getResponse() {
        return json_encode($this->response, JSON_PRETTY_PRINT);
    }

    // agrega un producto nuevo
    public function add($product) {
        $this->response = [
            'status'  => 'error',
            'message' => 'ya existe un producto con ese nombre'
        ];

        $jsonOBJ = json_decode(json_encode($product));

        if(!empty($jsonOBJ->nombre)) {
            $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}' AND eliminado = 0";
            $result = $this->conexion->query($sql);
            
            if ($result->num_rows == 0) {
                $this->conexion->set_charset("utf8");
                $sql = "INSERT INTO productos VALUES (null, '{$jsonOBJ->nombre}', '{$jsonOBJ->marca}', '{$jsonOBJ->modelo}', {$jsonOBJ->precio}, '{$jsonOBJ->detalles}', {$jsonOBJ->unidades}, '{$jsonOBJ->imagen}', 0)";
                if($this->conexion->query($sql)) {
                    $this->response['status'] =  "success";
                    $this->response['message'] =  "producto agregado";
                } else {
                    $this->response['message'] = "error: no se ejecuto $sql. " . mysqli_error($this->conexion);
                }
            }

            $result->free();
            $this->conexion->close();
        }
    }

    // elimina un producto por id
    public function delete($id) {
        $this->response = [
            'status'  => 'error',
            'message' => 'la consulta fallo'
        ];

        if(!empty($id)) {
            $sql = "UPDATE productos SET eliminado = 1 WHERE id = {$id}";
            if ($this->conexion->query($sql)) {
                $this->response['status'] = "success";
                $this->response['message'] = "producto eliminado";
            } else {
                $this->response['message'] = "error: no se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        } 
    }

    // edita un producto existente
    public function edit($product) {
        $this->response = [
            'status'  => 'error',
            'message' => 'la consulta fallo'
        ];
        $jsonOBJ = json_decode(json_encode($product));

        if(!empty($jsonOBJ->id)) {
            $sql  = "UPDATE productos SET nombre='{$jsonOBJ->nombre}', marca='{$jsonOBJ->marca}',";
            $sql .= "modelo='{$jsonOBJ->modelo}', precio={$jsonOBJ->precio}, detalles='{$jsonOBJ->detalles}',"; 
            $sql .= "unidades={$jsonOBJ->unidades}, imagen='{$jsonOBJ->imagen}' WHERE id={$jsonOBJ->id}";
            $this->conexion->set_charset("utf8");
            if ($this->conexion->query($sql)) {
                $this->response['status'] = "success";
                $this->response['message'] = "producto actualizado";
            } else {
                $this->response['message'] = "error: no se ejecuto $sql. " . mysqli_error($this->conexion);
            }
            $this->conexion->close();
        } 
    }

    // lista todos los productos no eliminados
    public function list() {
        $sql = "SELECT * FROM productos WHERE eliminado = 0";
        if ($result = $this->conexion->query($sql)) {
            $rows = $result->fetch_all(MYSQLI_ASSOC);

            if(!is_null($rows)) {
                foreach($rows as $num => $row) {
                    foreach($row as $key => $value) {
                        $this->response[$num][$key] = utf8_encode($value);
                    }
                }
            }

            $result->free();
        } else {
            die('query error: '.mysqli_error($this->conexion));
        }
        $this->conexion->close();
    }

    // busca productos por id, nombre, marca o detalles
    public function search($search) {
        if(!empty($search)) {
            $sql = "SELECT * FROM productos WHERE (id = '{$search}' OR nombre LIKE '%{$search}%' OR marca LIKE '%{$search}%' OR detalles LIKE '%{$search}%') AND eliminado = 0";
            if ($result = $this->conexion->query($sql)) {
                $rows = $result->fetch_all(MYSQLI_ASSOC);

                if(!is_null($rows)) {
                    foreach($rows as $num => $row) {
                        foreach($row as $key => $value) {
                            $this->response[$num][$key] = utf8_encode($value);
                        }
                    }
                }

                $result->free();
            } else {
                die('query error: '.mysqli_error($this->conexion));
            }
        }
    }

    // obtiene un producto por id
    public function single($id) {
        if(!empty($id)) {
            $sql = "SELECT * FROM productos WHERE id = {$id}";
            if ($result = $this->conexion->query($sql)) {
                $row = $result->fetch_assoc();

                if(!is_null($row)) {
                    foreach($row as $key => $value) {
                        $this->response[$key] = utf8_encode($value);
                    }
                }
                $result->free();
            } else {
                die('query error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }
    }

    // obtiene un producto por nombre
    public function singleByName($name) {
        if(!empty($name)) {
            $sql = "SELECT * FROM productos WHERE nombre LIKE '{$name}' AND eliminado = 0";
            if ($result = $this->conexion->query($sql)) {
                $row = $result->fetch_assoc();

                if(!is_null($row)) {
                    foreach($row as $key => $value) {
                        $this->response[$key] = utf8_encode($value);
                    }
                }
                $result->free();
            } else {
                die('query error: '.mysqli_error($this->conexion));
            }
            $this->conexion->close();
        }        
    }
}
?>
