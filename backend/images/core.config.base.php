<?php
	session_start();
	
	define('ACCOUNT_TYPE_USER',  1);
	define('ACCOUNT_TYPE_ADMIN', 2);
	
	define('DB_HOST', 'deniche.fi');
	define('DB_USER', 'udeniche');
	define('DB_PASS', 'uU39248204');
	define('DB_NAME', 'deniche');
	define('DB_PORT', 3306);

	include_once('core.library.php');

	if(!isset($do_not_require_auth) and !isset($_SESSION['account']) and $_SESSION['account']['type'] != ACCOUNT_TYPE_ADMIN) {
		locate('admin.login.php');
	}

	define('BIN_IMAGES_PATH', '/home/httpd/vhosts/vixinet.ch/fi.deniche//binaries/products');
	define('BIN_IMAGES_URL', 'http://deniche.fi//binaries/products');

	$sql = db_connect();
?>