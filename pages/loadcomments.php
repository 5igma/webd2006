<div id="comments">
	<?php if ($isLogin): ?>
		<form action="process.php" method="post">
			<fieldset>
				<legend>Add Comment</legend>
				<p>
					<label for="message">Message</label>
					<textarea name="message" id="message"></textarea>
				</p>
				<p>
					<input type="hidden" name="postid" value='<?= $id ?>'>
					<input type="hidden" name="userid" value='<?= $_SESSION["userid"] ?>'>
					<input type="submit" name="command" value="addComment" />
				</p>
			</fieldset>
		</form>
	<?php endif; ?>


	<?php if(!isset($statement) || $statement->rowCount() <= 0): ?>
		<p>No comments found!</p>
	<?php else: ?>
		<?php while ($row = $statement->fetch()): ?>

			<div class="comment">
				<h2>user: <?= $row['uname'] ?></h2>
				<p>
				<small>
					<?= date('F d, Y, H:i a', strtotime($row['date'])) ?>
				</small>
				</p>
				<div class="message">
					<?= $row['message'] ?>
				</div>
					<?php if (isset($_SESSION['userid']) && ($_SESSION['userid'] == $row['userid'] || $_SESSION['permission'] > 1)): ?>
						<form action="process.php" method="POST">
							<input type="hidden" name="postid" value="<?= $row['postid'] ?>" />
							<input type="hidden" name="commentid" value="<?= $row['commentid'] ?>" />
							<input type="submit" name="command" value="deleteComment" />
						</form>
					<?php endif; ?>
			</div>

		<?php endwhile ?>
	<?php endif ?>

</div>