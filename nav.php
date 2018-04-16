<nav class="nav1">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="post.php">Post</a></li>
        <?php if ($isLogin): ?>
            <li><a href="allpost.php">All Posts</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="profile.php">My Profile</a></li>
        	<li><a href="logout.php">Logout</a></li>
            <?php if ($_SESSION['permission'] > 1): ?>
                <li><a href="admin.php">Admin Page</a></li>
            <?php endif; ?>
        <?php else:?>
        	<li><a href="register.php">Register</a></li>
        	<li><a href="login.php">Login</a></li>
        <?php endif; ?>
    </ul>
</nav>
<br>
<?php if ($isLogin): ?>
    <fieldset>
        <legend>Search</legend>
        <form action="search.php" method="GET">
            <input type="text" name="s" />

            <?php loadCategories(); ?>
            <select name='categories'>
                <option disabled selected value> -- all categories -- </option>
            <?php while ($row = $statement->fetch()): ?>
                <option value="<?= $row['categoryid'] ?>"><?= $row['name'] ?></option>
            <?php endwhile ?>

            </select>

            <input type="submit" value="Search" />
        </form>
    </fieldset>
    <br>
<?php endif; ?>
