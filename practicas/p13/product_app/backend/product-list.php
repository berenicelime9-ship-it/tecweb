<?php
    // use TECWEB\MYAPI\Products as Products;
    // require_once __DIR__.'/myapi/Products.php';

    // $productos = new Products('marketzone');
    // $productos->list();
    // echo $productos->getData();
?>

<?php
require_once __DIR__ . '/../vendor/autoload.php';

use TECWEB\MyApi\Read\Read;

$Read = new Read('marketzone');
$Read->list();
echo $Read->getData();
?>

