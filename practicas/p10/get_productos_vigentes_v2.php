<?php
header("Content-Type: application/xhtml+xml; charset=utf-8");

$productos = [];
$mensaje_error = '';
$conexion_valida = true;

// Conexión a la base de datos
@$link = new mysqli('localhost', 'root', 'straykids8_', 'marketzone');
if ($link->connect_errno) {
    $conexion_valida = false;
    $mensaje_error = 'Falló la conexión: ' . $link->connect_error;
} else {
    // Consulta: solo productos vigentes (no eliminados)
    $sql = "SELECT * FROM productos WHERE eliminado = 0";
    if ($result = $link->query($sql)) {
        $productos = $result->fetch_all(MYSQLI_ASSOC);
        $result->free();
    } else {
        $conexion_valida = false;
        $mensaje_error = 'Error en la consulta: ' . $link->error;
    }
    $link->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <title>Productos Vigentes</title>
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; }
        table { margin-top: 20px; width: auto; }
        img { width: 80px; border-radius: 5px; }
        input[type="button"], .btn-simple {
            padding: 4px 10px;
            border: 1px solid #555;
            border-radius: 4px;
            background: none;
            cursor: pointer;
            color: black;
            text-decoration: none;
        }
        input[type="button"]:hover, .btn-simple:hover {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
    <h3>Productos Vigentes</h3>

    <?php if(!$conexion_valida): ?>
        <p style="color:red;"><?= $mensaje_error ?></p>
    <?php elseif(!empty($productos)): ?>
        <table class="table table-bordered table-striped">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                    <th>Detalles</th>
                    <th>Imagen</th>
                    <th>Modificar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $prod): ?>
                    <tr>
                        <td><?= $prod['id'] ?></td>
                        <td><?= htmlspecialchars($prod['nombre']) ?></td>
                        <td><?= htmlspecialchars($prod['marca']) ?></td>
                        <td><?= htmlspecialchars($prod['modelo']) ?></td>
                        <td>$<?= number_format($prod['precio'], 2) ?></td>
                        <td><?= $prod['unidades'] ?></td>
                        <td><?= htmlspecialchars(utf8_encode($prod['detalles'])) ?></td>
                        <td>
                            <img src="<?= !empty($prod['imagen']) ? $prod['imagen'] : 'img/default.png' ?>"
                                 alt="Imagen" />
                        </td>
                        <td>
                            <a href="formulario_productos_v2.html?id=<?= $prod['id'] ?>" class="btn-simple">Modificar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay productos registrados en la base de datos.</p>
    <?php endif; ?>
</body>
</html>
