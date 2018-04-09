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

	function loadPostASC()
	{
		global $db;
		global $statement;
		$query = "SELECT * FROM posts ORDER BY title ASC;";
		$statement = $db->prepare($query);
		$statement->execute();
	}

	function loadPostDesc()
	{
		global $db;
		global $statement;
		$query = "SELECT * FROM posts ORDER BY title DESC;";
		$statement = $db->prepare($query);
		$statement->execute();
	}

	function loadPostDate()
	{
		global $db;
		global $statement;
		$query = "SELECT * FROM posts ORDER BY date DESC;";
		$statement = $db->prepare($query);
		$statement->execute();
	}

	function loadPostLastEdit()
	{
		global $db;
		global $statement;
		$query = "SELECT * FROM posts ORDER BY lastedit DESC;";
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

	function search($string){

		$min_length = 3;

		if(strlen($string) >= $min_length){

			$string = htmlspecialchars($string); 
			//$string = mysql_real_escape_string($string);

			global $db;
			global $statement;
			$query = "SELECT * FROM `posts` WHERE `title` LIKE '%".$string."%' OR `message` LIKE '%".$string."%'";
			$statement = $db->prepare($query);
			$statement->execute();

			if($statement->rowCount() > 0){

			} else {
				echo "No results";
			}

		} else {
			echo "Minimum length is ".$min_length;
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