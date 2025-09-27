<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenida</title>
</head>
<body>
    <?php
        if(isset($_POST['edad']) && isset($_POST['sexo'])) {
            $edad = (int) $_POST['edad'];
            $sexo = $_POST['sexo'];

            if(($edad >= 18 && $edad <= 35) && $sexo === "femenino") {
                echo '<p><h3>Bienvenida, usted está en el rango de edad permitido</h3></p>';
            } else {
                echo '<p>Lo sentimos, usted no está en el rango permitido</p>';
            }
        } else {
            echo '<p>No se recibieron datos del formulario</p>';
        }
    ?>
</body>
</html>
