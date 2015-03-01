<?php
include_once('core.config.frontend.php');
include_once('../backend/core.config.php');
require 'core/init.php';

$cart_items_num = 0;
$total_price = 0.00;

if (isset($_SESSION['cart_items'])) {
    $cart_items_num = count($_SESSION['cart_items']);


    if ($cart_items_num > 0) {
        $total_price = getCartTotalPrice($_SESSION['cart_items']);
    }
}
?>
<div class="col-xs-24 col-sm-6 col-md-5 col-lg-4 part-menu">
    <div class="cart">
        <h4 class="text-center">
            <?php echo $lang['Items in'] ?>
            <br />
            <?php echo $lang['cart'] ?>
            (<span><?php echo $cart_items_num; ?></span>)
        </h4>
        <div class="content">
            <img class="arrow" src="images/arrow-top-black.png" />

            <?php
            if ($cart_items_num > 0) {
                ?>
                <ul class="cart_item_list">
                    <?php
                    $array = $_SESSION['cart_items'];
                    $new_array = array();

                    foreach ($array as $key => $value) {
                        if (isset($new_array[$value])) {
                            $new_array[$value] += 1;
                        } else {
                            $new_array[$value] = 1;
                        }
                    }

                    foreach ($new_array as $prod_id => $n) {
                        $product = getProduct($prod_id);
                        $price_label = "";
                        if ($n > 1) {
                            $price_label = $n . "x" . $product['price'] . "&euro;";
                        } else {
                            $price_label = $product['price'] . "&euro;";
                        }
                        ?>
                        <li class="cart_preview">

                            <a href="remove_cart_item.php?id=<?php echo $product['id']; ?>"
                               class="item_remove">
                                <span class="glyphicon glyphicon-remove" 
                                      style="color: #FFFFFF; background-color: rgba(227, 36, 45, 1);
                                      "></span>
                            </a> 

                            <img src="<?php echo $product['thumb']; ?>"  /> 

                            <span style="color: rgba(227, 36, 45, 1); font-size: 18px; font-family: Avenir Next">
                                <?php
                                echo $price_label;
                                ?>
                            </span> 

                        </li>
                        <?php
                    }
                    ?>
                </ul>
                <?php
            }
            ?>
        </div>
        <h3 class="text-center">
            <?php echo $lang['Total'] . " " . $total_price . "&euro;" ?>
        </h3>
        <button class="btn checkout text-center" onclick="location.href = 'checkout.php';">
            <?php echo $lang['Checkout'] ?>
        </button>
    </div>
</div>


