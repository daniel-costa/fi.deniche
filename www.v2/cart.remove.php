<?php
	
	include_once('core.config.frontend.php');

	if(!isset($_GET['id']) or intval($_GET['id']) < 1 or !isset($_SESSION['cart'])){
		back();
	}

	$id = intval($_GET['id']);

	unset($_SESSION['cart'][$id]);

	back();
?>
