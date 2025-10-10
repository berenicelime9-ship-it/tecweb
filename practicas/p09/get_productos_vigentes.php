<?php
header("Content-Type: application/xhtml+xml; charset=utf-8"); 

$tope_valido = true;
$mensaje_error = '';

if(isset($_GET['tope'])) {
    $tope = $_GET['tope'];

    // Validar que tope sea un número entero positivo
    if(!ctype_digit($tope) || intval($tope) < 0) {
        $tope_valido = false;
        $mensaje_error = 'El parámetro "tope" debe ser un número entero positivo.';
    }
} else {
    $tope_valido = false;
    $mensaje_error = 'Parámetro "tope" no detectado...';
}

$productos = array();
if($tope_valido) {
    @$link = new mysqli('localhost', 'root', 'straykids8_', 'marketzone');
    if ($link->connect_errno) {
        $tope_valido = false;
        $mensaje_error = 'Falló la conexión: '.$link->connect_error;
    } else {
        // Ajuste: traer solo los productos "no eliminados"
        $sql = "SELECT * FROM productos WHERE unidades <= $tope AND eliminado = 0";
        if ($result = $link->query($sql)) {
            $productos = $result->fetch_all(MYSQLI_ASSOC);
            $result->free();
        }
        $link->close();
    }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN"
    "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <title>Productos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
</head>
<body>
    <h3>Productos con unidades</h3>

    <?php if(!$tope_valido) : ?>
        <p style="color:red;"><?= $mensaje_error ?></p>
    <?php elseif(!empty($productos)) : ?>
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Marca</th>
                    <th>Modelo</th>
                    <th>Precio</th>
                    <th>Unidades</th>
                    <th>Detalles</th>
                    <th>Imagen</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($productos as $prod) : ?>
                    <tr>
                        <th><?= $prod['id'] ?></th>
                        <td><?= $prod['nombre'] ?></td>
                        <td><?= $prod['marca'] ?></td>
                        <td><?= $prod['modelo'] ?></td>
                        <td><?= $prod['precio'] ?></td>
                        <td><?= $prod['unidades'] ?></td>
                        <td><?= utf8_encode($prod['detalles']) ?></td>
                        <td>
                            <?php if(!empty($prod['imagen'])) : ?>
                                <img src="<?= $prod['imagen'] ?>" alt="Imagen" width="100" />
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <p>No hay productos con unidades ≤ <?= $tope ?></p>
    <?php endif; ?>
</body>
</html>
