<?php 
	$msg;

	if($_GET){
		switch ((isset($_GET['msg']) ? $_GET['msg'] : '')) {
			case 'notLoggedIn':
				$msg = 'No current user log in.';
			break;
			case 'logout':
				$msg = 'You have logout successfully!';
			break;
			case 'validlogin':
				$msg = 'You have successfully login ' . $_SESSION['fname'] . '!';
			break;
			case 'invalidLogin':
				$msg = 'Username or Password incorrect. Please try again!';
			break;
			case 'userExist':
				$msg = 'Username Already Exist!';
			break;
			case 'passMissMatch':
				$msg = 'Password Not the Same!';
			break;
			case 'invalidEmail':
				$msg = 'Email has an Invalid format!';
			break;
			case 'invalidVarify':
				$msg = 'Incorrect Code!';
			break;
			case 'varifyComplete':
				$msg = 'Congratulation you are Human!';
			break;
			case 'notLogin':
				$msg = 'Sorry you must be login to create, edit or delete posts!';
			break;
			case 'noEditPermission':
				$msg = 'Sorry you do not have permission to edit this post!';
			break;
			case 'registerComplete':
				$msg = 'Registration Completed! Please login!';
			break;
			case 'invaldUser':
				$msg = 'Sorry user could not be found!';
			break;
			default:
				$msg = '';
			break;
		} 
	}

?>