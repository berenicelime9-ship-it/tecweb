<?php
include_once __DIR__.'/database.php';

// SE OBTIENE LA INFORMACIÓN DEL PRODUCTO ENVIADA POR EL CLIENTE
$producto = file_get_contents('php://input');

if (!empty($producto)) {
    // SE TRANSFORMA EL STRING JSON A OBJETO PHP
    $jsonOBJ = json_decode($producto);

    // VALIDAR QUE TODOS LOS CAMPOS EXISTAN
    $campos = ['nombre', 'marca', 'modelo', 'precio', 'detalles', 'unidades', 'imagen'];
    foreach ($campos as $campo) {
        if (!isset($jsonOBJ->$campo)) {
            echo "[SERVIDOR] Error: Falta el campo '$campo'.";
            exit;
        }
    }

    // ESCAPAR DATOS PARA EVITAR INYECCIÓN SQL
    $nombre   = $conexion->real_escape_string($jsonOBJ->nombre);
    $marca    = $conexion->real_escape_string($jsonOBJ->marca);
    $modelo   = $conexion->real_escape_string($jsonOBJ->modelo);
    $precio   = floatval($jsonOBJ->precio);
    $detalles = $conexion->real_escape_string($jsonOBJ->detalles);
    $unidades = intval($jsonOBJ->unidades);
    $imagen   = $conexion->real_escape_string($jsonOBJ->imagen);

    // VALIDAR VALORES NUMÉRICOS
    if ($precio < 0 || $unidades < 0) {
        echo "[SERVIDOR] Error: Precio y unidades deben ser valores positivos.";
        exit;
    }

    // VERIFICAR SI YA EXISTE UN PRODUCTO CON EL MISMO NOMBRE Y eliminado = 0
    $queryCheck = "SELECT id FROM productos WHERE nombre = '$nombre' AND eliminado = 0";
    $resultCheck = $conexion->query($queryCheck);

    if ($resultCheck && $resultCheck->num_rows > 0) {
        echo "[SERVIDOR] Error: El producto '$nombre' ya existe en la base de datos.";
    } else {
        // INSERTAR EL PRODUCTO
        $queryInsert = "
            INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen, eliminado)
            VALUES ('$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen', 0)
        ";

        if ($conexion->query($queryInsert)) {
            echo "[SERVIDOR] Éxito: Producto '$nombre' agregado correctamente.";
        } else {
            echo "[SERVIDOR] Error al insertar el producto: " . $conexion->error;
        }
    }

    $conexion->close();
} else {
    echo "[SERVIDOR] Error: No se recibió información del producto.";
}
?>
