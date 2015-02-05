<?php 
	
	include_once('core.config.php');

	$breadcrumb = Array(
		array(null, 'Colors')
	);

	$data = array();
	$p = getPagination("SELECT c.id, c.name, x.name_en, c.hexa_light, c.hexa_original FROM color c LEFT JOIN color_category x ON x.id = c.color_category ORDER BY x.name_en, c.name");
	$stmt = $p['stmt'];
	$stmt->execute();
	$stmt->bind_result($id, $name, $category, $hexa_light, $hexa_original);
	while($stmt->fetch()) {
		$data[] = array(
			'id' => $id,
			'name' => $name,
			'category' => $category,
			'hexa_light' => $hexa_light,
			'hexa_original' => $hexa_original
		);
	}
	$stmt->close();

	include_once('UI_admin.header.php');
?>

	<table class="table table-striped table-bordered">
		<tr>
			<th class="<?php echo $UX_table_col_actions ?>">Actions</th>
			<th>Color</th>
			<th>Category</th>
		</tr>
		<?php if(count($data) == 0) { ?>
			<tr><td colspan="2">Empty</td></tr>
		<?php } foreach($data as $line) { ?>
			<tr>
				<td class="text-center">
					<a href="admin.color.edit.php?id=<?php echo $line['id']; ?>" class="btn btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>
					<a href="admin.color.delete.php?id=<?php echo $line['id']; ?>" label="<?php echo $line['name'] ?>" class="ctrl-delete btn btn-xs"><span class="glyphicon glyphicon-trash"></span></a>
				</td>
				<td>
					<span style="background:#<?php echo $line['hexa_light']; ?>;border: 2px solid #<?php echo $line['hexa_original']; ?>;color:black;font-weight:normal" class="badge">
						<?php echo $line['name']; ?>
					</span>					
				</td>
				<td><?php echo $line['category']; ?></td>
			</tr>
		<?php } ?>
	</table>

<?php include_once('UI_admin.footer.php'); ?>