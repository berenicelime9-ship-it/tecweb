<?php
header("Content-Type: text/html; charset=utf-8");

// Conexión a la base de datos
$link = mysqli_connect("localhost", "root", "straykids8_", "marketzone");

// Verificar conexión
if (!$link) {
    die("ERROR: No se pudo conectar con la DB. " . mysqli_connect_error());
}

// Validar que los datos necesarios existan
if (
    isset($_POST['id'], $_POST['nombre'], $_POST['marca'], $_POST['modelo'], $_POST['precio'], $_POST['unidades'], $_POST['detalles'], $_POST['imagen'])
) {
    $id       = (int)$_POST['id'];
    $nombre   = mysqli_real_escape_string($link, $_POST['nombre']);
    $marca    = mysqli_real_escape_string($link, $_POST['marca']);
    $modelo   = mysqli_real_escape_string($link, $_POST['modelo']);
    $precio   = (float)$_POST['precio'];
    $unidades = (int)$_POST['unidades'];
    $detalles = mysqli_real_escape_string($link, $_POST['detalles']);
    $imagen   = mysqli_real_escape_string($link, $_POST['imagen']);

    $sql = "UPDATE productos SET 
        nombre='$nombre', 
        marca='$marca', 
        modelo='$modelo', 
        precio=$precio, 
        unidades=$unidades, 
        detalles='$detalles', 
        imagen='$imagen' 
        WHERE id=$id";

    if (mysqli_query($link, $sql)) {
        echo "<p>Producto actualizado correctamente.</p>";
        echo "<p><a href='get_productos_vigentes_v2.php'>Volver a productos vigentes</a></p>";
    } else {
        echo "ERROR: No se ejecutó la actualización. " . mysqli_error($link);
    }

} else {
    echo "ERROR: Faltan datos obligatorios para actualizar el producto.";
}

// Cerrar conexión
mysqli_close($link);
?>
