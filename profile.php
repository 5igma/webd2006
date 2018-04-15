<?php
	include_once('config.php');

	$pageTitle="Index";

	include_once('header.php');

	if(!$_SESSION['varify']){
		header('Location: varify.php');
	}

	if (!isset($_SESSION['userid'])){
		header("Location: index.php?msg=notLogin");
	}

	loadProfile($_SESSION['userid']);
	$row = $statement->fetch();

?>
<br>
<div id="profile">
	<h2>Welcome to your Profile <?= $row['fname'] ?> <?= $row['lname'] ?>!</h2>
	<fieldset>
		<label for="username">Username:</label>
		<input id="username" name="username" type="text" placeholder="<?= $row['uname'] ?>" disabled/>
		<br>
		<label for="fname">First Name:</label>
		<input id="fname" name="fname" type="text" placeholder="<?= $row['fname'] ?>" disabled/>
		<br>
		<label for="lname">Last Name:</label>
		<input id="lname" name="lname" type="text" placeholder="<?= $row['lname'] ?>" disabled/>
		<br>
		<label for="email">Email:</label>
		<input id="email" name="email" type="text" placeholder="<?= $row['email'] ?>" disabled/>
		<br>
	</fieldset>
</div>


<?php
	include_once('footer.php');
?>