<?php
	require('config.php');
	$pageTitle="Process";
	include_once('header.php');

	$postSubmited = isset($_POST['command']);

	if($postSubmited){

		if($_POST['command'] == 'register'){

			$title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

			if ($_POST['password'] == $_POST['password2']) {
				$title		= filter_input(INPUT_POST, 'title', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
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
				    echo 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';

					//mail
					$to      = $email; // Send email to our user
					$subject = 'Signup | Verification';
					$message = '
					 
					Thanks for signing up!
					Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
					 
					------------------------
					Username: '.$uname.'
					------------------------
					 
					Please click this link to activate your account:
					http://127.0.0.1/webd2006/project/verify.php?email='.$email.'&hash='.$hash.'
					 
					';
					                     
					$headers = 'From:noreply@minhduong.com' . "\r\n";
					mail($to, $subject, $message, $headers); // Send our email

				} else {
					echo "Account Already exists in database.";
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