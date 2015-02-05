<?php
	
	include_once('core.config.php');

	$breadcrumb = Array(
		array(null, 'Products')
	);

	$data = array();
	$p = getPagination("SELECT p.online, p.id, p.sku, m.name, c.name, c.hexa_light, c.hexa_original, p.stock, p.price, p.bargain
						FROM product p
						LEFT JOIN model m 
						ON m.id = p.model
						LEFT JOIN color c
						ON c.id = p.color
						ORDER BY p.online, p.sku");
	$stmt = $p['stmt'];
	$stmt->execute();
	$stmt->bind_result($online, $id, $sku, $model, $color, $hexa_light, $hexa_original, $stock, $price, $bargain);
	while($stmt->fetch()) {
		$data[] = array(
			'online' => $online,
			'id' => $id,
			'sku' => $sku,
			'model' => $model,
			'color' => $color,
			'hexa_light' => $hexa_light,
			'hexa_original' => $hexa_original,
			'stock' => $stock,
			'stock_' => $stock == 0 ? 'danger' : ($stock < 4 ? 'warning' : ''),
			'price' => $price,
			'bargain' => $bargain
		);
	}
	$stmt->close();
	
	include_once('UI_admin.header.php');
?>

	<table class="table table-striped table-bordered">
		<tr>
			<th class="<?php echo $UX_table_col_actions ?>">Actions</th>
			<th class="col-sm-4 col-md-3 col-lg-3">SKU</th>
			<th>Model</th>
			<th class="col-sm-2 col-md-1 col-lg-1 text-center"><abbr title="Stock">St.</abbr></th>
			<th class="col-sm-4 col-md-3 col-lg-3">Price</th>
		</tr>
		<?php if(count($data) == 0) { ?>
			<tr><td colspan="5">Empty</td></tr>
		<?php } foreach($data as $line) {  ?>
			<tr>
				<td class="text-center">
					<a href="admin.product.duplicate.php?id=<?php echo $line['id']; ?>" class="btn btn-xs"><span class="glyphicon glyphicon-magnet"></span></a>
					<a href="admin.product.edit.php?id=<?php echo $line['id']; ?>" class="btn btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="admin.product.delete.php?id=<?php echo $line['id']; ?>" label="<?php echo $line['model'] . ' ' . $line['color'] ?>" class="ctrl-delete btn btn-xs <?php if($line['online']) echo ' disabled' ?>"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
				<td>
					
					<?php echo $line['sku']; ?>
				</td>
				<td>
					<?php if(!$line['online']) echo '<span class="label-as-badge label label-warning">offline</span>' ?>
					<?php echo $line['model']; ?>
					<span style="background:#<?php echo $line['hexa_light']; ?>;border: 2px solid #<?php echo $line['hexa_original']; ?>;color:black;font-weight:normal" class="pull-right badge">
						<?php echo $line['color']; ?>
					</span>
				</td>
				<td class="text-right <?php echo $line['stock_']; ?>"><?php echo $line['stock']; ?></td>
				<td class="text-right <?php if($line['bargain'] != 0) echo 'info'; ?>">
					<?php 
						if($line['bargain'] == 0) {
							echo $line['price'] . ' &euro;';
						} else {
							echo $line['bargain'] . ' &euro; <span class="old-price">' . $line['price'] . ' &euro;</span>';
						}
					?>
				</td>
			</tr>
		<?php } ?>
	</table>

<?php include_once('UI_admin.footer.php'); ?>