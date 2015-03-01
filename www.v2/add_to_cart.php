<?php
if(!isset($_GET['id']) | !isset($_GET['num'])){
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
}
/*
 * After click to add to cart bottom
 */
session_start();

//get the product id
$id = isset($_GET['id']) ? $_GET['id'] : "";
//get no of item
$num = isset($_GET['num']) ? $_GET['num'] : "";
$num = intval($num);

if($num < 1){
	header('Location:'.$_SERVER['HTTP_REFERER']);
	exit;
}

if(!isset($_SESSION ['cart_items'])){
	$_SESSION['cart_items'] = array();
}


for ($i = 0; $i < $num; $i++) {
	array_push($_SESSION ['cart_items'], $id);
}

header('Location:'.$_SERVER['HTTP_REFERER']);
exit;

?>
