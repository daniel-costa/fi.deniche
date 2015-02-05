<?php  
	
	include_once('core.config.php');
	
	$breadcrumb = Array(
		array('admin.products.list.php', 'Products'),
		array(null, 'New product')
	);
	
	include_once('UI_admin.header.php');

	$UX_form_width_label = 'col-sm-3 control-label';
	$UX_form_width_col_1 = 'col-sm-5';
	$UX_form_width_col_2 = $UX_form_width_col_1;
	$UX_form_width_col_3 = $UX_form_width_col_1;
?>

	<form class="form-horizontal" role="form" method="post" action="core.proceed.php?form=product.create">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<label class="<?php echo $UX_form_width_label ?>">Online</label>
					<div class="<?php echo $UX_form_width_col_1 ?>">
						<select name="online" class="form-control">
							<option <?php s('online', 0); ?>>No</option>
							<option <?php s('online', 1); ?>>Yes</option>
						</select>
					</div>

					<label class="<?php echo $UX_form_width_label ?>">SKU</label>
					<div class="<?php echo $UX_form_width_col_2 ?> has-feedback">
						<input type="text" class="form-control" placeholder="Enter sku" <?php f('sku'); ?>>
						<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
					</div>

					<label class="<?php echo $UX_form_width_label ?>">Models</label>
					<div class="<?php echo $UX_form_width_col_3 ?>">
						<select name="model" class="form-control">
							<?php foreach(getModels() as $line) { ?>
								<option <?php s('model', $line['id']); ?>><?php echo $line['name'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group">
					<label class="<?php echo $UX_form_width_label ?>">Color</label>
					<div class="<?php echo $UX_form_width_col_1 ?>">
						<select name="color" class="form-control">
							<option <?php s('color', 'null'); ?>>None</option>
							<?php foreach(getColors() as $line) { ?>
								<option <?php s('color', $line['id']); ?>><?php echo $line['name'];?></option>
							<?php } ?>
						</select>
					</div>

					<label class="<?php echo $UX_form_width_label ?>">Secondary</label>
					<div class="<?php echo $UX_form_width_col_2 ?>">
						<select name="color_sec" class="form-control">
							<option <?php s('color_sec', 'null'); ?>>None</option>
							<?php foreach(getColors() as $line) { ?>
								<option <?php s('color_sec', $line['id']); ?>><?php echo $line['name'];?></option>
							<?php } ?>
						</select>
					</div>

					<label class="<?php echo $UX_form_width_label ?>">Inside</label>
					<div class="<?php echo $UX_form_width_col_3 ?>">
						<select name="color_ins" class="form-control">
							<option <?php s('color_sec', 'null'); ?>>None</option>
							<?php foreach(getColors() as $line) { ?>
								<option <?php s('color_ins', $line['id']); ?>><?php echo $line['name'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group">

					<label class="<?php echo $UX_form_width_label ?>">Stock</label>
					<div class="<?php echo $UX_form_width_col_1 ?>">
						<input type="text" class="text-right form-control" <?php f('stock'); ?>>
					</div>

					<label class="<?php echo $UX_form_width_label ?>">Price</label>
					<div class="<?php echo $UX_form_width_col_2 ?>">
						<div class="input-group">
							<input type="text" class="text-right form-control" placeholder="with VAT" <?php f('price'); ?>>
							<span class="input-group-addon">&euro;</span>
						</div>
					</div>

					<label class="<?php echo $UX_form_width_label ?>">Bargain</label>
					<div class="<?php echo $UX_form_width_col_3 ?>">
						<div class="input-group">
							<input type="text" class="text-right form-control" placeholder="with VAT" <?php f('bargain'); ?>>
							<span class="input-group-addon">&euro;</span>
						</div>
					</div>
				</div>

			</div>

			<div class="panel-footer text-center">
				<button type="submit" class="btn btn-primary">
					<span class="glyphicon glyphicon-plus"></span> Create
				</button>
			</div>
		</div>
	</form>

<?php include_once('UI_admin.footer.php'); ?>