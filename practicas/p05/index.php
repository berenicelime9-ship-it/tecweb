<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Práctica 3</title>
</head>
<body>
    <h2>Ejercicio 1</h2>
    <p>Determina cuál de las siguientes variables son válidas y explica por qué:</p>
    <p>$_myvar,  $_7var,  myvar,  $myvar,  $var7,  $_element1, $house*5</p>
    <?php
        //AQUI VA MI CÓDIGO PHP
        $_myvar;
        $_7var;
        //myvar;       // Inválida
        $myvar;
        $var7;
        $_element1;
        //$house*5;     // Invalida
        
        echo '<h4>Respuesta:</h4>';   
    
        echo '<ul>';
        echo '<li>$_myvar es válida porque inicia con guión bajo.</li>';
        echo '<li>$_7var es válida porque inicia con guión bajo.</li>';
        echo '<li>myvar es inválida porque no tiene el signo de dolar ($).</li>';
        echo '<li>$myvar es válida porque inicia con una letra.</li>';
        echo '<li>$var7 es válida porque inicia con una letra.</li>';
        echo '<li>$_element1 es válida porque inicia con guión bajo.</li>';
        echo '<li>$house*5 es inválida porque el símbolo * no está permitido.</li>';
        echo '</ul>';
    ?>
    
   <h2>Ejercicio 2</h2>

    <p>Proporcionar las variables de $a, $b, $c como sigue:</p>
    <p>$a = “ManejadorSQL”;</p>
    <p>$b = 'MySQL';</p>
    <p>$c = &$a;</p>
    <p><a. Ahora muestra el contenido de cada variable</p>

    <?php    
        $a = "ManejadorSQL";
        $b = 'MySQL';
        $c = &$a;  
    
        echo '<h4>Respuesta:</h4>';   
        echo '<ul>';
        echo "<li>$a</li>";
        echo "<li>$b</li>";
        echo "<li>$c</li>";
        echo '</ul>';
    ?>

    <p>b. Agrega el codigo actual las siguientes asignaciones</p>
    <p>$a = “PHP server”;</p>
    <p>$b = &$a;</p>
    <p>c. Vuelve a mostrar el contenido de cada uno</p>

    <?php
    $a = "PHP server";
    $b = &$a;
    $c = &$a;
        echo '<h4>Respuesta b y c</h4>';   
        echo '<ul>';
        echo "<li>\$a = $a</li>";
        echo "<li>\$b = $b</li>";
        echo "<li>\$c = $c</li>";
        echo '</ul>';
    ?>

    <p>d. Describe en y muestra en la página obtenida qué ocurrió en el segundo bloque de asignaciones</p>

    <?php
        echo '<h4>Respuesta d</h4>';   
        echo '<p>En el segundo bloque de asignaciones, la variable <b>$a</b> cambió su valor a "PHP server".</p>';
        echo '<p>La variable <b>$b</b> ahora es una referencia a <b>$a</b>, por lo que muestra el mismo valor.</p>';
        echo '<p>La variable <b>$c</b> seguía siendo referencia a <b>$a</b>, así que también refleja el nuevo valor.</p>';
    ?>

<h2>Ejercicio 3</h2>
    <p>Muestra el contenido de cada variable inmediatamente, después de cada asignación, verificar la evolución del tipo de estas variables (imprime todos los componentes del arreglo):</p>
         <br>$a = "PHP5"; 
         <br>$z[] = &$a; 
         <br>$b = "5a version de PHP"; 
         <br> $c = $b*10; 
         <br> $a .= $b; 
         <br> $b *= $c; 
         <br> $z[0] = "MySQL";

    <?php
        echo '<h4>Respuesta 3</h4>';

        echo '<ul>'; $a = "PHP5";
        echo "<li>\$a = $a</li>"; $z[] = &$a;
        echo "<li>\$z[0] = $z[0]</li>"; $b = "5a version de PHP";
        echo "<li>\$b = $b</li>"; @$c = $b*10;
        echo "<li>\$c = $c</li>"; $a .= $b;
        echo "<li>\$a = $a</li>"; $b *= $c;
        echo "<li>\$b = $b</li>"; $z[0] = "MySQL";
        echo "<li>\$z[0] = $z[0]</li>";
        echo '</ul>';
    ?>

<h2>Ejercicio 4</h2>
    <p>4. Lee y muestra los valores de las variables del ejercicio anterior, pero ahora con la ayuda de la matriz $GLOBALS o del modificador global de PHP </p>
    
    <?php
        echo '<h4>Respuesta 4</h4>';
        echo '<ul>';
        @$a = "PHP5";
        echo '<li>$a = '. $GLOBALS['a'] .'</li>';
        $z[] = &$a;
        echo '<li>$z[0] = '. $GLOBALS['z'][0] .'</li>';
        $b = "5a version de PHP";
        echo '<li>$b ='. $GLOBALS['b'] .'</li>';
        @$c = $b*10;
        echo '<li>$c ='. $GLOBALS['c'] .'</li>';
        $a .= $b;
        echo '<li>$a ='. $GLOBALS['a'] .'</li>';
        $b *= $c;
        echo '<li>$b ='. $GLOBALS['b'] .'</li>';
        $z[0] = "MySQL";
        echo '<li>$z[0] = '. $GLOBALS['z'][0] .'</li>';
        echo '</ul>';
    ?>

<h2>Ejercicio 5</h2>
    <p>5. Dar el valor de las variables $a, $b, $c al final del siguiente scrip:</p>
    <p>$a = "7 personas";<br>$b = (integer) $a;<br>$a = "9E3";<br>$c = (double) $a;

    <?php
        unset($a); unset($b); unset ($c);

        $a = "7 personas";
        $b = (integer) $a;
        $a = "9E3";
        $c = (double) $a;

        echo '<h4>Respuesta 5</h4>';
        echo '<ul>';
        echo '<li>$a = '.$a.'</li>';
        echo '<li>$b = '.$b.'</li>';
        echo '<li>$c = '.$c.'</li>';

        echo '</ul>';

        var_dump($a, $b, $c);
    ?>
 <h2>Ejercicio 6</h2>
    <p>6. Dar y comprobar el valor booleano de las variables $a, $b, $c, $d, $e y $f y muéstralas usando la función var_dump (<datos>)  </p> 

    <?php
    unset($a); unset($b); unset ($c);
    echo '<h4>Respuesta 6</h4>';

    $a = "0";
    $b = "TRUE";
    $c = FALSE;
    $d = ($a OR $b);
    $e = ($a AND $c);
    $f = ($a XOR $b);

    echo '<ul>';
    echo '<li>$a: '; var_dump($a); echo '</li>';
    echo '<li>$b: '; var_dump($b); echo '</li>';
    echo '<li>$c: '; var_dump($c); echo '</li>';
    echo '<li>$d: '; var_dump($d); echo '</li>';
    echo '<li>$e: '; var_dump($e); echo '</li>';
    echo '<li>$f: '; var_dump($f); echo '</li>';
    echo '</ul>';

    echo '<h4>Mostrar valores booleanos con echo</h4>';
    echo '<p>Para esto usamos <b>var_export($var, true)</b> que devuelve "true" o "false" como texto.</p>';

    echo '<ul>';
    echo '<li>$c = ' . var_export($c, true) . '</li>';
    echo '<li>$e = ' . var_export($e, true) . '</li>';
    echo '</ul>';
?>

<h2>Ejercicio 7</h2>
<p>Usando la variable predefinida <b>$_SERVER</b>, determina lo siguiente:</p>
<ol>
    <li>La versión de Apache y PHP</li>
    <li>El nombre del sistema operativo (servidor)</li>
    <li>El idioma del navegador (cliente)</li>
</ol>

<?php
    echo '<h4>Respuesta 7</h4>';
    echo '<ul>';
    echo '<li>Versión de Apache y PHP: ' . $_SERVER['SERVER_SOFTWARE'] . ' | PHP ' . phpversion() . '</li>';
    echo '<li>Sistema operativo del servidor: ' . PHP_OS . '</li>';
    echo '<li>Idioma del navegador (cliente): ' . $_SERVER['HTTP_ACCEPT_LANGUAGE'] . '</li>';
    echo '</ul>';
?>
</body>
</html>