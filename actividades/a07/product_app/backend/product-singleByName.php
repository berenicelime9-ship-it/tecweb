<?php
    use MARKETZONE\MAIN\Products as Product; 
    include_once __DIR__ . '/myapi/Products.php';
    $product = new Product('marketzone');
    $product->singleByName($_GET['name']);
    echo $product->getResponse();
?>