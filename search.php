<?php

if(isset($_GET['s'])) {
		$string = filter_input(INPUT_GET, 's', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
		$result = true;
}
	include_once('config.php');

	$pageTitle="Index";

	include_once('header.php');



?>


	<?php if (isset($result)): ?>
		<fieldset>
			<legend>Search Results</legend>
			<?php search($string) ?>
			<?php while ($row = $statement->fetch()): ?>
		        <li> <a href="show.php?id=<?= $row['postid'] ?>"> Title: <?= $row['title'] ?></a> </li>
		        <p>Message: <?= truncateContent($row['message'],$row['postid'] ) ?></p>
		    <?php endwhile ?>
	    </fieldset>
	<?php endif; ?>



<?php

	include_once('footer.php');
?>