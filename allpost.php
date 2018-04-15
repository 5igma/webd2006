<?php

if(isset($_GET['sType'])) {
		$sType = filter_input(INPUT_GET, 'sType', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
}
	include_once('config.php');

	$pageTitle="All Post";

	include_once('header.php');

	if (isset($sType)) {
		if ($sType == 'TA') {
			loadPostAsc();
			$sortType='Title Ascending';
		} elseif ($sType == 'TD') {
			loadPostDesc();
			$sortType='Title Descending';
		} elseif ($sType == 'DC') {
			loadPostDate();
			$sortType='Date Created';
		} elseif ($sType == 'DE') {
			loadPostLastEdit();
			$sortType='Date Edited';
		}
	} else {
		load10Post();
		$sortType='last 10 Post';
	}

?>

<nav class="nav1">
    <ul>
        <li><a href="?sType=TA">Title Ascending</a></li>
        <li><a href="?sType=TD">Title Descending</a></li>
        <li><a href="?sType=DC">Date Created</a></li>
        <li><a href="?sType=DE">Date Edited</a></li>
    </ul>
</nav>

<h3>Current Sort type is <?= $sortType ?></h3>

<?php
	include_once('pages/loadpost.php');
?>



<?php
	include_once('footer.php');
?>