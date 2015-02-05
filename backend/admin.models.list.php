<?php 
	
	include_once('core.config.php');

	$breadcrumb = Array(
		array(null, 'Models')
	);

	$data = array();
	$p = getPagination("SELECT id, name, online FROM model ORDER BY online, name");
	$stmt = $p['stmt'];
	$stmt->execute();
	$stmt->bind_result($id, $name, $online);
	while($stmt->fetch()) {
		$data[] = array('id' => $id, 'name' => $name, 'online' => $online);
	}
	$stmt->close();

	include_once('UI_admin.header.php');
?>

	<table class="table table-striped table-bordered">
		<tr>
			<th class="<?php echo $UX_table_col_actions ?>">Actions</th>
			<th>Name</th>
		</tr>
		<?php if(count($data) == 0) { ?>
			<tr><td colspan="2">Empty</td></tr>
		<?php } foreach($data as $line) {  ?>
			<tr>
				<td class="text-center">
					<a href="admin.model.edit.php?id=<?php echo $line['id']; ?>" class="btn btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="admin.model.delete.php?id=<?php echo $line['id']; ?>" label="<?php echo $line['name'] ?>" class="ctrl-delete btn btn-xs <?php if($line['online']) echo ' disabled' ?>"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
				<td>
					<?php if(!$line['online']) echo '<span class="label-as-badge label label-warning">offline</span>' ?>
					<?php echo $line['name']; ?>
				</td>
			</tr>
		<?php } ?>
	</table>

<?php include_once('UI_admin.footer.php'); ?>