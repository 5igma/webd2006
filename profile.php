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
		<?php if (isset($row['active'])): ?>
			<?php if ($row['active']): ?>
				<img src="./uploads/<?= $row['imagename'] ?>" alt="profileImage">
				<br>
				<form action="process.php" method="post">
					<input type="hidden" name="imagename" value='<?= $row['imagename'] ?>'>
					<input type="hidden" name="userid" value='<?= $row['userid'] ?>'>
					<input type="submit" name="command" value="Delete Image">
				</form>
			<?php endif ?>
		<?php else: ?>
			<?php include_once('upload.php'); ?>
		<?php endif ?>
		
		<label>Username: <?= $row['uname'] ?></label>
		<br>
		<label>First Name: <?= $row['fname'] ?></label>
		<br>
		<label>Last Name: <?= $row['lname'] ?></label>
		<br>
		<label>Email: <?= $row['email'] ?></label>
		<br>	
	</fieldset>
</div>


<?php
	include_once('footer.php');
?>