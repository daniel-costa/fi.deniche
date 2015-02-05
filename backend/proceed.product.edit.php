<?php
	
	include_once('core.config.php');

	$__color     = $__color     == 'null' ? null : $__color;
	$__color_sec = $__color_sec == 'null' ? null : $__color_sec;
	$__color_ins = $__color_ins == 'null' ? null : $__color_ins;

	if(empty($__sku)) {
		$proceedErrors[] = 'Sku is required.';
		return ;
	}

	$stmt = $sql->prepare("SELECT count(id) FROM product WHERE SKU = ? and id != ?");
	$stmt->bind_param("si", $__sku, $__id);
	$stmt->execute();
	$stmt->bind_result($total);
	$stmt->fetch();
	$stmt->close();

	if($total > 0) {
		$proceedErrors[] = 'Sku already in use.';
		return ;
	}

	$stmt = $sql->prepare("UPDATE product SET online=?, model=?, color=?, color_sec=?, color_ins=?, sku=?, price=?, bargain=?, stock=? WHERE id=?");
	$stmt->bind_param("iiiiisddii", $__online, $__model, $__color, $__color_sec, $__color_ins, $__sku, $__price, $__bargain, $__stock, $__id);
	$stmt->execute();
	$stmt->close();

	$locateTo = 'admin.products.list.php';

?>