<?php
	include_once('config.php');
	$pageTitle="Register";
	include_once('header.php');

?>

<form id="register" method="post" action="process.php" enctype="multipart/form-data">
		<fieldset>
			<label for="username">Username:</label>
			<input id="username" name="username" type="text" placeholder="User Name" required/>
			<br>
			<label for="email">Email:</label>
			<input id="email" name="email" type="email" placeholder="you@site.com" autofocus required/>
			<br>
			<label for="password">Password:</label>
			<input type="password" name="password" id="password" required />
			<br>
			<label for="password2">Confirm Password:</label>
			<input type="password" name="password2" id="password2" required />
			<br>
			<label for="firstname">First Name:</label>
			<input id="firstname" name="firstname" type="text" placeholder="First Name" required/>
			<br>
			<label for="lastname">Last Name:</label>
			<input id="lastname" name="lastname" type="text" placeholder="Last Name" required/>
			<br>
			<button type="submit" name="command" value="register">Submit</button>
			<button type="reset">Reset</button>
		</fieldset>
	</form>

<?php
	include_once('footer.php');
?>