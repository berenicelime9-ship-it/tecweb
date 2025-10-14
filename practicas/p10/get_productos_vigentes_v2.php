<?php
header("Content-Type: text/html; charset=utf-8"); // HTML5 normal

$productos = [];
$mensaje_error = '';
$conexion_valida = true;

@$link = new mysqli('localhost', 'root', 'straykids8_', 'marketzone');
if ($link->connect_errno) {
    $conexion_valida = false;
    $mensaje_error = 'Falló la conexión: ' . $link->connect_error;
} else {
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
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Productos Vigentes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <style>
        body { font-family: Arial, sans-serif; margin: 30px; text-align: center; }
        table { margin: 20px auto; width: 90%; }
        img { width: 80px; border-radius: 5px; }
        .btn-simple {
            padding: 5px 12px;
            border: 1px solid #555;
            border-radius: 4px;
            background: none;
            cursor: pointer;
            color: black;
            text-decoration: none;
        }
        .btn-simple:hover { background: #f0f0f0; }
    </style>
    <script>
    function modificarProducto(event) {
        const row = event.target.closest("tr");
        const cells = row.querySelectorAll("td");

        const id       = cells[0].innerText;
        const nombre   = cells[1].innerText;
        const marca    = cells[2].innerText;
        const modelo   = cells[3].innerText;
        const precio   = cells[4].innerText.replace('$','').replace(',','');
        const unidades = cells[5].innerText;
        const detalles = cells[6].innerText;
        const imagen   = cells[7].querySelector("img").src;

        const form = document.createElement("form");
        form.method = "POST";
        form.action = "formulario_productos_v2.php";

        function addField(name, value) {
            const input = document.createElement("input");
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
    <h2>Productos Vigentes</h2>

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
                <tr>
                    <td><?= $prod['id'] ?></td>
                    <td><?= htmlspecialchars($prod['nombre']) ?></td>
                    <td><?= htmlspecialchars($prod['marca']) ?></td>
                    <td><?= htmlspecialchars($prod['modelo']) ?></td>
                    <td>$<?= number_format($prod['precio'], 2, '.', '') ?></td>
                    <td><?= $prod['unidades'] ?></td>
                    <td><?= htmlspecialchars($prod['detalles']) ?></td>
                    <td>
                        <img src="<?= !empty($prod['imagen']) ? $prod['imagen'] : 'img/default.png' ?>" alt="Imagen" />
                    </td>
                    <td>
                        <button type="button" class="btn-simple" onclick="modificarProducto(event)">Modificar</button>
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
