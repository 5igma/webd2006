
<h2>Apply a category to a post: </h2>
<form action="process.php" method="post">
	<select name='Categories'>
			<option disabled selected value> -- select an option -- </option>
		<?php while ($row = $statement->fetch()): ?>
			<option value="<?= $row['categoryid'] ?>"><?= $row['name'] ?></option>
		<?php endwhile ?>

	</select>
	<input type="hidden" name="id" value='<?= $id ?>'>
	<input type="submit" name="command" value="setCategory"/>
</form>