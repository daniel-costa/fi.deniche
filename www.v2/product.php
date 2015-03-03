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
					<div class=" gallery col-xs-24 col-sm-12 col-md-14 col-lg-16 part-content">

						<h1><?php echo $product['model'];?></h1>

						<div class="slide_show_main_image" style="background-color: #<?php echo $product['hexa_light']; ?>">
							<img src="binaries/products/img-<?php echo $images_id[0]; ?>.png" alt="Placeholder" class="custom">
						</div>

						<div class="slideshow_thumbnails">
							<ul>
								<?php foreach ($images_id as $image_id) { ?>
									<li style="background-color: #<?php echo $product['hexa_light']; ?>">
										<a href="binaries/products/img-<?php echo $image_id; ?>.png"><img
												src="binaries/products/img-<?php echo $image_id; ?>-thumb.png"
												alt="Thumbnails" class="thumbnails">
										</a>
									</li>
								<?php } ?>
							</ul>
						</div>

						<div class="product_details">
							<h2><?php echo $product['color'];?></h2>
							<p>description</p>


							<form action="cart.add.php"  method="get">
								<div class="row">
									<div class="price-label col-xs-3">
										<h5 id="price-label">
											<?php printf("%.2f &euro;", $product['price']) ?>
										</h5>
									</div>

									<div class=" quantity_label col-xs-3">
										<h6>QTY:</h6>
									</div>

									<div class="arrow col-xs-3">

										<div id="up-arrow" onclick="upArrowClicked(<?php echo $product['stock'] . ", " . $product['price']; ?>)">
											<span class="up-arrow glyphicon glyphicon-chevron-up"></span>
										</div>

										<div id="quantity">
											<input type="text" class="quantity_num" value="1" size="1"  name="num" disabled/>
										</div>

										<div id="down-arrow" onclick="downArrowClicked(<?php echo $product['price']; ?>)">
											<span class="down-arrow glyphicon glyphicon-chevron-down"> </span>
										</div>
									</div>
								</div>

								<input type="hidden" name="id" value="<?php echo $product['id']; ?>"/>
								<input type="submit" value="<?php echo $lang['Add to cart']; ?>" class="add-product-cart"/>

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
				document.write('Up arrow clicke');
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
