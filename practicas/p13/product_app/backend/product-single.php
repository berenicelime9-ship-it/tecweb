<?php
    // use TECWEB\MYAPI\Products;
    // require_once __DIR__.'/myapi/Products.php';

    // $productos = new Products('marketzone');
    // $productos->single( $_POST['id'] );
    // echo $productos->getData();
?>

<?php
require_once __DIR__ . '/../vendor/autoload.php';

use TECWEB\MyApi\Read\Read;

$Read = new Read('marketzone');
$Read->single($_POST['id']);
echo $Read->getData();
?>
