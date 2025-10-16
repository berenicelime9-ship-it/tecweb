<?php
    include_once __DIR__.'/database.php';

    // Arreglo de respuesta
    $data = array();

    // Se verifica que se haya recibido un término de búsqueda
    if (isset($_POST['id'])) {
        $busqueda = $_POST['id'];

        // Se escapa la cadena para evitar inyección SQL
        $busqueda_segura = $conexion->real_escape_string($busqueda);

        // Query flexible: busca por coincidencia parcial en id, nombre, marca o detalles
        $query = "
            SELECT * FROM productos 
            WHERE id LIKE '%{$busqueda_segura}%'
            OR nombre LIKE '%{$busqueda_segura}%'
            OR marca LIKE '%{$busqueda_segura}%'
            OR detalles LIKE '%{$busqueda_segura}%'
        ";

        if ($result = $conexion->query($query)) {
            // Se obtienen todos los resultados
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                // Codificar a UTF-8 y agregar al arreglo de respuesta
                $producto = array();
                foreach ($row as $key => $value) {
                    $producto[$key] = utf8_encode($value);
                }
                $data[] = $producto;
            }
            $result->free();
        } else {
            die('Query Error: '.mysqli_error($conexion));
        }

        $conexion->close();
    }

    // Se hace la conversión de array a JSON
    echo json_encode($data, JSON_PRETTY_PRINT);
?>