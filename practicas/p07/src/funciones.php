<!-- Ejercicio 1 -->
<?php
function comprobarMultiplo() {
    if (isset($_GET['numero'])) {
        $num = $_GET['numero'];
        if ($num % 5 == 0 && $num % 7 == 0) {
            echo '<h3>R= El número ' . $num . ' SÍ es múltiplo de 5 y 7.</h3>';
        } else {
            echo '<h3>R= El número ' . $num . ' NO es múltiplo de 5 y 7.</h3>';
        }
    }
}
?>

<!-- Ejercicio 2 -->
<?php
function NumerosAleatorios() {
    $matriz = [];
    $i = 0;

    do {
        $num1 = rand(100, 999);
        $num2 = rand(100, 999);
        $num3 = rand(100, 999);

        $matriz[] = [$num1, $num2, $num3];
        $i++;

    } while (!($num1 % 2 != 0 && $num2 % 2 == 0 && $num3 % 2 != 0));

    echo "<strong>";
    echo "<span style='color:blue'>impar</span>, ";
    echo "<span style='color:orange'>par</span>, ";
    echo "<span style='color:blue'>impar</span>";
    echo "</strong><br><br>";

    $ultimaFila = end($matriz); 
    foreach ($matriz as $fila) {
    
        if ($fila === $ultimaFila) {
            echo "<span style='color:blue'>{$fila[0]}</span>, ";
            echo "<span style='color:orange'>{$fila[1]}</span>, ";
            echo "<span style='color:blue'>{$fila[2]}</span>";
        } else {
            echo $fila[0] . ", " . $fila[1] . ", " . $fila[2];
        }
        echo "<br>";
    }

    $totalNumeros = $i * 3;
    echo "<p>$totalNumeros números obtenidos en $i iteraciones</p>";
}
?>

<!-- Ejercicio 3 -->
<?php
function PrimerEnteroWhile() {

    $m = (int) $_GET['multiplo'];  
    $numero = rand(1, 10000);

    while ($numero % $m != 0) {
        $numero = rand(1, 10000);
    }
    echo "El primer entero múltiplo de $m encontrado es: $numero<br>";
}
?>

<?php
function PrimerEnteroDo() {

    $m = (int) $_GET['multiplo'];  
    $numero = 0;

    do {
        $numero = rand(1, 10000);
    } while ($numero % $m != 0);

    echo "El primer entero múltiplo de $m encontrado es: $numero<br>";
}
?>

