<?php 

	include_once('config.php');

    if($isLogin){
    	SESSION_UNSET();
        $isLogin = false;
        header('location:index.php?msg=logout');
    } else {
    	header('location:index.php?msg=notLoggedIn');
    }

?>