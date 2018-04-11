<?php
	$load = false;
	if(isset($_POST['command'])) {
		if ($_POST['command'] == 'selectCategory'){
			$categoryid = filter_input(INPUT_POST, 'categories', FILTER_SANITIZE_NUMBER_INT);
			$load = true;
		}
	} 

	include_once('config.php');

	$pageTitle="Categories";

	include_once('header.php');

	if($load){
		showPostByCategory($categoryid);


	} else {
		loadCategories();
	}

	

?>


<?php if ($load): ?>
	<?php include_once('pages/loadpost.php'); ?>
<?php else: ?>

<h2>Selecting a Category: </h2>
<form action="categories.php" method="POST">
	<select name='categories' type='text'>
			<option disabled selected value> -- select an option -- </option>
		<?php while ($row = $statement->fetch()): ?>
			<option value="<?= $row['categoryid'] ?>"><?= $row['name'] ?></option>
		<?php endwhile ?>

	</select>
	<input type="submit" name="command" value="selectCategory"/>
</form>
<?php endif ?>