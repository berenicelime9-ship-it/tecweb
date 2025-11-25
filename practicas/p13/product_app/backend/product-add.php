<?php
    // use TECWEB\MYAPI\Products;
    // require_once __DIR__.'/myapi/Products.php';

    // $productos = new Products('marketzone');
    // $productos->add( json_decode( json_encode($_POST) ) );
    // echo $productos->getData();
?>

<?php
require_once __DIR__ . '/../vendor/autoload.php';

use TECWEB\MyApi\Create\Create;

$Create = new Create('marketzone');
$Create->add(json_decode(json_encode($_POST)));
echo $Create->getData();
?>

