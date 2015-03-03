<?php

	$total = 0;

	$isCartEmpty = !(isset($_SESSION['cart']) and count($_SESSION['cart']) > 0);
	
?>

<div class="col-xs-24 col-sm-6 col-md-5 col-lg-4 part-menu">
	<div class="cart">
		<h4 class="text-center">
			<?php echo $lang['Items in'] ?>
			<?php echo $lang['cart'] ?>
		</h4>
		<div class="content<?php if($isCartEmpty) echo ' cart-empty'; ?>">
			<img class="arrow" src="images/arrow-top-black.png" />

			<?php if (!$isCartEmpty) { ?>
				<ul>
					<?php
						foreach ($_SESSION['cart'] as $id => $amount) {
							$item = getProduct($id);
							$total += $item['price'] * $amount;
					?>
						<li>
							<div class="product-preview">
								<div class="inner" style="">
									<h2><?php echo $item['model']; ?></h2>
									<h3><?php echo $item['color']; ?></h3>
									<div class="preview">
										<img src="<?php echo $item['thumb']; ?>"/>
									</div>
									<p class="price"><?php printf("%dx %.2f &euro;", $amount, $item['price']); ?></p>
									<a href="cart-remove-<?php echo $item['id']; ?>.html" class="remove-from-cart">Remove from cart</a>
								</div>
							</div>
						</li>
					<?php } ?>
				</ul>
			<?php } else { ?>

				<p class="text-center">Add item to cart from the selection of phones to your right.</p>

			<?php } ?>
		</div>

		<h3 class="total text-center"><?php printf("%s %.2f &euro;", $lang['Total'], $total); ?></h3>

		<a href="cart-checkout.html" class="btn checkout text-center" ><?php echo $lang['Checkout'] ?></a>
	</div>
</div>


