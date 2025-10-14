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

// Lista de marcas de autos
$marcas = [
    "Toyota","Ford","Nissan","Chevrolet","Volkswagen",
    "Honda","BMW","Mercedes-Benz","Hyundai","Kia",
    "Mazda","Audi","Peugeot","Renault","Tesla",
    "Jeep","Subaru","Mitsubishi","Dodge","Fiat"
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

    // Solo tomar el nombre del archivo para img/
    $imagenRecibida = $_POST['imagen'] ?? '';
    if (!empty($imagenRecibida)) {
        $producto['imagen'] = 'img/' . basename($imagenRecibida);
    }
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

legend {
  font-weight: normal; /* letra normal */
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
  font-weight: normal; /* letra delgada */
}

textarea {
  resize: none;
  height: 60px;
}

.button-container {
  text-align: center;
  margin-top: 20px;
}

.button-container input {
  display: inline-block;
  margin-right: 10px;
  padding: 8px 20px;
  cursor: pointer;
}
</style>
</head>

<body>
<h1><?= $producto['id'] ? "Modificar Producto" : "Registro de Productos “Automóviles”" ?></h1>
<form id="formularioAutos" action="<?= $producto['id'] ? 'update_producto.php' : 'set_producto_v2.php' ?>" method="post">
  <h2>Datos del auto:</h2>

  <fieldset>
    <legend>Información del Automóvil</legend>
    <ul>
      <li>
        <label for="form-name">Nombre:</label>
        <input type="text" name="nombre" id="form-name" value="<?= htmlspecialchars($producto['nombre']) ?>" required maxlength="100">
      </li>

      <li>
        <label for="form-brand">Marca:</label>
        <select name="marca" id="form-brand" required>
          <option value="">-- Selecciona una marca --</option>
          <?php
          foreach($marcas as $m){
              $selected = strcasecmp($producto['marca'], $m) === 0 ? 'selected' : '';
              echo "<option value=\"$m\" $selected>$m</option>";
          }
          ?>
        </select>
      </li>

      <li>
        <label for="form-model">Modelo:</label>
        <input type="text" name="modelo" id="form-model" value="<?= htmlspecialchars($producto['modelo']) ?>" required maxlength="25">
      </li>

      <li>
        <label for="form-price">Precio:</label>
        <input type="number" name="precio" id="form-price" step="0.01" value="<?= htmlspecialchars($producto['precio']) ?>" required>
      </li>

      <li>
        <label for="form-details">Detalles:</label>
        <textarea name="detalles" id="form-details" maxlength="250"><?= htmlspecialchars($producto['detalles']) ?></textarea>
      </li>

      <li>
        <label for="form-units">Unidades:</label>
        <input type="number" name="unidades" id="form-units" min="0" value="<?= htmlspecialchars($producto['unidades']) ?>" required>
      </li>

      <li>
        <label for="form-image">Imagen:</label>
        <input type="text" name="imagen" id="form-image" value="<?= htmlspecialchars($producto['imagen']) ?>">
      </li>
    </ul>
  </fieldset>

  <div class="button-container">
    <input type="submit" value="<?= $producto['id'] ? 'Actualizar' : 'Registrar' ?>">
    <input type="reset" value="Limpiar">
  </div>

  <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']) ?>" />
</form>

<script>
document.getElementById("formularioAutos").addEventListener("submit", function(event) {
  const nombre = document.getElementById("form-name").value.trim();
  const marca = document.getElementById("form-brand").value;
  const modelo = document.getElementById("form-model").value.trim();
  const precio = parseFloat(document.getElementById("form-price").value);
  const detalles = document.getElementById("form-details").value.trim();
  const unidades = parseInt(document.getElementById("form-units").value);
  const imagen = document.getElementById("form-image");

  if (nombre === "" || nombre.length > 100) {
    alert("El nombre es requerido y debe tener 100 caracteres o menos.");
    event.preventDefault();
    return;
  }

  if (marca === "") {
    alert("Debes seleccionar una marca.");
    event.preventDefault();
    return;
  }

  const regexModelo = /^[a-zA-Z0-9\s]+$/;
  if (modelo === "" || !regexModelo.test(modelo) || modelo.length > 25) {
    alert("El modelo es requerido, alfanumérico (puede incluir espacios) y debe tener 25 caracteres o menos.");
    event.preventDefault();
    return;
  }

  if (isNaN(precio) || precio <= 99.99) {
    alert("El precio debe ser mayor a 99.99.");
    event.preventDefault();
    return;
  }

  if (detalles.length > 250) {
    alert("Los detalles deben tener 250 caracteres o menos.");
    event.preventDefault();
    return;
  }

  if (isNaN(unidades) || unidades < 0) {
    alert("Las unidades deben ser un número mayor o igual a 0.");
    event.preventDefault();
    return;
  }

  if (imagen.value.trim() === "") {
    imagen.value = "img/default-car.png";
  }
});
</script>
</body>
</html>
