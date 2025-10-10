<?php
header("Content-Type: text/html; charset=UTF-8");

$nombre   = $_POST['name'] ?? '';
$marca    = $_POST['brand'] ?? '';
$modelo   = $_POST['model'] ?? '';
$precio   = $_POST['price'] ?? 0;
$detalles = $_POST['details'] ?? '';
$unidades = $_POST['units'] ?? 0;
$imagen   = $_POST['image'] ?? '';

/* Validar campos obligatorios */
if (empty($nombre) || empty($marca) || empty($modelo)) {
    die("<h3>Error: Los campos nombre, marca y modelo son obligatorios.</h3>");
}

/* Conexión a la base de datos */
@$link = new mysqli('localhost', 'root', 'straykids8_', 'marketzone');

if ($link->connect_errno) {
    die("<h3>Error de conexión: " . $link->connect_error . "</h3>");
}

/* Escapar valores para evitar problemas con comillas o caracteres especiales */
$nombre   = $link->real_escape_string($nombre);
$marca    = $link->real_escape_string($marca);
$modelo   = $link->real_escape_string($modelo);
$detalles = $link->real_escape_string($detalles);
$imagen   = $link->real_escape_string($imagen);

/* Asegurar que los valores numéricos sean válidos */
$precio   = is_numeric($precio) ? $precio : 0;
$unidades = is_numeric($unidades) ? $unidades : 0;

/* Verificar si ya existe un producto con el mismo nombre y marca */
$sql_check = "SELECT id FROM productos 
              WHERE nombre = '$nombre' 
              AND marca = '$marca'";

$result = $link->query($sql_check);

if ($result && $result->num_rows > 0) {
    echo "<h2>Error:</h2>";
    echo "<p>Ya existe un producto con el mismo nombre y marca en la base de datos.</p>";
    echo "<p><strong>Nombre:</strong> $nombre<br>";
    echo "<strong>Marca:</strong> $marca</p>";
    $link->close();
    exit;
}

/* Insertar nuevo producto */
$sql_insert = "INSERT INTO productos (nombre, marca, modelo, precio, detalles, unidades, imagen)
               VALUES ('$nombre', '$marca', '$modelo', $precio, '$detalles', $unidades, '$imagen')";

if ($link->query($sql_insert)) {
    echo "<h2>Producto insertado correctamente</h2>";
    echo "<ul>";
    echo "<li><strong>ID:</strong> " . $link->insert_id . "</li>";
    echo "<li><strong>Nombre:</strong> $nombre</li>";
    echo "<li><strong>Marca:</strong> $marca</li>";
    echo "<li><strong>Modelo:</strong> $modelo</li>";
    echo "<li><strong>Precio:</strong> $precio</li>";
    echo "<li><strong>Detalles:</strong> $detalles</li>";
    echo "<li><strong>Unidades:</strong> $unidades</li>";
    echo "<li><strong>Imagen:</strong> $imagen</li>";
    echo "</ul>";
} else {
    echo "<h3>Error al insertar el producto: " . $link->error . "</h3>";
}

$link->close();
?>
