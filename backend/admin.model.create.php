<?php  
	
	include_once('core.config.php');
	
	$breadcrumb = Array(
		array('admin.models.list.php', 'Models'),
		array(null, 'New model')
	);
	
	include_once('UI_admin.header.php');
?>

	<form class="form-horizontal" role="form" method="post" action="core.proceed.php?form=model.create">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<label class="<?php echo $UX_form_width_label ?>">Online</label>
					<div class="<?php echo $UX_form_width_field_xs ?>">
						<select name="online" class="form-control">
							<option <?php s('online', 0); ?>>No</option>
							<option <?php s('online', 1); ?>>Yes</option>
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

				<div class="form-group">
					<label class="<?php echo $UX_form_width_label ?>">Thickness</label>
					<div class="col-sm-4">
						<select name="thickness" class="form-control">
							<option <?php s('thickness', 0); ?>>Thin</option>
							<option <?php s('thickness', 1); ?>>Medium</option>
							<option <?php s('thickness', 2); ?>>Thick</option>
						</select>
					</div>
				</div>

				<div class="form-group has-feedback">
					<label class="<?php echo $UX_form_width_label ?>">English description</label>
					<div class="<?php echo $UX_form_width_field_xl ?>">
						<textarea name="desc_en" class="form-control" rows="10" placeholder="Enter english description"><?php t('desc_en'); ?></textarea>
						<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
					</div>
				</div>
				
				<div class="form-group">
					<label class="<?php echo $UX_form_width_label ?>">Swedish description</label>
					<div class="<?php echo $UX_form_width_field_xl ?>">
						<textarea name="desc_fi" class="form-control" rows="10" placeholder="Enter finnish description"><?php t('desc_fi'); ?></textarea>
					</div>
				</div>

				<div class="form-group">
					<label class="<?php echo $UX_form_width_label ?>">Finish description</label>
					<div class="<?php echo $UX_form_width_field_xl ?>">
						<textarea name="desc_se" class="form-control" rows="10" placeholder="Enter swedish description"><?php t('desc_se'); ?></textarea>
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