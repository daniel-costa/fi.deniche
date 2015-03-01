<?php
include_once('core.config.frontend.php');
include_once('../backend/core.config.php');
require 'core/init.php';

// Here we get the data from the database
$mycart_items_num = 0;
$mycart_total_price = 0.00;

if (isset($_SESSION['cart_items'])) {
    $mycart_items_num = count($_SESSION['cart_items']);

    if ($mycart_items_num > 0) {
        $mycart_total_price = getCartTotalPrice($_SESSION['cart_items']);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include_once('UX.head.php'); ?>
        <title>Déniché</title>
    </head>
    <body class="checkout">
        <?php include_once('UX.section.header.php'); ?>

        <div class="continer-fluid wrapper">
            <div class="container">
                <div class="row">

                    <div class="col-xs-24 col-sm-4 col-md-5 col-lg-4 part-menu">
                        <div id="left-arrow">
                            <a href="index.php">
                                <span class="glyphicon glyphicon-chevron-left" style="margin-top:12px; font-size: 13px; color: #1C1C1C; text-transform: uppercase; font-weight: bold">
                                    <?php echo $lang['Return to store']; ?> 
                                </span>
                            </a> 
                        </div>
                    </div>

                    <div class="col-xs-24 col-sm-12 col-md-14 col-lg-16 part-content" style=" padding-right: 3px;">
                        <div class="myCart">

                            <div class="mycart_head">
                                <h4 class="myCart_text-center" style="">
                                    <?php echo $lang['Items in my cart']; ?> 
                                </h4>
                            </div>

                            <div class="mycart_content">

                                <table>
                                    <?php
                                    if ($mycart_items_num > 0) {
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
                                            ?>
                                            <tr>

                                                <td id="img_col"><img src="<?php echo $product['thumb']; ?>"/></td>
                                                <td id="qnt_col"><?php echo $n; ?></td>
                                                <td id="title_col">I love Mustache case</td>
                                                <td id="price_col"><?php echo $product['price']; ?> &euro;</td>   
                                                <td>
                                                    <a href="remove_cart_item.php?id=<?php echo $product['id']; ?>"
                                                               class="item_remove"><?php echo $lang['Remove']; ?>

                                                    </a>
                                                
                                                </td>
                                                
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo "<tr><td>No products</td></tr>";
                                    }
                                    ?>

                                </table>

                            </div>

                            <div class="promo">

                                <div class="promo_input" style="margin-top: 20px;">
                                    <h5>  <?php echo $lang['Have a promo code? Enter here']; ?></h5>
                                    <div class="col-lg-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" >
                                            <span class="input-group-btn">
                                                <button class="btn btn-default" type="button"
                                                        style=" height: 34px; border-bottom-right-radius: 20px; border-top-right-radius: 20px;
                                                        background-color:rgba(242, 250, 251, 1); outline: none">+</button>

                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="total_price">
                                    <?php echo $lang['Total']; ?> &nbsp; <?php echo $mycart_total_price . "&euro;" ?>

                                </div>
                            </div>

                            <!-- Error message of form-->
                            <div class="error_message" style="display: none;">

                            </div>

                            <div class="checkout_nav">
                                <ul>

                                    <li>
                                        <a class="link_nav_1" href="#" rel="shipping">  <?php echo $lang['Shipping']; ?></a>
                                    </li>
                                    <li>
                                        <hr style="border:-1px solid #848484; width: 220px; text-align: center; margin-left: 20px; margin-right: 20px;"/>
                                    </li>

                                    <li>
                                        <a class="link_nav_2" href="#" rel="payment">  <?php echo $lang['Payment']; ?></a>
                                    </li>
                                    <li>
                                        <hr style="border:-1px solid #848484; width: 200px; margin-left: 20px; margin-right: 20px; margin-top: 20px;"/>
                                    </li>
                                    <li>
                                        <a class="link_nav_3" href="#" rel="receipt">  <?php echo $lang['Receipt']; ?></a>
                                    </li>
                                </ul>
                            </div>

                            <div id="first_nav">

                                <form class="form" method="post" name="form" onsubmit="return validateForm();">

                                    <input name="firstname" type="text" id="first_name" placeholder="<?php echo $lang['First name']; ?>" class="required"/>
                                    <input name="lastname" type="text" id="last_name" placeholder="<?php echo $lang['Last name']; ?>" class="required"/>
                                    <input name="address1" type="text" id="address1" placeholder="<?php echo $lang['Address line 1']; ?>" class="required"/>
                                    <input name="address2" type="text" id="address2" placeholder="<?php echo $lang['Address line 2']; ?>"/>
                                    <input name="city"  type="text" id="city" placeholder="<?php echo $lang['City']; ?>" class="required"/>
                                    <input name="zipcode" type="text" id="zip" placeholder="<?php echo $lang['Zip code']; ?>" class="required"/>
                                    <select name="country" placeholder="Choose" style="width:280px">
                                        <option>Finland</option>
                                        <option>Sweden</option>
                                        <option>Norway</option>
                                    </select><br>
                                    <input name="submit" class="btn" id="btn" type="submit" value="<?php echo $lang['Continue']; ?>" />

                                </form>

                            </div>


                            <div id="second_nav" style="display: none;">

                                <div class="bank_logo">
                                    <a target="_blank" href="#"><img src="../www.v2/images/nordea.png" alt="nordea"></a>
                                    <div class="desc">Nordea</div>
                                </div>

                                <div class="bank_logo">
                                    <a target="_blank" href="#"><img src="../www.v2/images/osuus.png" alt="osuuspankki"></a>
                                    <div class="desc">Osuuspankki</div>
                                </div>

                                <div class="bank_logo">
                                    <a target="_blank" href="#"><img src="../www.v2/images/aktia.png" alt="aktia"></a>
                                    <div class="desc">Aktia, Nooa, POP</div>
                                </div>

                                <div class="bank_logo">
                                    <a target="_blank" href="#"><img src="../www.v2/images/ape.png" alt="ape"></a>
                                    <div class="desc">Ape-Kukkaro</div>
                                </div>

                                <div class="bank_logo">
                                    <a target="_blank" href="#"><img src="../www.v2/images/sampo.png" alt="sampo"></a>
                                    <div class="desc">Sampo Pankki</div>
                                </div>

                                <div class="bank_logo">
                                    <a target="_blank" href="#"><img src="../www.v2/images/handel.png" alt="handelsbanken"></a>
                                    <div class="desc">Handelsbanken</div>
                                </div>

                                <div class="bank_logo">
                                    <a target="_blank" href="#"><img src="../www.v2/images/visa_master.png" alt="luottokortit"></a>
                                    <div class="desc">Luottokortit</div>
                                </div>

                                <div class="bank_logo">
                                    <a target="_blank" href="#"><img src="../www.v2/images/alandsbanken.png" alt="Ålandsbanken"></a>
                                    <div class="desc">Ålandsbanken</div>
                                </div>

                                <div class="bank_logo">
                                    <a target="_blank" href="#"><img src="../www.v2/images/tapiola.png" alt="tapiola"></a>
                                    <div class="desc">Tapiola Pankki</div>
                                </div>

                                <div class="bank_logo">
                                    <a target="_blank" href="#"><img src="../www.v2/images/jousto.png" alt="juostoraha"></a>
                                    <div class="desc">Juostoraha lasku ja osamasku</div>
                                </div>

                                <div class="bank_logo">
                                    <a target="_blank" href="#"><img src="../www.v2/images/s-pankki.png" alt="s-panki"></a>
                                    <div class="desc">S-Pankki</div>
                                </div>

                            </div>

                            <div id="third_nav" style="display: none">
                                <h1>Receipt</h1>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include_once('UX.section.footer.php'); ?>
        <?php include_once('UX.scripts.php'); ?>

        <script>
            
            $('.item_remove').click(function (e) {

                $(this).closest('tr').remove();
                //$('.total_price').html("<?php echo $mycart_total_price . "&euro;" ?>");
                return false;
                 e.preventDefault();

            });
         

            $(".link_nav_1").on('click', function (e) {
                //hide other two divs
                $("#second_nav").css("display", "none");
                $("#third_nav").css("display", "none");
                //display the nav to show
                $("#first_nav").css("display", "inline");
                return false;
                e.preventDefault();
            });
            $(".link_nav_2").on('click', function (e) {
                $("#first_nav").css("display", "none");
                $("#third_nav").css("display", "none");
                $("#second_nav").css("display", "inline");
                return false;
                e.preventDefault();
            });
            $(".link_nav_3").on('click', function (e) {
                $("#first_nav").css("display", "none");
                $("#second_nav").css("display", "none");
                $("#third_nav").css("display", "inline");
                return false;
                e.preventDefault();
            });
            function validateForm() {
                var all_fields = document.getElementById('first_name', 'last_name', 'address1', 'city', 'zip');
                var firstname = document.getElementById('first_name');
                var lastname = document.getElementById('last_name');
                var address = document.getElementById('address1');
                var city = document.getElementById('city');
                var zip = document.getElementById('zip');
                if (all_fields.value.length === 0) {
                    $(".error_message").css("display", "inline-block");
                    $(".error_message").html("1. Please fill in your shipping details.")
                            .show();
                    return false;
                } else if (firstname.value.length === 0) {
                    $(".error_message").css("display", "inline-block");
                    $(".error_message").html("1. Please fill in your shipping details. First name is missing.")
                            .show();
                    return false;
                } else if (lastname.value.length === 0) {
                    $(".error_message").css("display", "inline-block");
                    $(".error_message").html("1. Please fill in your shipping details. Last name is missing.")
                            .show();
                    return false;
                } else if (address.value.length === 0) {
                    $(".error_message").css("display", "inline-block");
                    $(".error_message").html("1. Please fill in your shipping details. Address is missing.")
                            .show();
                    return false;
                } else if (city.value.length === 0) {
                    $(".error_message").css("display", "inline-block");
                    $(".error_message").html("1. Please fill in your shipping details. Address is missing.")
                            .show();
                    return false;
                } else if (zip.value.length === 0) {
                    $(".error_message").css("display", "inline-block");
                    $(".error_message").html("1. Please fill in your shipping details. Zip code is missing.")
                            .show();
                    return false;
                } else {
                    $(".error_message").css("display", "none");
                }

            }

        </script>
    </body>
</html>