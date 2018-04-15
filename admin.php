<?php


	include_once('config.php');

	$pageTitle="Admin Page!";

	include_once('header.php');

	if ($isLogin){
		if ($_SESSION['permission'] > 1){
			//header("Location: index.php");
			loadUsers();
		}
	} else {
		header("Location: index.php");
	}
	

?>

<h2>List of Users: </h2>
<form action="process.php" method="post">
	<select name='users'>
			<option disabled selected value> -- select an option -- </option>
		<?php while ($row = $statement->fetch()): ?>
			<option value="<?= $row['userid'] ?>"><?= $row['uname'] ?></option>
		<?php endwhile ?>

	</select>
	<input type="hidden" name="userid" value='<?= $userid ?>'>
	<input type="submit" name="command" value="editUser"/>
	<input type="submit" name="command" value="deleteUser"/>
</form>



<?php
	include_once('footer.php');
?>