<?php  
	
	include_once('core.config.php');

	$breadcrumb = Array(
		array('admin.color.categories.list.php', 'Colors categories'),
		array(null, 'New color category')
	);

	include_once('UI_admin.header.php');
?>

	<form class="form-horizontal" role="form" method="post" action="core.proceed.php?form=color.category.create">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group has-feedback">
					<label class="<?php echo $UX_form_width_label ?>">English name</label>
					<div class="<?php echo $UX_form_width_field_md ?>">
						<input type="text" class="form-control" placeholder="Enter name" <?php f('name_en'); ?>>
						<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
					</div>
				</div>
				
				<div class="form-group">
					<label class="<?php echo $UX_form_width_label ?>">Swedish name</label>
					<div class="<?php echo $UX_form_width_field_md ?>">
						<input type="text" class="form-control" placeholder="Enter name" <?php f('name_se'); ?>>
					</div>
				</div>

				<div class="form-group">
					<label class="<?php echo $UX_form_width_label ?>">Finnish name</label>
					<div class="<?php echo $UX_form_width_field_md ?>">
						<input type="text" class="form-control" placeholder="Enter name" <?php f('name_fi'); ?>>
					</div>
				</div>
				
				<div class="form-group has-feedback">
					<label class="<?php echo $UX_form_width_label ?>">Bullet</label>
					<div class="<?php echo $UX_form_width_field_sm ?>">
						<input type="text" class="form-control" placeholder="without #" <?php f('hexa'); ?>>
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