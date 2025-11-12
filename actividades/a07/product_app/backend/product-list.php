<?php
use MARKETZONE\MAIN\Products as Product;
require_once __DIR__ . '/myapi/Products.php';

$productos = new Product('marketzone');
$productos->list();

echo $productos->getResponse();
?>
