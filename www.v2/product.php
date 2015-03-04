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
					<div class="col-xs-24 col-sm-11 col-md-13 col-lg-15 part-content">

						<h1>We present to you our product range the <span><?php echo $product['model'];?></span> in his version <span><?php echo $product['color'];?></span></h1>

						<div class="slideshow">
							<div class="main" style="background-color: #<?php echo $product['hexa_light']; ?>">
								<img src="binaries/products/img-<?php echo $images_id[0]; ?>.png" alt="Placeholder" class="preview">
							</div>

							<div class="thumbs">
								<ul>
									<?php foreach ($images_id as $image_id) { ?>
										<li style="background-color: #<?php echo $product['hexa_light']; ?>">
											<a href="binaries/products/img-<?php echo $image_id; ?>.png">
												<img src="binaries/products/img-<?php echo $image_id; ?>-thumb.png"/>
											</a>
										</li>
									<?php } ?>
								</ul>
								<div class="clearfix"></div>
							</div>
						</div>


						<div class="details">
							<h2>Information about our iPhone case the <span><?php echo $product['model'];?></span></h2>
							<p>
								Aliquam rhoncus turpis a metus pulvinar, ut rutrum massa suscipit. Nullam dictum, ante in 
								tincidunt tincidunt, dolor erat aliquet turpis, volutpat fermentum felis lorem non nulla. 
								Duis quis nibh at nunc blandit tempus adipiscing vitae lorem. Integer auctor pellentesque 
								diam, nec tempor nisi feugiat eget. s turpis a metus pulvinar, ut rutrum massa suscipit. 
								Nullam dictum, ante in tincidunt tincidunt, dolor erat ali
							</p>


							<form action="cart.add.php"  method="get">
								<div class="add-to-cart container-fluid col-lg-10 col-lg-offset-7">
									<div class="row first">
										<div class="price col-lg-11"><?php printf("%.2f &euro;", $product['price']) ?></div>

										<div class="quantity-label col-xs-7">QTY:</div>

										<div class="controls col-xs-6">
											<div class="arrow up">
												<span class="up-arrow glyphicon glyphicon-chevron-up"> </span>
											</div>
											<div class="quantity">1</div>
											<div class="arrow down">
												<span class="down-arrow glyphicon glyphicon-chevron-down"> </span>
											</div>
										</div>
									</div>
									<div class="row second">
										<div class="col-xs-24">
											<input type="submit" value="<?php echo $lang['Add to cart']; ?>" />
											<input type="hidden" name="amt" value="1" />
											<input type="hidden" name="id" value="<?php echo $product['id']; ?>" />
											<input type="hidden" name="price" value="<?php echo $product['price']; ?>" />
										</div>
									</div>
								</div>


							</form>
						</div>
					</div>

					<div class="hidden-xs col-sm-1"> </div>

					<!--   Right side-->
					<?php include 'UX.cart.php'; ?>
				</div>
			</div>
		</div>

		<?php include_once('UX.section.footer.php'); ?>
		<?php include_once('UX.scripts.php'); ?>
	</body>
</html>
