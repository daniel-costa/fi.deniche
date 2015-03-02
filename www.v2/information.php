<?php
	
	include_once('core.config.frontend.php');

	$products = array();
	$p = getPagination("SELECT p.id, m.name, p.price, p.bargain, c.name, c.hexa_light, (SELECT id FROM product_image WHERE thumb = 1 and product = p.id LIMIT 0, 1)
						FROM product p
						LEFT JOIN model m 
						ON m.id = p.model
						LEFT JOIN color c
						ON c.id = p.color
						WHERE p.online = 1
						ORDER BY m.name", null, null, 1, 100);
	$stmt = $p['stmt'];
	$stmt->execute();
	$stmt->bind_result($id, $model, $price, $bargain, $color, $hexa_light, $thumb);
	while($stmt->fetch()) {
		$products[] = array(
			'id' => $id,
			'model' => $model,
			'color' => $color,
			'price' => $price,
			'bargain' => $bargain,
			'hexa_light' => empty($hexa_light) ? 'F2FAFB' : $hexa_light,
			'thumb' => "binaries/products/img-$thumb-thumb.png"
		);
	}
	$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once('UX.head.php'); ?>
		<title>Déniché</title>
	</head>
	<body class="info">
		<?php include_once('UX.section.header.php'); ?>

		<div class="continer-fluid wrapper">
			<div class="container">
				<div class="row">
					<div class="col-xs-24 col-sm-4 col-md-5 col-lg-4 part-menu">
						<ul class="list-unstyled menu">
							<li><a href="index.html">&lt; home</a></li>
						</ul>
					</div>


					<div class="col-xs-24 col-sm-20 col-md-19 col-lg-16 part-content">
						
						<h1 id="product-quality" class="no-margin-top">Products &amp; quality</h1>
						<h2>Smartphones &amp; models</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
						<h2>Tests</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
						<h2>Quality</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>

						<h1 id="order">Order</h1>
						<h2>Modify or cancel an order</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
						<h2>Checkout assistance</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
						<h2>Can I order by phone?</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
						<h2>Promo code complications</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
						<h2>Out of stock</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>

						<h1 id="shipping">Shipping</h1>
						<h2>Finland shipping</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
						<h2>International shipping/taxes</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
						<h2>Tracking</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
						
						<h1 id="returns">Return a product</h1>
						<h2>Returns policy</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
						<h2>Costs coverage</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
						<h2>Return address</h2>
						<p>
							<strong>Déniché</strong><br/>
							Hietalahdenkatu 9 B 43<br/>
							00180 Helsinki<br/>
							Finland
						</p>
						<h2>Refunds policy</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>

						<h1 id="bulk">Volume &amp; Bulk</h1>
						<h2>Discounts</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
						<h2>OEM &amp; branding</h2>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent et erat ac tortor sagittis egestas. Praesent porttitor adipiscing velit vel condimentum. Sed varius, mi vitae fermentum gravida, tortor mauris placerat felis, sed lacinia lorem mi vel quam. Donec eleifend semper velit et suscipit. Etiam nisl magna, consequat vitae dapibus quis, eleifend sed mauris. Nulla fringilla ac nulla ullamcorper imperdiet. </p>
					</div>
				</div>
			</div>
		</div>

		<?php include_once('UX.section.footer.php'); ?>
		<?php include_once('UX.scripts.php'); ?>
	</body>
</html>