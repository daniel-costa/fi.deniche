<?php
	
	include_once('core.config.php');

	$stmt = $sql->prepare("INSERT INTO product_attribute (product, attribute) VALUES (?, ?)");
	$stmt->bind_param("ii", $__product, $__attribute);
	$stmt->execute();
	$stmt->close();

	shutdown();
	
	$locateTo = 'admin.product.edit.php?id=' . $__product;

?>