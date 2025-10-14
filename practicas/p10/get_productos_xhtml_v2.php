<?php
header("Content-Type: text/html; charset=utf-8"); 

$productos = [];
$mensaje_error = '';
$conexion_valida = true;

// Conexión a la base de datos
@$link = new mysqli('localhost', 'root', 'straykids8_', 'marketzone');
if ($link->connect_errno) {
    $conexion_valida = false;
    $mensaje_error = 'Falló la conexión: ' . $link->connect_error;
} else {
    $sql = "SELECT * FROM productos";
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
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Todos los Productos</title>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
<style>
body { font-family: Arial, sans-serif; margin: 40px; text-align: center; }
table { margin: 0 auto; width: auto; }
img { width: 80px; border-radius: 5px; }
.btn-simple {
    padding: 4px 10px;
    border: 1px solid #555;
    border-radius: 4px;
    background: none;
    cursor: pointer;
    color: black;
    text-decoration: none;
}
.btn-simple:hover {
    background: #f0f0f0;
}
.eliminado {
    background-color: #ffe6e6; /* resalta productos eliminados */
}
</style>
<script>
function modificarProducto(id, nombre, marca, modelo, precio, unidades, detalles, imagen) {
    var form = document.createElement("form");
    form.method = "POST";
    form.action = "formulario_productos_v2.php";

    function addField(name, value) {
        var input = document.createElement("input");
        input.type = "hidden";
        input.name = name;
        input.value = value;
        form.appendChild(input);
    }

    addField("id", id);
    addField("nombre", nombre);
    addField("marca", marca);
    addField("modelo", modelo);
    addField("precio", precio);
    addField("unidades", unidades);
    addField("detalles", detalles);
    addField("imagen", imagen);

    document.body.appendChild(form);
    form.submit();
}
</script>
</head>
<body>
<h3>Todos los Productos</h3>

<?php if (!$conexion_valida): ?>
    <p style="color:red;"><?= $mensaje_error ?></p>
<?php elseif (!empty($productos)): ?>
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
                <tr class="<?= $prod['eliminado'] ? 'eliminado' : '' ?>">
                    <td><?= $prod['id'] ?></td>
                    <td><?= htmlspecialchars($prod['nombre']) ?></td>
                    <td><?= htmlspecialchars($prod['marca']) ?></td>
                    <td><?= htmlspecialchars($prod['modelo']) ?></td>
                    <td>$<?= number_format($prod['precio'],2) ?></td>
                    <td><?= $prod['unidades'] ?></td>
                    <td><?= htmlspecialchars(utf8_encode($prod['detalles'])) ?></td>
                    <td>
                        <img src="<?= !empty($prod['imagen']) ? $prod['imagen'] : 'img/default-car.png' ?>" alt="Imagen" />
                    </td>
                    <td>
                        <button 
                            class="btn-simple" 
                            onclick="modificarProducto(
                                '<?= $prod['id'] ?>',
                                '<?= htmlspecialchars(addslashes($prod['nombre'])) ?>',
                                '<?= htmlspecialchars(addslashes($prod['marca'])) ?>',
                                '<?= htmlspecialchars(addslashes($prod['modelo'])) ?>',
                                '<?= $prod['precio'] ?>',
                                '<?= $prod['unidades'] ?>',
                                '<?= htmlspecialchars(addslashes($prod['detalles'])) ?>',
                                '<?= !empty($prod['imagen']) ? $prod['imagen'] : 'img/default-car.png' ?>'
                            )">
                            Modificar
                        </button>
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
