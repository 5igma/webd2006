<?php 
	function load10Post()
	{
		global $db;
		global $statement;
		$query = "SELECT * FROM posts LIMIT 10;";
		$statement = $db->prepare($query);
		$statement->execute();
	}

	function loadPost()
	{
		global $db;
		global $statement;
		$query = "SELECT * FROM posts;";
		$statement = $db->prepare($query);
		$statement->execute();
	}

	function showPost($postid)
	{
		global $db;
		global $statement;
		$query = "SELECT * FROM posts WHERE postid = :postid;";
		$statement = $db->prepare($query); 
		$bind_values = ['postid' => $postid];
		$statement->execute($bind_values);
		if($statement->rowCount() <= 0) {
			header("Location: index.php");
		die();
		}
	}

	function loadProfile($userid){
		global $db;
		global $statement;
		$query = "SELECT * FROM users WHERE userid = :userid;";
		$statement = $db->prepare($query); 
		$bind_values = ['userid' => $userid];
		$statement->execute($bind_values);
		if($statement->rowCount() <= 0) {
			header("Location: index.php?msg=invalidUser");
		die();
		}
	}



	function truncateContent($message, $postid) {
      
      if(strlen($message) <= 200){
        return $message;
      }

      return substr($message,0,200)." . . . <a href='show.php?postid=$postid'>(Show More)</a>";
    }
?>