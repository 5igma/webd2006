<?php
	include_once('config.php');

	$pageTitle="Index";

	include_once('header.php');



?>

<!-- Load top 10 post -->
<?php
	load10Post();
	include_once('pages/loadpost.php');
?>



<?php
	include_once('footer.php');
?>