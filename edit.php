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

	showPost($id);
	$row = $statement->fetch();

	if (!isset($_SESSION['userid'])){
		header("Location: index.php?msg=notLogin");
	} elseif ($_SESSION['userid'] != $row['userid']) {
		if ($_SESSION['permission'] < 1) {
			header("Location: index.php?msg=noEditPermission");
		}	
	}

	getCategories($id);

?>


    <div id="posts">
      <form action="process.php" method="post">
        <fieldset>
          <legend>Edit Post</legend>
          <p>
            <label for="title">Title</label>
            <input name="title" id="title" value='<?= $row["title"] ?>'>
          </p>
          <p>
            <label for="message">Message</label>
            <textarea name="message" id="message"><?= $row['message'] ?></textarea>
          </p>
          <p>
            <input type="hidden" name="id" value='<?= $id ?>'>
            <input type="submit" name="command" value="Update">
            <input type="submit" name="command" value="Delete" onclick="return confirm('Are you sure you wish to delete this post?')">
          </p>
        </fieldset>
      </form>


      <form action="process.php" method="post">
        <fieldset>
          <legend>Delete Post Category</legend>
          <select name='Categories'>
			<option disabled selected value> -- select an option -- </option>
			<?php while ($row = $statement->fetch()): ?>
				<option value="<?= $row['categoryid'] ?>"><?= $row['name'] ?></option>
			<?php endwhile ?>
		  </select>

          <p>
            <input type="hidden" name="id" value='<?= $id ?>'>
            <input type="submit" name="command" value="DeleteCategory" onclick="return confirm('Are you sure you wish to delete this post?')">
          </p>
        </fieldset>
      </form>
    </div>



<?php
	include_once('footer.php');
?>