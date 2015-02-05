<?php
	
	include_once('core.config.php');

	if(empty($__name_en)) {
		$proceedErrors[] = 'English name is required.';
		return ;
	}

	$stmt = $sql->prepare("INSERT INTO color_category (hexa, name_fi, name_se, name_en) VALUES (?, ?, ?, ?)");
	$stmt->bind_param("ssss", $__hexa, $__name_fi, $__name_se, $__name_en);
	$stmt->execute();
	$newId = $stmt->insert_id;
	$stmt->close();

	shutdown();
	
	$locateTo = 'admin.color.categories.list.php';

?>