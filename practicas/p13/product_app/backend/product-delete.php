<?php
    // use TECWEB\MYAPI\Products;
    // require_once __DIR__.'/myapi/Products.php';

    // $productos = new Products('marketzone');
    // $productos->delete( $_POST['id'] );
    // echo $productos->getData();
?>

<?php
require_once __DIR__ . '/../vendor/autoload.php';

use TECWEB\MyApi\Delete\Delete;

$Delete = new Delete('marketzone');
$Delete->delete($_POST['id']);
echo $Delete->getData();
?>
