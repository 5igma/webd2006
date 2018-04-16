<div id="posts">
	<?php if(!isset($statement) || $statement->rowCount() <= 0): ?>
		<p>SORRY! No Blogs found!</p>
	<?php else: ?>
		<?php while ($row = $statement->fetch()): ?>

			<div>
				<h2><a href="show.php?id=<?= $row['postid'] ?>"><?= $row['title'] ?></a></h2>
				<h3>Categories: <?php showCategories($row['postid']) ?></h3>
				<p>
				<small>
					<?= date('F d, Y, H:i a', strtotime($row['date'])) ?> -
						<?php if (isset($_SESSION['userid']) && ($_SESSION['userid'] == $row['userid'] || $_SESSION['permission'] > 1)): ?>
							<a href="edit.php?id=<?= $row['postid'] ?>">edit</a>
					<?php endif; ?>
					
				</small>
				</p>
				<div class="message">
					<?= $row['message'] ?>
				</div>
			</div>

		<?php endwhile ?>
	<?php endif ?>

</div>