<?php
	
	include_once('core.config.php');

	if(empty($__name_en)) {
		$proceedErrors[] = 'Name english is empty.';
		return ;
	}

	$stmt = $sql->prepare("UPDATE color_category SET name_fi=?, name_se=?, name_en=?, hexa=? WHERE id=?");
	$stmt->bind_param("ssssi", $__name_fi, $__name_se, $__name_en, $__hexa, $__id);
	$stmt->execute();
	$stmt->close();

	$locateTo = 'admin.color.categories.list.php';

?>