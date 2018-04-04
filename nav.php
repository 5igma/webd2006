<nav class="nav1">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="post.php">Post</a></li>
        <?php if ($isLogin): ?>
            <li><a href="allpost.php">All Posts</a></li>
            <li><a href="profile.php">My Profile</a></li>
        	<li><a href="logout.php">Logout</a></li>
            <?php if ($_SESSION['permission'] > 1): ?>
                <li><a href="admin.php">Admin Page</a></li>
            <?php endif; ?>
        <?php else:?>
        	<li><a href="register.php">Register</a></li>
        	<li><a href="login.php">Login</a></li>
        <?php endif; ?>
        <li><a href="contact.php">Contact us</a></li>
    </ul>
</nav>