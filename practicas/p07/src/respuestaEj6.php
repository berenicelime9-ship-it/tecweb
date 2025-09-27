<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base de datos del parque vehicular</title>
</head>
<body>
    <?php
        $vehiculosDB = require_once 'BD_autos.php';
        $vehiculosAMostrar = [];

        if(isset($_POST['consulta'])) {
            $tipoConsulta = $_POST['consulta'];
            $matricula = $_POST['matricula'] ?? '';

            if($tipoConsulta === "Matricula de auto") {
                if(empty($matricula)) {
                    echo "<p>Por favor ingresa una matrícula</p>";
                } elseif(!isset($vehiculosDB[$matricula])) {
                    echo "<p>Matrícula no encontrada</p>";
                } else {
                    $vehiculosAMostrar = [$matricula => $vehiculosDB[$matricula]];
                    echo "<p><strong>Matrícula de auto:</strong> $matricula</p>";
                }
            } elseif($tipoConsulta === "Todos los autos") {
                $vehiculosAMostrar = $vehiculosDB;
                echo "<p><strong>Todos los autos registrados:</strong></p>";
            }
        } else {
            echo "<p>No se recibieron datos del formulario</p>";
        }

        if(!empty($vehiculosAMostrar)) { //Contenido
            foreach($vehiculosAMostrar as $mat => $infoVehiculo) {
                echo "<pre>";
                echo "Matrícula: $mat\n";
                print_r($infoVehiculo);
                echo "</pre>";
                if($tipoConsulta === "Todos los autos") {
                    echo "<hr>";
                }
            }
        }
    ?>
</body>
</html>
