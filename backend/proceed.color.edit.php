<?php
	
	include_once('core.config.php');

	if(empty($__name)) {
		$proceedErrors[] = 'Name is required.';
		return ;
	}

	if(empty($__hexa_light)) {
		$proceedErrors[] = 'Background color is required.';
		return ;
	}

	if(empty($__hexa_original)) {
		$proceedErrors[] = 'Bullet color is required.';
		return ;
	}

	$stmt = $sql->prepare("UPDATE color SET name=?, color_category=?, hexa_light=?, hexa_original=? WHERE id=?");
	$stmt->bind_param("sissi", $__name, $__category, $__hexa_light, $__hexa_original, $__id);
	$stmt->execute();
	$stmt->close();

	$locateTo = 'admin.colors.list.php';
?>