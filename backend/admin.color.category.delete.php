<?php
	
	include_once('core.config.php');

	if(isset($_GET['id'])) {
		$stmt = $sql->prepare("DELETE FROM color_category WHERE id=?");
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->close();
	}

	back();
	
?>