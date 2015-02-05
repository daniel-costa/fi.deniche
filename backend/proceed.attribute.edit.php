<?php
	
	include_once('core.config.php');

	if(empty($__name_en)) {
		$proceedErrors[] = 'Name english is empty.';
		return ;
	}

	$stmt = $sql->prepare("UPDATE attribute SET name_fi=?, name_se=?, name_en=?, online=? WHERE id=?");
	$stmt->bind_param("sssii", $__name_fi, $__name_se, $__name_en, $__online, $__id);
	$stmt->execute();
	$stmt->close();

	$locateTo = 'admin.attributes.list.php';

?>