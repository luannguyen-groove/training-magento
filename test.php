<?php

require_once "app/Mage.php";

Mage::app();

$product = Mage::getModel("demo/product");

//$product->sayHello();

//$helper = Mage::helper("demo");
//$helper->sayHelloHelper();

$category = Mage::getModel("catalog/category")->load(2);

var_dump($category->getChildren());