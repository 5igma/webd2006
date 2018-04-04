<?php

	if(isset($_GET['id']) && is_numeric($_GET['id'])) {
		$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
	} else {
		header("Location: index.php");
		die();
	}
	include_once('config.php');

	$pageTitle="Index";

	include_once('header.php');



?>

<?php

	showPost($id);
	include_once('pages/loadpost.php');
?>



<?php
	include_once('footer.php');
?>