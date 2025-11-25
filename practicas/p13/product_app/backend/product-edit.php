<?php
    // use TECWEB\MYAPI\Products;
    // require_once __DIR__.'/myapi/Products.php';

    // $productos = new Products('marketzone');
    // $productos->edit( json_decode( json_encode($_POST) ) );
    // echo $productos->getData();
?>

<?php
require_once __DIR__ . '/../vendor/autoload.php';

use TECWEB\MyApi\Update\Update;

$Update = new Update('marketzone');
$Update->edit(json_decode(json_encode($_POST)));
echo $Update->getData();
?>

