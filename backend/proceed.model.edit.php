<?php
	
	include_once('core.config.php');

	if(empty($__name)) {
		$proceedErrors[] = 'Name is required.';
		return ;
	}

	$stmt = $sql->prepare("UPDATE model SET online=?, name=?, desc_fi=?, desc_se=?, desc_en=?, thickness=? WHERE id=?");
	$stmt->bind_param("issssii", $__online, $__name, $__desc_fi, $__desc_se, $__desc_en, $__thickness, $__id);
	$stmt->execute();
	$stmt->close();

	$locateTo = 'admin.models.list.php';

?>