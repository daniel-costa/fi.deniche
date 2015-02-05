<?php

	include_once('core.config.php');
	
	$breadcrumb = Array(
		array('admin.admins.list.php', 'Administrators'),
		array(null, 'New account')
	);

	include_once('UI_admin.header.php');
?>
	<form class="form-horizontal" role="form" method="post" action="core.proceed.php?form=admin.create">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group has-feedback">
					<label class="<?php echo $UX_form_width_label ?>">Name</label>
					<div class="<?php echo $UX_form_width_field_md ?>">
						<input type="text" class="form-control" placeholder="Enter name" <?php f('name'); ?>>
						<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
					</div>
				</div>
				<div class="form-group has-feedback">
					<label class="<?php echo $UX_form_width_label ?>">Email</label>
					<div class="<?php echo $UX_form_width_field_md ?>">
						<input type="email" class="form-control" placeholder="Enter email" <?php f('email'); ?>>
						<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
					</div>
				</div>
				<div class="form-group has-feedback">
					<label class="<?php echo $UX_form_width_label ?>">Password</label>
					<div class="<?php echo $UX_form_width_field_md ?>">
						<input type="password" class="form-control" placeholder="Enter password" <?php f('pass1'); ?>>
						<span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
					</div>
				</div>
				<div class="form-group has-feedback">
					<label class="<?php echo $UX_form_width_label ?>">Confirmation</label>
					<div class="<?php echo $UX_form_width_field_md ?>">
						<input type="password" class="form-control" placeholder="Enter confirmation password" <?php f('pass2'); ?>>
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