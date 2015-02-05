<?php
	
	include_once('core.config.frontend.php');
	include_once('../backend/core.config.php');

	if(!isset($_SESSION['filters'])) {
		$_SESSION['filters'] = array(
			'models' => array(),
			'colors' => array(),
			'attributes' => array(),
			'thickness' => null
		);
	}

	$products = array();
	$p = getPagination("SELECT p.id, m.name, m.id, m.thickness, p.price, p.bargain, c.name, c.hexa_light, (SELECT id FROM product_image WHERE thumb = 1 and product = p.id LIMIT 0, 1)
						FROM product p
						LEFT JOIN model m  ON m.id = p.model
						LEFT JOIN color c ON c.id = p.color
						WHERE p.online = 1
						ORDER BY m.name", null, null, 1, 200);
	$stmt = $p['stmt'];
	$stmt->execute();
	$stmt->bind_result($id, $model, $model_id, $thickness, $price, $bargain, $color, $hexa_light, $thumb);

	while($stmt->fetch()) {
		if(count($_SESSION['filters']['models']) == 0 or in_array($model_id, $_SESSION['filters']['models'])) {
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
	}
	$stmt->close();

	$models = array();
	foreach(getModels() as $model) {
		$models[] = array(
			'id' => $model['id'],
			'name' => $model['name'],
			'link' => 'model-'.str2url($model['name']).'-'.$model['id'].'.html',
			'class' => in_array($model['id'], $_SESSION['filters']['models']) ? ' active ' : ''
		);
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<?php include_once('UX.head.php'); ?>
		<title>Déniché</title>
	</head>
	<body class="home">
		<?php include_once('UX.section.header.php'); ?>

		<div class="continer-fluid wrapper">
			<div class="container">
				<div class="row">
					<div class="col-xs-24 col-sm-6 col-md-5 col-lg-4 part-menu">
						<div class="filters">
							<div class="bloc">
								<h3>Model</h3>
								<div class="content">
									<ul class="list-unstyled">
										<?php 
											foreach($models as $item) {
										?>
										<li class="<?php echo $item['class']; ?>"><a href="<?php echo $item['link']; ?>"><?php echo $item['name']; ?></a></li>
										<?php
											}
										?>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<div class="col-xs-24 col-sm-12 col-md-14 col-lg-16 part-content">
						<?php 
							foreach($products as $item) {
						?>

						<div class="product col-xs-12 col-md-8 col-lg-6" d-model="">
							<div class="inner" style="background-color:#<?php echo $item['hexa_light']; ?>">
								<h2><?php echo $item['model']; ?></h2>
								<h3><?php echo $item['color']; ?></h3>
								<div class="preview">
									<img src="<?php echo $item['thumb']; ?>"/>
								</div>
								<p class="price"><?php echo $item['price']; ?>&euro;</p>
								<a href="" class="add-to-cart">Add to cart</a>
							</div>
						</div>

						<?php
							}
						?>
					</div>
					<div class="col-xs-24 col-sm-6 col-md-5 col-lg-4 part-menu">
						<div class="cart">
							<h4 class="text-center">
								Items in<br/>
								cart (<span>0</span>)
							</h4>
							<div class="content">
								<img class="arrow" src="images/arrow-top-black.png" />
								<p class="text-center">Add item to cart from the selection of phones to your right.</p>
							</div>
							<h3 class="text-center">Total 0.00€</h3>
							<button class="btn checkout text-center">Checkout</button>
						</div>
					</div>
				</div>
				<div class="row infobox">
					<div class="part left hidden-xs col-sm-2 col-sm-offset-1 col-md-offset-3 col-lg-offset-4"></div>
						<div class="part center col-xs-24 col-sm-18 col-md-14 col-lg-12">
							<h3 class="text-center">Additional Info</h3>
							<p class="text-center">
								Shipping in <strong>24h</strong> <span class="sep">|</span>	
								All products <strong>tested</strong> in Finland <br class="hidden-xs"/>
								<span class="sep visible-xs">|</span>
								<strong>Seven day</strong> return policy <span class="sep">|</span>
								<strong>International</strong> shipping<br class="hidden-xs"/>
								<span class="sep visible-xs">|</span>
								<strong>Easy</strong> payment methods <span class="sep">|</span>
								<strong>No account</strong> needed<br class="hidden-xs"/>
								<span class="sep visible-xs">|</span>
								<strong>60-second</strong> checkout
							</p>
						</div>
						<div class="part right hidden-xs col-sm-2"></div>
				</div>
			</div>
		</div>

		<?php include_once('UX.section.footer.php'); ?>
		<?php include_once('UX.scripts.php'); ?>
	</body>
</html>