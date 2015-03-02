<?php
	
	include_once('core.config.frontend.php');

	if (isset($_GET['lang']) and in_array(strtolower($_GET['lang']), array('en', 'fi', 'se'))) {
		setLang($_GET['lang']);
	} else {
		setLang('fi');
	}

	back();
?>
	