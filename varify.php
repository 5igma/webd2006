<?php
	include_once('config.php');

	$pageTitle="Human Varify";

	include_once('header.php');
?>



<form action="process.php" method="post">
Enter Image Text
<input name="captcha" type="text">
<img src="captcha.php" /><br>
<input type="submit" name="command" value="captcha">
</form>



<?php
	include_once('footer.php');
?>