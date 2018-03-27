<nav class="nav1">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="posts.php">Posts</a></li>
        <?php if ($isLogin): ?>
        	<li><a href="logout.php">Logout</a></li>
        <?php else:?>
        	<li><a href="register.php">Register</a></li>
        	<li><a href="login.php">Login</a></li>
        <?php endif; ?>
        <li><a href="contact.php">Contact us</a></li>
    </ul>
</nav>