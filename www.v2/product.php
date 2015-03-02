<?php
	
	include_once('core.config.frontend.php');


	if (!isset($_GET['id'])) {
		header("Location: index.html");
		exit;
	}

	$product_id = intval($_GET['id']);

	$product = getProduct($product_id);

	if (count($product) < 1) {
		header("Location: index.html");
		exit;
	}

	$images_id = getProductImages($product_id);
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once('UX.head.php'); ?>
		<title>Déniché</title>
	</head>

	<body class="info">
		<?php include_once('UX.section.header.php'); ?>

		<div class="container-fluid wrapper">
			<div class="container">
				<div class="row">

					<div class="col-xs-24 col-sm-4 col-md-5 col-lg-4 part-menu">
						<div id="left-arrow">
							<a href="index.php"> <span
									class="glyphicon glyphicon-chevron-left"
									style="margin-top: 12px; font-size: 15px; color: #ef2146;"> <?php echo $lang['BACK'] ?>
								</span> </a>
						</div>
					</div>

					<!-- Middle part-->
					<div class="col-xs-24 col-sm-12 col-md-14 col-lg-16 part-content"
						 style="padding-right: 3px;">

						<div class="title">
							<h3>Title text here</h3>
						</div>

						<div class="slide_show_main_image">
							<img src="binaries/products/img-<?php echo $images_id[0]; ?>.png" alt="Placeholder" class="custom" style="background-color: #<?php echo $product['color']; ?>">
						</div>
						<div class="slideshow_thumbnails">
							<ul>
								<?php
								foreach ($images_id as $image_id) {
									?>
									<li><a href="binaries/products/img-<?php echo $image_id; ?>.png"><img
												src="binaries/products/img-<?php echo $image_id; ?>-thumb.png"
												alt="Thumbnails"
												style="height: 60px; width: 60px; display: inline"> </a></li>
										<?php
									}
									?>
							</ul>
						</div>

						<div class="product_details">
							<h3>Title text here</h3>
							<p>Hurricane Katrina was the costliest natural disaster, as well
								as one of the five deadliest hurricanes, in the history of the
								United States. The storm is also currently ranked as the third
								most intense United States landfalling tropical cyclone, behind
								only the 1935 Labor Day hurricane and Hurricane Camille in 1969.
								Overall, at least 1,833 people died in the hurricane and
								subsequent floods, making it the deadliest United States
								hurricane since the 1928 Okeechobee hurricane.</p>

							<div class="row">
								<div class="col-xs-3">
									<h5 id="price-label"
										style="color: #FA5882; margin: 25px 0 0 10px; font-size: medium; font-weight: bold; width: 70px">
											<?php echo $product['price'] ?>
										&euro;
									</h5>
								</div>

								<div class="col-xs-3" style="margin-left: 40px;">
									<h6
										style="margin: 25px 0 0 75px; width: 50px; font-size: medium; color: #BDBDBD;">QTY:</h6>
								</div>

								<div class="col-xs-3" style="float: right; width:70px; height: 100%; border:1px solid; 
									 border-color: #E6E6E6; background-color: #<?php echo $product['color']; ?>">

									<div id="up-arrow"
										 onclick="upArrowClicked(<?php echo $product['stock'] . ", " . $product['price']; ?>)">
										<span class="glyphicon glyphicon-chevron-up"
											  style="margin-left: 13px; font-size: 10px; cursor:pointer; color: #BDBDBD;"></span>
									</div>

									<form action="add_to_cart.php"  method="get">

										<div id="quantity" style="margin-left: 13px; color: #BDBDBD;">
											<input type="text"  style="border:none; background: #ffffff;" value="1" size="1"  name="num" disabled/>
										</div>

										<div id="down-arrow"
											 onclick="downArrowClicked(<?php echo $product['price']; ?>)">
											<span class="glyphicon glyphicon-chevron-down"
												  style="margin-left: 13px; cursor:pointer; font-size: 10px; color: #BDBDBD;"></span>
										</div>

								</div>
							</div>
							 <input type="hidden" name="id" value="<?php echo $product['id']; ?>"/>

							<input type="submit" value="<?php echo $lang['Add to cart']; ?>" class="add_to_cart"/>
							
<!--							  <a href="add_to_cart.php?id=<?php echo $product['id'] . "&num=1"; ?>" class="add_to_cart">
							<?php echo $lang['Add to cart'] ?></a>-->
						   

							</form>



						</div>
					</div>

					<!--   Right side-->
					<?php include 'cart.php'; ?>
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
