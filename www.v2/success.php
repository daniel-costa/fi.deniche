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

	echo "Total amount ". $total;
	echo "<br/>";

	echo "No of items : ".$items;
	echo "<br/>";

$module = new Paytrail_Module_Rest(13466, "6pKF4jkv97zmqBJ3ZL8gUw5DfT2NMQ");

if ($module->confirmPayment($_GET["ORDER_NUMBER"], $_GET["TIMESTAMP"], $_GET["PAID"], $_GET["METHOD"], $_GET["RETURN_AUTHCODE"])) {
    // Payment receipt is valid
    // If needed, the used payment method can be found from the variable $_GET["METHOD"]
    // and order number for the payment from the variable $_GET["ORDER_NUMBER"]

    $ORDER_NUMBER = mysql_real_escape_string($_GET['ORDER_NUMBER']);
    $TIMESTAMP = mysql_real_escape_string($_GET['TIMESTAMP']);
    $PAID = mysql_real_escape_string($_GET['PAID']);
    

    date_default_timezone_set('Europe/Helsinki');
    $dateTime = date("d/m/Y", $TIMESTAMP);

    echo $PAID;
    echo "<br/>";

    echo $dateTime;
    echo "<br/>";
    echo $ORDER_NUMBER; 

    echo "<br/>";
    
	echo "Payment success";
	//$_SESSION['cart'] = "";
	unset($_SESSION['cart']);
}
else {
    // Payment receipt was not valid, possible payment fraud attempt
    echo "Payment failed";
}
          
?>