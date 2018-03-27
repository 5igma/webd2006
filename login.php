<?php
	include_once('config.php');

	$pageTitle="Index";

	include_once('header.php');

?>

<form id="register" method="post" action="process.php" enctype="multipart/form-data">
		<fieldset>
			<label for="username">Username:</label>
			<input id="username" name="username" type="text" placeholder="User Name" required/>
			<br>
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" required />
			<br>
			<button type="submit" name="command" value="login">Submit</button>
		</fieldset>
	</form>



<?php
	include_once('footer.php');
?>