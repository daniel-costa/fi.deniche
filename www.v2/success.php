<?php

include_once('core.config.frontend.php');
require_once "Paytrail_Module_Rest.php";
	
	$items = 0;
	$total = 0;


	//if cart is  not set
	if(!isset($_SESSION['cart'])){
		back();
	}

	foreach($_SESSION['cart'] as $i) {
		$items += $i;
	}

	foreach ($_SESSION['cart'] as $id => $amount) {
		//echo $id."<br/>";
		$item = getProduct($id);
		$total += $item['price'] * $amount;
	
	}

$module = new Paytrail_Module_Rest(13466, "6pKF4jkv97zmqBJ3ZL8gUw5DfT2NMQ");

if ($module->confirmPayment($_GET["ORDER_NUMBER"], $_GET["TIMESTAMP"], $_GET["PAID"], $_GET["METHOD"], $_GET["RETURN_AUTHCODE"])) {
    // Payment receipt is valid
  
    $ORDER_NUMBER = mysql_real_escape_string($_GET['ORDER_NUMBER']);
    $TIMESTAMP = mysql_real_escape_string($_GET['TIMESTAMP']);
    

    date_default_timezone_set('Europe/Helsinki');
    $dateTime = date("d/m/Y", $TIMESTAMP);
    echo $dateTime;

    echo "<br/>";
    echo $ORDER_NUMBER; 

    echo "<br/>";
    echo sprintf("%s %.2f &euro;", $lang['Total'], $total);

    
	//$_SESSION['cart'] = "";
	unset($_SESSION['cart']);
}
else {
    // Payment receipt was not valid, possible payment fraud attempt
    echo "Payment failed";
}
          
?>