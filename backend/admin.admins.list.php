<?php 
	
	include_once('core.config.php');

	$breadcrumb = Array(
		array(null, 'Administrators')
	);
	
	$accounts = array();
	$p = getPagination("SELECT a.id, a.email, x.name, validated FROM account_admin x INNER JOIN account a ON a.id = x.account ORDER BY validated, x.name");
	$stmt = $p['stmt'];
	$stmt->execute();
	$stmt->bind_result($id, $email, $name, $validated);
	while($stmt->fetch()) {
		$accounts[] = array('id' => $id, 'email' => $email, 'name' => $name, 'validated' => $validated);
	}
	$stmt->close();

	include_once('UI_admin.header.php');
?>

	<table class="table table-striped table-bordered">
		<tr>
			<th class="<?php echo $UX_table_col_actions ?>">Actions</th>
			<th>Name</th>
		</tr>
		<?php if(count($accounts) == 0) { ?>
			<tr><td colspan="2">Empty</td></tr>
		<?php } foreach($accounts as $line) { ?>
			<tr>
				<td class="text-center">
					<?php if($line['validated']) { ?>
						<a href="admin.account.unvalidate.php?id=<?php echo $line['id']; ?>" class="btn btn-xs"><span class="glyphicon glyphicon-cloud-download"></span></a>
					<?php } else { ?>
						<a href="admin.account.validate.php?id=<?php echo $line['id']; ?>" class="btn btn-xs"><span class="glyphicon glyphicon-cloud-upload"></span></a>
					<?php } ?>
					<a href="mailto:<?php echo $line['email']; ?>" class="btn btn-xs"><span class="glyphicon glyphicon-envelope"></span></a>&#160;
					<a href="admin.account.delete.php?id=<?php echo $line['id']; ?>" label="<?php echo $line['name'] ?>" class="ctrl-delete btn btn-xs <?php if($line['validated']) echo ' disabled' ?>"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
				<td>
					<?php if(!$line['validated']) echo '<span class="label-as-badge label label-warning">offline</span>' ?>
					<?php echo $line['name']; ?>
				</td>
			</tr>
		<?php } ?>
	</table>

<?php include_once('UI_admin.footer.php'); ?>