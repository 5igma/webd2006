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
<br>
<div id="posts">
  <form action="process.php" method="post">
    <fieldset>
      <legend>New Post</legend>
      <p>
        <label for="title">Title</label>
        <input name="title" id="title" />
      </p>
      <p>
        <label for="message">Message</label>
        <textarea name="message" id="message"></textarea>
      </p>
      <p>
        <input type="submit" name="command" value="Create" />
      </p>
    </fieldset>
  </form>
</div>



<?php
	include_once('footer.php');
?>