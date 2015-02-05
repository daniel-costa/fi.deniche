<?php
	
	include_once('core.config.php');

	if(empty($__name)) {
		$proceedErrors[] = 'Name is required.';
		return ;
	}

	if(empty($__desc_en)) {
		$proceedErrors[] = 'English description is required.';
		return ;
	}

	$stmt = $sql->prepare("INSERT INTO model (online, name, desc_fi, desc_se, desc_en, thickness) VALUES (?, ?, ?, ?, ?, ?)");
	$stmt->bind_param("issssi", $__online, $__name, $__desc_fi, $__desc_se, $__desc_en, $__thickness);
	$stmt->execute();
	$newId = $stmt->insert_id;
	$stmt->close();

	shutdown();
	
	$locateTo = 'admin.models.list.php';

?>