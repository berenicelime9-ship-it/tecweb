<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Práctica 4</title>
</head>
<body>
        <h2>Ejercicio 1</h2>
        <p>Escribir programa para comprobar si un número es un múltiplo de 5 y 7</p>

        <?php
            require_once 'src/funciones.php';
            comprobarMultiplo();
        ?>

        <!-- <h2>Ejemplo de POST</h2>
        <form action="http://localhost/tecweb/practicas/p07/index.php" method="post">
            Name: <input type="text" name="name"><br>
            E-mail: <input type="text" name="email"><br>
            <input type="submit">
        </form>
        <br>
        <?php
            // if(isset($_POST["name"]) && isset($_POST["email"]))
            // {
            //     echo $_POST["name"];
            //     echo '<br>';
            //     echo $_POST["email"];
            // }
        ?> -->

        <h2>Ejercicio 2</h2>
        <p>Crea un programa para la generación repetitiva de 3 números aleatorios hasta obtener una secuencia  compuesta por:</p>

        <?php
            require_once 'src/funciones.php';
            NumerosAleatorios();
        ?>

        <h2>Ejercicio 3</h2>
        <p>Utiliza un ciclo while para encontrar el primer número entero obtenido aleatoriamente, pero que además además sea múltiplo de un número dado.</p>
        <ul>
            <li>Crear una variante de este script utilizando el ciclo do-while.</li>
            <li> El número dado se debe obtener vía GET </li>
        </ul>
        <?php
            require_once 'src/funciones.php';
            echo "<h3>Versión con while</h3>";
            PrimerEnteroWhile();
            echo "<h3>Versión con do-while</h3>";
            PrimerEnteroDo();
        ?>

        <!--Ejercicio 4 -->
        <h2>Ejercicio 4</h2>
        <p>Crea un arreglo cuyos indices van de 97 a 122 y cuyos valores son las letras dee la 'a' a la 'z'. Usa la función chr(n) que devuelve el caracter cuyo código ASCII es n para poner el valor en cada indice.</p>
        <ul>
            <li>Crea el arreglo con un ciclo for</li>
            <li>Lee el arreglo y crea una tabla en XHTML con echo y un ciclo foreach</li>
        </ul>

        <?php
            require_once 'src/funciones.php';
            TablaASCII();
        ?>

    <!-- Ejercicio 5 -->
    <h2>Ejercicio 5</h2>
    <p>
        Usar las variables $edad y $sexo en una instrucción if para identificar una persona de sexo “femenino”, cuya edad oscile entre los 18 y 35 años y mostrar un mensaje de bienvenida apropiado.    
    </p>

    <form action="http://localhost:8080/tecweb/practicas/p07/src/respuestaEj5.php" method="post">
        <fieldset>
            <legend>Validación de edad y sexo</legend><br>

            <label>Edad: </label>
            <input type="number" name="edad" min="0" max="120" required><br><br>
            
            <label>Sexo: </label><br>
            <input type="radio" name="sexo" value="masculino" required>Masculino<br>
            <input type="radio" name="sexo" value="femenino">Femenino<br><br>
            
            <input type="submit" value="Validar">
        </fieldset>
    </form>


    <!-- Ejercicio 6 -->

    <h2>Ejercicio 6</h2>
        <p>Crea en código duro un arreglo asociativo que sirva para registrar el parque vehicular de una ciudad.
        </p>

        <form action="http://localhost:8080/tecweb/practicas/p07/src/respuestaEj6.php" method="post">
            <fieldset>
                <legend>Parque vehicuar</legend><br>
                <label>Matrícula: </label><input type="text" name="matricula"><br><br>
                <label>Consultar por: </label>
                <input type="submit" name="consulta" value="Matricula de auto">
                <input type="submit" name="consulta" value="Todos los autos">
            </fieldset>
        </form>


</body>
</html>
