<?php
	require('config.php');
	$pageTitle="Process";
	include_once('header.php');

	$postSubmited = isset($_POST['command']);

	if($postSubmited){

		if($_POST['command'] == 'register'){

			$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			if ($_POST['password'] == $_POST['password2']) {
				$title	= filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$uname = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$email = filter_input(INPUT_POST,'email', FILTER_VALIDATE_EMAIL);
				$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$fname = filter_input(INPUT_POST,'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$lname = filter_input(INPUT_POST,'lastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$ip = $_SERVER['REMOTE_ADDR'];
				$status = 0;
				$permission = 0;
				$hash = md5( rand(0,1000) );

				//need to check if username exist in db before adding.
				$query = "SELECT uname FROM users WHERE uname = '".$uname."' LIMIT 1";
				$statement = $db->prepare($query);
				$statement->execute();

				if($statement->rowCount() == 0){
						$query = "INSERT INTO users (fname, lname, uname, password, email, registeredip, isAccountActive, permission, registerhash) values 
					('".$fname."', '".$lname."', '".$uname."', '".$password."', '".$email."', '".$ip."', '".$status."', '".$permission."', '".$hash."')";

				    $statement = $db->prepare($query);
				    $statement->execute();

				} else {
					echo "Account Already exists in database.";
				}
			} 
		} elseif ($_POST['command'] == 'login') {
			if(isset($_POST["username"]) && isset($_POST['password'])) {
				$uname = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				//$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
				$password = $_POST['password'];
				$query = "SELECT * FROM Users WHERE uname = :uname";
				$statement = $db->prepare($query);
				$statement -> bindValue(":uname", $uname);
				$statement->execute();
				$row = $statement->fetch();
				if (password_verify($password, $row['password'])) {
					$_SESSION["userid"] = $row['userid'];
					$_SESSION['uname'] = $row['uname'];
					$_SESSION['fname'] = $row['fname'];
					$_SESSION['email'] = $row['email'];
					header('location:index.php?validlogin');
				}
				else{
					header('location:login.php?invalidLogin');
				die();
				}
				
			}
		}


	} else {
		header('Location: index.php');
	}

?>


<?php
	include_once('footer.php');
?>