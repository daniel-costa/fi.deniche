<?php
	
	include_once('core.config.php');

	if(loggedIn()) {
		if(!$_SESSION['account']['validated']) {
			locate('admin.pending.php');
		} else {
			switch($_SESSION['account']['type']) {
				case ACCOUNT_TYPE_USER:  locate('../index.php'); break;
				case ACCOUNT_TYPE_ADMIN: locate('admin.admins.list.php'); break;
			}
		}
	} else {
		locate('admin.login.php');
	}
?>