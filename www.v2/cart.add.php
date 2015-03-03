<?php

	include_once('core.config.frontend.php');

	if(!isset($_GET['id']) or intval($_GET['id']) < 1){
		back();
	}

	$id = intval($_GET['id']);

	if(!isset($_GET['amt']) or intval($_GET['amt']) < 1){
		$amount = 1;
	} else {
		$amount = intval($_GET['amt']);
	}

	if(!isset($_SESSION['cart'])){
		$_SESSION['cart'] = array();
	}

	if(isset($_SESSION['cart'][$id])) {
		$_SESSION['cart'][$id] += $amount;
	} else {
		$_SESSION['cart'][$id] = $amount;
	}

	back();
?>
