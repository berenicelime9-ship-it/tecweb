<?php

    include_once __DIR__.'/database.php';

    if(isset($_POST['id'])) {
        $id = mysqli_real_escape_string($conexion, $_POST['id']);

        $sql = "SELECT * from productos WHERE id = {$id}";
        $result = mysqli_query($conexion, $sql);
        
        if(!$result) {
            die('Query Failed'. mysqli_error($conexion));
        }

        $data = array();
        // while($row = mysqli_fetch_array($result)) {
        //     $data[] = array(
        //         'id' => $row['id'],
        //         'nombre' => $row['nombre'],
        //         'precio' => $row['precio'],
        //         'unidades' => $row['unidades'],
        //         'marca' => $row['marca'],
        //         'modelo' => $row['modelo'],
        //         'descripcion' => $row['descripcion'],
        //         'imagen' => $row['imagen'],
        //     );
        // }

        $row = mysqli_fetch_assoc($result);
        echo json_encode($row, JSON_PRETTY_PRINT);
    }

?>