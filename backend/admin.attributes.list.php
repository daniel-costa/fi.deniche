<?php 
	
	include_once('core.config.php');

	$breadcrumb = Array(
		array(null, 'Attributes')
	);

	$data = array();
	$p = getPagination("SELECT id, name_fi, name_se, name_en, online FROM attribute ORDER BY online, name_en");
	$stmt = $p['stmt'];
	$stmt->execute();
	$stmt->bind_result($id, $name_fi, $name_se, $name_en, $online);
	while($stmt->fetch()) {
		$data[] = array(
			'id' => $id,
			'name_fi' => $name_fi,
			'name_se' => $name_se,
			'name_en' => $name_en,
			'online' => $online
		);
	}
	$stmt->close();

	include_once('UI_admin.header.php');
?>

	<table class="table table-striped table-bordered">
		<tr>
			<th class="<?php echo $UX_table_col_actions ?>">Actions</th>
			<th>English</th>
			<th>Finnish</th>
			<th>Swedish</th>
		</tr>
		<?php if(count($data) == 0) { ?>
			<tr><td colspan="5">Empty</td></tr>
		<?php } foreach($data as $line) {  ?>
			<tr>
				<td class="text-center">
					<a href="admin.attribute.edit.php?id=<?php echo $line['id']; ?>" class="btn btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="admin.attribute.delete.php?id=<?php echo $line['id']; ?>" label="<?php echo $line['name_en'] ?>" class="ctrl-delete btn btn-xs <?php if($line['online']) echo ' disabled' ?>"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
				<td>
					<?php if(!$line['online']) echo '<span class="label-as-badge label label-warning">offline</span>' ?>
					<?php echo $line['name_en']; ?>
				</td>
				<td><?php echo $line['name_fi']; ?></td>
				<td><?php echo $line['name_se']; ?></td>
			</tr>
		<?php } ?>
	</table>

<?php include_once('UI_admin.footer.php'); ?>