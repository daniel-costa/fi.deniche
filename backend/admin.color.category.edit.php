<?php
	
	include_once('core.config.php');

	if(!isset($_SESSION['last_form'])) {
		$stmt = $sql->prepare("SELECT id, hexa, name_fi, name_se, name_en FROM color_category WHERE id = ?");
		$stmt->bind_param('i', $_GET['id']);
		$stmt->execute();
		$stmt->bind_result(
			$_SESSION['last_form']['id'], 
			$_SESSION['last_form']['hexa'], 
			$_SESSION['last_form']['name_fi'], 
			$_SESSION['last_form']['name_se'],
			$_SESSION['last_form']['name_en']
		);
		$stmt->fetch();
		$stmt->close();
	}

	$breadcrumb = Array(
		array('admin.colors.list.php', 'Colors'),
		array('admin.color.categories.list.php', 'Categories'),
		array(null, $_SESSION['last_form']['name_en'])
	);

	include_once('UI_admin.header.php');
?>
	
	<form class="form-horizontal" role="form" method="post" action="core.proceed.php?form=color.category.edit">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<label class="<?php echo $UX_form_width_label ?>">ID</label>
					<div class="<?php echo $UX_form_width_field_xs ?>">
						<input type="text" class="form-control" <?php f('id'); ?> readonly>
					</div>
				</div>
				
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
			<div class="panel-footer text-center alert-info">
				<span class="glyphicon glyphicon-info-sign"></span>
				<strong>Heads up!</strong> This button 
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Save</button>
				saves <span style="text-decoration:underline;font-weight:bold;">only</span> the general information above.
			</div>
		</div>
	</form>

<?php include_once('UI_admin.footer.php'); ?>