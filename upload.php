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


?>

<?php include_once('footer.php'); ?>