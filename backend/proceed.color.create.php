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

	$stmt = $sql->prepare("INSERT INTO color (color_category, name, hexa_light, hexa_original) VALUES (?, ?, ?, ?)");
	$stmt->bind_param("isss", $__category, $__name, $__hexa_light, $__hexa_original);
	$stmt->execute();
	$newId = $stmt->insert_id;
	$stmt->close();

	shutdown();
	
	$locateTo = 'admin.colors.list.php';

?>