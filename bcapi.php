<?php
include_once("includes/class.bigcommerce.php");
$bc = new BigCommerce();

$bc->createProduct();

echo "<br> product list:<br>";
$bc->getProducts();

?>