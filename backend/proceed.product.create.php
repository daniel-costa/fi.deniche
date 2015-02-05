<?php
	
	include_once('core.config.php');

	$__color     = $__color     == 'null' ? null : $__color;
	$__color_sec = $__color_sec == 'null' ? null : $__color_sec;
	$__color_ins = $__color_ins == 'null' ? null : $__color_ins;
	

	if(empty($__sku)) {
		$proceedErrors[] = 'Sku is required.';
		return ;
	}

	$stmt = $sql->prepare("SELECT count(id) FROM product WHERE SKU = ?");
	$stmt->bind_param("s", $__sku);
	$stmt->execute();
	$stmt->bind_result($total);
	$stmt->fetch();
	$stmt->close();

	if($total > 0) {
		$proceedErrors[] = 'Sku already in use.';
		return ;
	}

	$stmt = $sql->prepare("INSERT INTO product (online, model, color, color_sec, color_ins, sku, price, bargain, stock) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("iiiiisddi", $__online, $__model, $__color, $__color_sec, $__color_ins, $__sku, $__price, $__bargain, $__stock);
	$stmt->execute();
	$newId = $stmt->insert_id;
	$stmt->close();

	shutdown();
	
	$locateTo = 'admin.product.edit.php?id=' . $newId;

?>