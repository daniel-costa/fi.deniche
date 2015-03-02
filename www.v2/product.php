<?php
	
	include_once('core.config.frontend.php');


	if (!isset($_GET['id'])) {
		back();
	}

	$id = intval($_GET['id']);
	
	if ( !$product = getProduct($id) ) {
		back();
	}

	$images_id = getProductImages($id);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once('UX.head.php'); ?>
		<title>Déniché</title>
	</head>

	<body class="product">
		<?php include_once('UX.section.header.php'); ?>

		<div class="container-fluid wrapper">
			<div class="container">
				<div class="row">

					<div class="col-xs-24 col-sm-4 col-md-5 col-lg-4 part-menu">
						<ul class="list-unstyled menu">
							<li><a href="index.html">&lt; home</a></li>
						</ul>
					</div>

					<!-- Middle part-->
					<div class="col-xs-24 col-sm-12 col-md-14 col-lg-16 part-content">

						<h1>Title text here</h1>

						<div class="slide_show_main_image">
							<img src="binaries/products/img-<?php echo $images_id[0]; ?>.png" alt="Placeholder" class="custom" style="background-color: #<?php echo $product['hexa_light']; ?>">
						</div>

						<div class="slideshow_thumbnails">
							<ul>
								<?php foreach ($images_id as $image_id) { ?>
									<li>
										<a href="binaries/products/img-<?php echo $image_id; ?>.png"><img
												src="binaries/products/img-<?php echo $image_id; ?>-thumb.png"
												alt="Thumbnails"
												style="height: 60px; width: 60px; display: inline">
										</a>
									</li>
								<?php } ?>
							</ul>
						</div>

						<div class="product_details">
							<h2>Color name</h2>
							<p>description</p>


							<form action="add_to_cart.php"  method="get">
								<div class="row">
									<div class="col-xs-3">
										<h5 id="price-label" style="color: #FA5882; margin: 25px 0 0 10px; font-size: medium; font-weight: bold; width: 70px">
											<?php printf("%.2f &euro;", $product['price']) ?>
										</h5>
									</div>

									<div class="col-xs-3" style="margin-left: 40px;">
										<h6 style="margin: 25px 0 0 75px; width: 50px; font-size: medium; color: #BDBDBD;">QTY:</h6>
									</div>

									<div class="col-xs-3" style="float: right; width:70px; height: 100%; border:1px solid; border-color: #E6E6E6; background-color: #<?php echo $product['color']; ?>">

										<div id="up-arrow" onclick="upArrowClicked(<?php echo $product['stock'] . ", " . $product['price']; ?>)">
											<span class="glyphicon glyphicon-chevron-up" style="margin-left: 13px; font-size: 10px; cursor:pointer; color: #BDBDBD;"></span>
										</div>

										<div id="quantity" style="margin-left: 13px; color: #BDBDBD;">
											<input type="text"  style="border:none; background: #ffffff;" value="1" size="1"  name="num" disabled/>
										</div>

										<div id="down-arrow" onclick="downArrowClicked(<?php echo $product['price']; ?>)">
											<span class="glyphicon glyphicon-chevron-down" style="margin-left: 13px; cursor:pointer; font-size: 10px; color: #BDBDBD;"></span>
										</div>
									</div>
								</div>

								<input type="hidden" name="id" value="<?php echo $product['id']; ?>"/>
								<input type="submit" value="<?php echo $lang['Add to cart']; ?>" class="add_to_cart"/>

							</form>
						</div>
					</div>

					<!--   Right side-->
					<?php include 'UX.cart.php'; ?>
				</div>
			</div>
		</div>

		<?php include_once('UX.section.footer.php'); ?>
		<?php include_once('UX.scripts.php'); ?>
		<script>

			$(document).ready(function () {
				$('.slideshow_thumbnails').simpleGal({
					mainImage: '.custom'
				});

				//up arrow click function
			});

			function upArrowClicked(max, price) {
				var currentNo = parseInt($("#quantity input:text").val());

				if (currentNo < max) {
					var newVal = currentNo + 1;
					$("#quantity input:text").val(newVal);
					var newPrice = parseFloat(Math.round((price * newVal) * 100) / 100).toFixed(2) + "\u20AC";
					$("#price-label").text(newPrice);

				}
			}

			//down arrow click function
			function downArrowClicked(price) {
				var currentNo = parseInt($("#quantity input:text").val());

				if (currentNo > 1) {
					var newVal = currentNo - 1;
					$("#quantity input:text").val(newVal);
					var newPrice = parseFloat(Math.round((price * newVal) * 100) / 100).toFixed(2) + "\u20AC";
					$("#price-label").text(newPrice);

				}
			}

		</script>
	</body>
</html>
