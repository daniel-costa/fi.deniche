<?php
	
	include_once('core.config.frontend.php');
	include_once('../backend/core.config.php');
	
	if(isset($_GET['lang']) and in_array(strtolower($_GET['lang']), array('en', 'fi', 'se'))) {
		setLang($_GET['lang']);
	} else {
		setLang('fi');
	}

	back();
?>
	