<!doctype html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <title><?= isset($pageTitle) ? $siteTitle . ' - ' . $pageTitle : "Title Not Set"?></title>
    <link rel="stylesheet" href="<?= $styleSheet ?>" type="text/css">

  </head>
  <body>
  	<?php
		include_once('nav.php');
	?>
	<?php if (isset($msg)): ?> 
		<?= $msg ?>
	<?php endif; ?>
  