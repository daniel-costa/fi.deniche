<?php
	
	include_once('core.config.frontend.php');
	
	$items = 0;
	$total = 0;

	foreach($_SESSION['cart'] as $i) {
		$items += $i;
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
						<ul class="list-unstyled menu">
							<li><a href="index.html">&lt; home</a></li>
						</ul>
					</div>

					<div class="col-xs-24 col-sm-12 col-md-14 col-lg-16 part-content" >
						<div class="myCart">

							<div class="mycart_head">
								<h4 class="myCart_text-center">
									<?php echo $lang['Items in my cart']; ?> 
								</h4>
							</div>

							<div class="mycart_content">

								<table>
									<?php
										if ($items > 0) {
											foreach ($_SESSION['cart'] as $id => $amount) {
												$item = getProduct($id);
												$total += $item['price'] * $amount;
									?>
										<tr class="mycart_row">
											<td id="img_col"><img src="<?php echo $item['thumb']; ?>"/></td>
											<td id="qnt_col">
												<div class="circleBase-quantity"><?php echo $amount;?></div>
											</td>
											<td id="title_col">
												<h2><?php echo $item['model']; ?></h2>
												<h3><?php echo $item['color']; ?></h3>
											</td>
											<td id="price_col"><?php echo $item['price']; ?> &euro;</td>   
											<td>
												<a href="cart-remove-<?php echo $item['id']; ?>.html" class="item_remove">
													<?php echo $lang['Remove']; ?>
												</a>
											</td>
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

							</div>

							<div class="promo">
								<div class="promo_input">
									<h5><?php echo $lang['Have a promo code? Enter here'];?></h5>
									<div class="col-lg-6">
										<div class="input-group">
											<input type="text" class="form-control" />
											<span class="input-group-btn">
												<button class="btn btn-default" type="button">
													<span class="glyphicon glyphicon-plus" style="color:#848484"></span>
												</button> 
											</span>  
											
										</div>
									</div>
								</div>

								<div class="total_price">
									<?php echo sprintf("%s %.2f &euro;", $lang['Total'], $total); ?> 
								</div>
							</div>

							<!-- Error message of form-->
							<div class="error_message" style="display: none;"></div>
							<div class="payment_details">
							<div class="checkout_nav">
								<ul>

									<li>
										<a class="link_nav_1" href="#" rel="shipping">  <?php echo $lang['Shipping']; ?></a>
									</li>
									

									<li>
										<a class="link_nav_2" href="#" rel="payment">  <?php echo $lang['Payment']; ?></a>
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
									<select name="country" placeholder="Choose" id="country">
										<option>Finland</option>
										<option>Sweden</option>
										<option>Norway</option>
									</select><br>
									<input name="submit" class="btn" id="btn" type="submit" value="<?php echo $lang['Continue']; ?>" />

								</form>

							</div>


							<div id="second_nav" style="display: none;">
								<h1>payment</h1>

							</div>

							<div id="third_nav" style="display: none">
								<h1>Receipt</h1>

							</div>
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
				validateForm();
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