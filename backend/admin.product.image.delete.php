<?php
	
	include_once('core.config.php');

	if(isset($_GET['id'])) {
		$stmt = $sql->prepare("DELETE FROM product_image WHERE id=? and thumb = 0");
		$stmt->bind_param("i", $_GET['id']);
		$stmt->execute();
		$stmt->close();
	}

	unlink(BIN_IMAGES_PATH.'/img-'.$_GET['id'].'.png');
	unlink(BIN_IMAGES_PATH.'/img-'.$_GET['id'].'-thumb.png');

	back();
	
?>