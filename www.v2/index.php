<?php
	
	include_once('core.config.frontend.php');

	if (!isset($_SESSION['filters'])) {
		$_SESSION['filters'] = array(
			'models' => array(),
			'colors' => array(),
			'attributes' => array(),
			'thickness' => null
		);
	}

	$products = array();
	$p = getPagination("SELECT p.id, m.name, m.id, p.price, p.bargain, c.name, c.hexa_light, c.hexa_original, (SELECT id FROM product_image WHERE thumb = 1 and product = p.id LIMIT 0, 1)
							FROM product p
							LEFT JOIN model m  ON m.id = p.model
							LEFT JOIN color c ON c.id = p.color
							WHERE p.online = 1
							ORDER BY m.name", null, null, 1, 200);
	$stmt = $p['stmt'];
	$stmt->execute();
	$stmt->bind_result($id, $model, $model_id, $price, $bargain, $color, $hexa_light, $hexa_original, $thumb);

	while ($stmt->fetch()) {
		if (count($_SESSION['filters']['models']) == 0 or in_array($model_id, $_SESSION['filters']['models'])) {
			$products[] = array(
				'id' => $id,
				'model' => $model,
				'color' => $color,
				'price' => $price,
				'bargain' => $bargain,
				'hexa_light' => empty($hexa_light) ? 'F2FAFB' : $hexa_light,
				'hexa_original' => empty($hexa_light) ? 'F2FAFB' : $hexa_original,
				'thumb' => "binaries/products/img-$thumb-thumb.png"
			);
		}
	}
	$stmt->close();

	$models = array();
	foreach (getModels() as $model) {
		$models[] = array(
			'id' => $model['id'],
			'name' => $model['name'],
			'link' => 'model-' . str2url($model['name']) . '-' . $model['id'] . '.html',
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
						<!--Left side-->
						<div class="filters">
							<div class="bloc">
								<h3><?php echo $lang['Model'] ?></h3>
								<div class="content">
									<ul class="list-unstyled">
										<?php foreach ($models as $item) { ?>
											<li class="<?php echo $item['class']; ?>"><a href="<?php echo $item['link']; ?>"><?php echo $item['name']; ?></a></li>
										<?php } ?>
									</ul>
								</div>
							</div>
						</div>
					</div>

					<div class="col-xs-24 col-sm-12 col-md-14 col-lg-16 part-content"> 
						<?php foreach ($products as $item) { ?>
							<div class="product col-xs-12 col-md-8 col-lg-6">
								<div class="inner" style="background-color:#<?php echo $item['hexa_light']; ?>">
									<h2><?php echo $item['model']; ?></h2>
									<h3><?php echo $item['color']; ?></h3>
									<div class="preview">
										<img src="<?php echo $item['thumb']; ?>"/>
									</div>
									<p class="price"><?php echo $item['price']; ?>&euro;</p>
									<a href="cart-add-<?php echo $item['id']; ?>.html" class="add-to-cart">Add to cart</a>
								</div>
							</div>
						<?php } ?>
					</div>

					<!--   Right side-->
					<?php include 'UX.cart.php'; ?> 

				</div>
				<div class="row infobox"> <!--Bottom part-->
					<div class="part left hidden-xs col-sm-2 col-sm-offset-1 col-md-offset-3 col-lg-offset-4"></div>
					<div class="part center col-xs-24 col-sm-18 col-md-14 col-lg-12">
						<h3 class="text-center"><?php echo $lang['Additional Info'] ?></h3>
						<p class="text-center">
							<?php echo $lang['Shipping in'] ?> <strong><?php echo $lang['24h'] ?></strong> <span class="sep">|</span>	
							<?php echo $lang['All products'] ?> <strong><?php echo $lang['tested'] ?></strong> <?php echo $lang['in Finland'] ?><br class="hidden-xs"/>
							<span class="sep visible-xs">|</span>
							<strong><?php echo $lang['Seven day'] ?></strong> <?php echo $lang['return policy'] ?> <span class="sep">|</span>
							<strong><?php echo $lang['International'] ?></strong> <?php echo $lang['shipping'] ?><br class="hidden-xs"/>
							<span class="sep visible-xs">|</span>
							<strong><?php echo $lang['Easy'] ?></strong> <?php echo $lang['payment methods'] ?><span class="sep">|</span>
							<strong><?php echo $lang['No account'] ?></strong> <?php echo $lang['needed'] ?><br class="hidden-xs"/>
							<span class="sep visible-xs">|</span>
							<strong><?php echo $lang['60-second'] ?></strong> &nbsp;<?php echo $lang['checkout'] ?>
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