<?php
	include_once('config.php');

	$pageTitle="All Post";

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