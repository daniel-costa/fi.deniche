<?php

include_once('core.config.frontend.php');
    
    $items = 0;
    $total = 0;

    foreach($_SESSION['cart'] as $i) {
        $items += $i;
    }

if (isset($_POST['delivery_submit'])) {
    $AMOUNT = $_POST['amount'];
    $FIRSTNAME = $_POST['firstname'];
    $LASTNAME = $_POST['lastname'];
    $ADDRESS1 = $_POST['address1'];
    $ADDRESS2 = $_POST['address2'];
    $CITY    = $_POST['city'];
    $ZIPCODE = $_POST['zipcode'];
    $COUNTRY = $_POST['country'];
    $EMAIL = $_POST['email'];
    $PHONE = $_POST['phoneNumber'];
    
    $MERCHANT_AUTHENTICATION_HASH = "6pKF4jkv97zmqBJ3ZL8gUw5DfT2NMQ";
    $MERCHANT_ID = "13466";
    $ORDER_NUMBER = "123456";
    $REFERENCE_NUMBER = "";
    $ORDER_DESCRIPTION = "Testitilaus";
    $CURRENCY = "EUR";
    $RETURN_ADDRESS = "http://127.0.0.1/~NintuMac/fi.deniche/www.v2/success.php";
    $CANCEL_ADDRESS = "http://127.0.0.1/~NintuMac/fi.deniche/www.v2/cancel.php";
    $PENDING_ADDRESS = "";
    $NOTIFY_ADDRESS = "http://localhost/fi.deniche/www.v2/notify";
    $TYPE = "S1";
    $CULTURE = "en_US";
    $PRESELECTED_METHOD ="";
    $MODE = "1";
    $VISIBLE_METHODS = "";
    $GROUP = "";
    
    $RAW_AUTHCODE = $MERCHANT_AUTHENTICATION_HASH."|"
            . $MERCHANT_ID."|"
            . $AMOUNT."|"
            . $ORDER_NUMBER."|"
            . $REFERENCE_NUMBER."|"
            . $ORDER_DESCRIPTION."|"
            . $CURRENCY."|"
            . $RETURN_ADDRESS."|"
            . $CANCEL_ADDRESS."|"
            . $PENDING_ADDRESS."|"
            . $NOTIFY_ADDRESS."|"
            . $TYPE."|"
            . $CULTURE."|"
            . $PRESELECTED_METHOD."|"
            . $MODE."|"
            . $VISIBLE_METHODS."|"
            . $GROUP;

    $AUTHCODE = strtoupper(md5($RAW_AUTHCODE));
    
?>
<div class="payment-content">

    <div class="shipping-details">
        <h1>Your Shipping details</h1>
        <table>
            <tr><td>Name:</td><td><?php echo $FIRSTNAME.' '.$LASTNAME ;?></td></tr>
            <tr><td>Address 1:</td><td><?php echo $ADDRESS1 ;?></td></tr>
            <tr><td>Address 2:</td><td><?php echo $ADDRESS2 ;?></td></tr>
            <tr><td>City:</td><td><?php echo $CITY;?></td></tr>
            <tr><td>Zip code:</td><td><?php echo $ZIPCODE;?></td></tr>
            <tr><td>Country:</td><td><?php echo $COUNTRY;?></td></tr>
            <tr><td>Email:</td><td><?php echo $EMAIL;?></td></tr>
            <tr><td>Phone:</td><td><?php echo $PHONE;?></td> </tr>
        </table>
    </div>

    <div class="payment-details">
    <h1>Your payment details</h1>
    <table>
    <?php
        if ($items > 0) {
            foreach ($_SESSION['cart'] as $id => $amount) {
                $item = getProduct($id);
                $total += $item['price'] * $amount;
    ?>
        <tr>
            <td id="row-img"><img src="<?php echo $item['thumb']; ?>"/></td>
            <td><?php echo $item['model'];?>&nbsp;(<?php echo $item['color'];?>)</td>
            <td><?php echo $amount;?></td>
            <td><?php echo $item['price']; ?> &euro;</td>   
        </tr>
    <?php
            }
        } else {
    ?>
        <tr><td>Cart empty</td></tr>
    <?php
        }
    ?>
    </table>
    <div class="payment-total"><?php echo sprintf("%s %.2f &euro;", $lang['Total'], $total); ?></div>
    </div>
    
    
    <div class ="payment-form">
        <form action="https://payment.paytrail.com/" method="post">
            <input name="MERCHANT_ID" type="hidden" value="<?php echo $MERCHANT_ID; ?>">
            <input name="AMOUNT" type="hidden" value="<?php echo $AMOUNT; ?>">
            <input name="ORDER_NUMBER" type="hidden" value="<?php echo $ORDER_NUMBER; ?>">
            <input name="REFERENCE_NUMBER" type="hidden" value="<?php echo $REFERENCE_NUMBER; ?>">
            <input name="ORDER_DESCRIPTION" type="hidden" value="<?php echo $ORDER_DESCRIPTION; ?>">
            <input name="CURRENCY" type="hidden" value="<?php echo $CURRENCY; ?>">
            <input name="RETURN_ADDRESS" type="hidden" value="<?php echo $RETURN_ADDRESS; ?>">
            <input name="CANCEL_ADDRESS" type="hidden" value="<?php echo $CANCEL_ADDRESS; ?>">
            <input name="PENDING_ADDRESS" type="hidden" value="<?php echo $PENDING_ADDRESS; ?>">
            <input name="NOTIFY_ADDRESS" type="hidden" value="<?php echo $NOTIFY_ADDRESS; ?>">
            <input name="TYPE" type="hidden" value="<?php echo $TYPE; ?>">
            <input name="CULTURE" type="hidden" value="<?php echo $CULTURE; ?>">
            <input name="PRESELECTED_METHOD" type="hidden" value="<?php echo $PRESELECTED_METHOD; ?>">
            <input name="MODE" type="hidden" value="<?php echo $MODE; ?>">
            <input name="VISIBLE_METHODS" type="hidden" value="<?php echo $VISIBLE_METHODS; ?>">
            <input name="GROUP" type="hidden" value="<?php echo $GROUP; ?>">
            <input name="AUTHCODE" type="hidden" value="<?php echo $AUTHCODE; ?>">
            <input id="payment-btn" type="submit" value="PAY">
        </form>
    </div>
    <div class="paytrail-banner"><img src="https://img.paytrail.com/index.svm?id=13466&type=horizontal&cols=15&text=1&auth=f6483cce23771e8f"/></div>
</div>
    <?php
} else {
    print_r("Error in processing data.");
    exit;
}