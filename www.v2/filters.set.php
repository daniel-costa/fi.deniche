<?php
	
	include_once('core.config.frontend.php');

	if(isset($_GET['filter'])) {
		switch($_GET['filter']) {
			case 'model' :
				toggleFromFilter($_GET['id'], 'models');
				break;
			case 'feature' :
				toggleFromFilter($_GET['id'], 'attributes');
				break;
			case 'color' :
				toggleFromFilter($_GET['id'], 'colors');
				break;
			case 'thickness' :
				if(in_array($_GET['id'], array(1,2,3))) {
					$_SESSION['filters']['thickness'] = $_GET['id'];
				}
				break;
		}
		
	}

	function toggleFromFilter($value, $filter) {
		if(($key = array_search($value, $_SESSION['filters'][$filter])) !== false) {
			unset($_SESSION['filters'][$filter][$key]);
		} else {
			$_SESSION['filters'][$filter][] = $value;
		}
	}

	back();
?>
