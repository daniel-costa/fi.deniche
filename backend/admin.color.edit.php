<?php 
	
	include_once('core.config.php');

	if(!isset($_SESSION['last_form'])) {
		$stmt = $sql->prepare("SELECT id, name, color_category, hexa_light, hexa_original FROM color WHERE id = ?");
		$stmt->bind_param('i', $_GET['id']);
		$stmt->execute();
		$stmt->bind_result(
			$_SESSION['last_form']['id'], 
			$_SESSION['last_form']['name'], 
			$_SESSION['last_form']['category'], 
			$_SESSION['last_form']['hexa_light'], 
			$_SESSION['last_form']['hexa_original']
		);
		$stmt->fetch();
		$stmt->close();
	}

	$breadcrumb = Array(
		array('admin.colors.list.php', 'Colors'),
		array(null, $_SESSION['last_form']['name'])
	);

	include_once('UI_admin.header.php');
?>

	<form class="form-horizontal" role="form" method="post" action="core.proceed.php?form=color.edit">
		<div class="panel panel-default">
			<div class="panel-body">
				<div class="form-group">
					<label class="<?php echo $UX_form_width_label ?>">ID</label>
					<div class="<?php echo $UX_form_width_field_xs ?>">
						<input type="text" class="form-control" <?php f('id'); ?> readonly>
					</div>
				</div>
				
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
			<div class="panel-footer text-center alert-info">
				<span class="glyphicon glyphicon-info-sign"></span>
				<strong>Heads up!</strong> This button 
				<button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-ok"></span> Save</button>
				saves <span style="text-decoration:underline;font-weight:bold;">only</span> the general information above.
			</div>
		</div>
	</form>

<?php include_once('UI_admin.footer.php'); ?>