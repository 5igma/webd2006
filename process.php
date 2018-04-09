<?php
	require('config.php');
	$pageTitle="Process";

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

				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					//need to check if username exist in db before adding.
					$query = "SELECT uname FROM users WHERE uname = '".$uname."' LIMIT 1";
					$statement = $db->prepare($query);
					$statement->execute();

					if($statement->rowCount() == 0){
							$query = "INSERT INTO users (fname, lname, uname, password, email, registeredip, isAccountActive, permission, registerhash) values 
						('".$fname."', '".$lname."', '".$uname."', '".$password."', '".$email."', '".$ip."', '".$status."', '".$permission."', '".$hash."')";

					    $statement = $db->prepare($query);
					    $statement->execute();
					    header('location:index.php?msg=registerComplete');
					} else {
						header('location:register.php?msg=userExist');
					}
				} else {
					header('location:register.php?msg=invalidEmail');
				}

				
			} else {
				header('location:register.php?msg=passMissMatch');
			} 
		} elseif ($_POST['command'] == 'login') {
			if(isset($_POST["username"]) && isset($_POST['password'])) {
				$uname = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
				$password = $_POST['password'];
				$ip = $_SERVER['REMOTE_ADDR'];
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
					$_SESSION['permission'] = $row['permission'];
					$_SESSION['ip'] = $ip;
					header('location:index.php?msg=validlogin');
				}
				else{
					header('location:login.php?msg=invalidLogin');
				die();
				}
				
			}
		} elseif ($_POST['command'] == 'captcha') {
			if($_POST["captcha"]!="" && $_SESSION["code"]==$_POST["captcha"]){
				$_SESSION["varify"] = true;
				header('Location: index.php?msg=varifyComplete');
			}
			else
			{
				header('Location: varify.php?msg=invalidVarify');
			}
		} elseif ($_POST['command'] == 'Create') {
			$title		= filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$message	= filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			$title = trim($title);
			$message = trim($message);
			if(strlen($title) >= 1 && strlen($message) >= 1){
				$query = "INSERT INTO posts (userid, title, message) values ('".$_SESSION['userid']."','".$title."', '".$message."')";
				$statement = $db->prepare($query);
				$statement->execute();
				header('Location: index.php');

			}			
		} elseif ($_POST['command'] == 'Update') {
			$title		= filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$message	= filter_input(INPUT_POST, 'message', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
			$id			= filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

			$title = trim($title);
			$message = trim($message);
			$id = trim($id);
			if(strlen($title) >= 1 && strlen($message) >= 1){
				$query = "UPDATE `posts` SET `title` = '".$title."', `message` = '".$message."', `lastedit` = now() WHERE `posts`.`postid` = '".$id."';";
				$statement = $db->prepare($query);
				$statement->execute();
				header('Location: index.php');

			}			
		} elseif ($_POST['command'] == 'Delete') {
			$postid	= filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

			$postid = trim($postid);
			$query = "DELETE FROM posts WHERE postid = :postid";
			$statement = $db->prepare($query);
			$statement->bindValue(':postid', $postid, PDO::PARAM_INT);
			$statement->execute();
			header('Location: index.php');
		}


	} else {
		header('Location: index.php');
	}

?>


<?php
	include_once('footer.php');
?>