<?php

    // include_once __DIR__.'/database.php';

    // $producto = file_get_contents('php://input');
    // $data = array(
    //     'status'  => 'error',
    //     'message' => 'No se pudo editar el producto'
    // );



    // if(!empty($producto)) {

    //     $jsonOBJ = json_decode($producto);
    //     $nombre   = mysqli_real_escape_string($conexion, $jsonOBJ->nombre);
    //     $marca    = mysqli_real_escape_string($conexion, $jsonOBJ->marca);
    //     $modelo   = mysqli_real_escape_string($conexion, $jsonOBJ->modelo);
    //     $precio   = mysqli_real_escape_string($conexion, $jsonOBJ->precio);
    //     $detalles = mysqli_real_escape_string($conexion, $jsonOBJ->detalles);
    //     $unidades = mysqli_real_escape_string($conexion, $jsonOBJ->unidades);
    //     $imagen   = mysqli_real_escape_string($conexion, $jsonOBJ->imagen);

    //     $sql = "SELECT * FROM productos WHERE nombre = '{$jsonOBJ->nombre}'";

    //     if($consulta = mysqli_query($conexion, $sql)) {
    //         $row = $consulta->fetch_assoc();
            
    //         $cambios = [];

    //         if ($nombre !== $row['nombre'])      $cambios[] = "nombre='$nombre'";
    //         if ($marca !== $row['marca'])        $cambios[] = "marca='$marca'";
    //         if ($modelo !== $row['modelo'])      $cambios[] = "modelo='$modelo'";
    //         if ($precio != $row['precio'])       $cambios[] = "precio=$precio";
    //         if ($detalles !== $row['detalles'])  $cambios[] = "detalles='$detalles'";
    //         if ($unidades != $row['unidades'])   $cambios[] = "unidades=$unidades";
    //         if ($imagen !== $row['imagen'])      $cambios[] = "imagen='$imagen'";
    //     }

    //    if(count($cambios) > 0) {
    //     $sql = "UPDATE productos SET " .implode(", ", $cambios) . " WHERE nombre='{$jsonOBJ->nombre}'"; // Se agregan todos los cambios

    //     if(mysqli_query($conexion, $sql)) {
    //         $data['status'] =  "success";
    //         $data['message'] =  "Producto modificado";
    //     }
    //     else
    //         $data['message'] = "ERROR: No se ejecuto $sql. " . mysqli_error($conexion);
    //     } else
    //         $data['message'] =  "No se encontraron cambios";



    //     echo json_encode($data, JSON_PRETTY_PRINT);

    //     $consulta->free();
    //     // Cierra la conexion
    //     $conexion->close();
    // }

    use MARKETZONE\MAIN\Products as Product; 
    include_once __DIR__ . '/myapi/Products.php';
    $product = new Product('marketzone');
    $product->edit($_POST);
    echo $product->getResponse();

?>