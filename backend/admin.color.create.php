<?php  
	
	include_once('core.config.php');
	
	$breadcrumb = Array(
		array('admin.colors.list.php', 'Colors'),
		array(null, 'New color')
	);

	include_once('UI_admin.header.php');
?>
	<form class="form-horizontal" role="form" method="post" action="core.proceed.php?form=color.create">				
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<label class="<?php echo $UX_form_width_label ?>">Category</label>
					<div class="<?php echo $UX_form_width_field_md ?>">
						<select name="category" class="form-control">
							<?php foreach(getColorCategories() as $line) { ?>
								<option <?php s('category', $line['id']); ?>><?php echo $line['name_en'];?></option>
							<?php } ?>
						</select>
					</div>
				</div>

				<div class="form-group has-feedback">
					<label class="<?php echo $UX_form_width_label ?>">Name</label>
					<div class="<?php echo $UX_form_width_field_md ?>">
						<input type="text" class="form-control" placeholder="Enter name" <?php f('name'); ?>>
						<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
					</div>
				</div>

				<div class="form-group has-feedback">
					<label class="<?php echo $UX_form_width_label ?>">Background</label>
					<div class="<?php echo $UX_form_width_field_sm ?>">
						<input type="text" class="form-control" placeholder="without #" <?php f('hexa_light'); ?>>
						<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
					</div>
				</div>

				<div class="form-group has-feedback">
					<label class="<?php echo $UX_form_width_label ?>">Bullet</label>
					<div class="<?php echo $UX_form_width_field_sm ?>">
						<input type="text" class="form-control" placeholder="without #" <?php f('hexa_original'); ?>>
						<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
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