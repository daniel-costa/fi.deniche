
<?php
	
	include_once('core.config.php');

	if(isset($_GET['id'])) {
		$stmt = $sql->prepare("UPDATE product_image SET position = position + ? WHERE id = ?");
		$stmt->bind_param("ii", $_GET['dir'], $_GET['id']);
		$stmt->execute();
		$stmt->close();
	}

	back();
	
?>