<?php
header("Content-Type: text/html; charset=utf-8");

// Valores por defecto (nuevo producto)
$producto = [
    'id' => 0,
    'nombre' => '',
    'marca' => '',
    'modelo' => '',
    'precio' => '',
    'detalles' => '',
    'unidades' => '',
    'imagen' => 'img/default-car.png'
];

// Si recibimos datos por POST (desde la tabla), los usamos para rellenar el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $producto['id']       = $_POST['id'] ?? 0;
    $producto['nombre']   = $_POST['nombre'] ?? '';
    $producto['marca']    = $_POST['marca'] ?? '';
    $producto['modelo']   = $_POST['modelo'] ?? '';
    $producto['precio']   = $_POST['precio'] ?? '';
    $producto['detalles'] = $_POST['detalles'] ?? '';
    $producto['unidades'] = $_POST['unidades'] ?? '';
    $producto['imagen']   = $_POST['imagen'] ?: 'img/default-car.png';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title><?= $producto['id'] ? "Modificar Producto" : "Registrar Producto" ?></title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
    }

    h1, h2 {
      text-align: center;
    }

    form {
      width: 500px;
      margin: 0 auto;
    }

    fieldset {
      padding: 20px;
      border-radius: 10px;
    }

    ul {
      list-style-type: none;
      padding: 0;
    }

    li {
      margin-bottom: 15px;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    label {
      width: 150px;
      text-align: right;
      margin-right: 10px;
    }

    input[type="text"],
    input[type="number"],
    select,
    textarea {
      width: 300px;
      padding: 5px;
    }

    textarea {
      resize: none;
      height: 60px;
    }

    p {
      text-align: center;
      margin-top: 20px;
    }

    input[type="submit"],
    input[type="reset"] {
      padding: 8px 20px;
      margin: 5px;
      cursor: pointer;
    }
  </style>
  <script>
    function validarFormulario(event) {
      const nombre = document.getElementById("nombre").value.trim();
      const marca = document.getElementById("marca").value;
      const modelo = document.getElementById("modelo").value.trim();
      const precio = parseFloat(document.getElementById("precio").value);
      const unidades = parseInt(document.getElementById("unidades").value);
      const detalles = document.getElementById("detalles").value.trim();
      const imagen = document.getElementById("imagen");

      if (!nombre || nombre.length>100){ alert("Nombre inválido"); event.preventDefault(); return false; }
      if (!marca){ alert("Debe seleccionar una marca"); event.preventDefault(); return false; }
      if (!modelo || modelo.length>25){ alert("Modelo inválido"); event.preventDefault(); return false; }
      if (isNaN(precio) || precio<=99.99){ alert("Precio inválido"); event.preventDefault(); return false; }
      if (isNaN(unidades) || unidades<0){ alert("Unidades inválidas"); event.preventDefault(); return false; }
      if (detalles.length>250){ alert("Detalles demasiado largos"); event.preventDefault(); return false; }
      if (imagen.value.trim()===''){ imagen.value='img/default-car.png'; }

      return true;
    }
  </script>
</head>
<body>

<h1><?= $producto['id'] ? "Modificar Producto" : "Registrar Producto" ?> &ldquo;Automóviles&rdquo;</h1>

<form action="<?= $producto['id'] ? 'update_producto.php' : 'set_producto_v2.php' ?>" method="post" onsubmit="return validarFormulario(event)">
  <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>" />

  <fieldset>
    <legend>Información del Automóvil</legend>
    <ul>
      <li>
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['nombre']) ?>" required maxlength="100">
      </li>
      <li>
        <label for="marca">Marca:</label>
        <select id="marca" name="marca" required>
          <option value="">-- Seleccione una marca --</option>
          <?php
          $marcas = ["Toyota","Ford","Nissan","Chevrolet","Volkswagen","Honda","BMW","Mercedes-Benz","Hyundai","Kia","Mazda","Audi","Peugeot","Renault","Tesla"];
          foreach($marcas as $m){
              $selected = ($producto['marca']==$m) ? 'selected' : '';
              echo "<option value=\"$m\" $selected>$m</option>";
          }
          ?>
        </select>
      </li>
      <li>
        <label for="modelo">Modelo:</label>
        <input type="text" id="modelo" name="modelo" value="<?= htmlspecialchars($producto['modelo']) ?>" required maxlength="25">
      </li>
      <li>
        <label for="precio">Precio:</label>
        <input type="number" id="precio" name="precio" step="0.01" value="<?= htmlspecialchars($producto['precio']) ?>" required>
      </li>
      <li>
        <label for="detalles">Detalles:</label>
        <textarea id="detalles" name="detalles" maxlength="250"><?= htmlspecialchars($producto['detalles']) ?></textarea>
      </li>
      <li>
        <label for="unidades">Unidades:</label>
        <input type="number" id="unidades" name="unidades" min="0" value="<?= htmlspecialchars($producto['unidades']) ?>" required>
      </li>
      <li>
        <label for="imagen">Imagen:</label>
        <input type="text" id="imagen" name="imagen" value="<?= htmlspecialchars($producto['imagen']) ?>">
      </li>
    </ul>
  </fieldset>

  <p>
    <input type="submit" value="<?= $producto['id'] ? 'Actualizar' : 'Registrar' ?>">
    <input type="reset" value="Limpiar">
  </p>
</form>

</body>
</html>
