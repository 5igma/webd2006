<?php
	$category = false;
	$result = false;

if(isset($_GET['s'])) {
		$string = filter_input(INPUT_GET, 's', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

		if(isset($_GET['categories'])) {

			$categoryid = filter_input(INPUT_GET, 'categories', FILTER_SANITIZE_NUMBER_INT);
			$category = true;
		}

		$result = true;
}
	include_once('config.php');

	$pageTitle="Search";

	include_once('header.php')
;


?>


	<?php if (isset($result) && strlen($string) > 0): ?>
		<fieldset>
			<legend>Search Results</legend>

			<?php if ($category): ?>
				<?php searchCategory($string, $categoryid) ?>
			<?php else: ?>
				<?php search($string) ?>
			<?php endif ?>


			<?php while ($row = $statement->fetch()): ?>
		        <li> <a href="show.php?id=<?= $row['postid'] ?>"> Title: <?= $row['title'] ?></a> </li>
		        <p>Message: <?= truncateContent($row['message'],$row['postid'] ) ?></p>
		    <?php endwhile ?>
	    </fieldset>
	<?php endif; ?>



<?php

	include_once('footer.php');
?>