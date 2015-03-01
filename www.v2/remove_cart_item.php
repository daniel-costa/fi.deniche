<?php
if(!isset($_GET['id'])){
	header('Location:index.php');
	exit;
}
/*
 * After click to add to cart bottom
 */
session_start();


if(!isset($_SESSION ['cart_items'])){
	header('Location:index.php');
	exit;
}

//get the product id
$id = isset($_GET['id']) ? $_GET['id'] : "";

if(in_array($id, $_SESSION['cart_items'])){

	$cart_items = array();
	$cart_items = $_SESSION['cart_items'];

	if(($key = array_search($id, $cart_items)) !== false) {
		
		$counts = array_count_values($cart_items);
		
		
		$numCount = $counts[$id];
		
		$delAry = array();
		
		for ($i = 0; $i < $numCount; $i++) {
			$delAry[] = $id;
		}
		
		$cart_items = array_diff($cart_items, $delAry);

		//unset($cart_items[$key]);

		$_SESSION['cart_items'] = $cart_items;
	}

	var_dump($cart_items);

}

header('Location:'.$_SERVER['HTTP_REFERER']);
exit;

?>
