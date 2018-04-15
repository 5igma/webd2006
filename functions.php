<?php 
	function loadCategories()
	{
		global $db;
		global $statement;
		$query = "SELECT * FROM categories;";
		$statement = $db->prepare($query);
		$statement->execute();
	}

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

	function loadUsers()
	{
		global $db;
		global $statement;
		$query = "SELECT * FROM Users;";
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

	function showComment($postid)
	{
		global $db;
		global $statement;
		$query = "SELECT * FROM comments c JOIN users u ON c.userid = u.userid WHERE postid = :postid ORDER BY date DESC;";
		$statement = $db->prepare($query); 
		$bind_values = ['postid' => $postid];
		$statement->execute($bind_values);
	}

	function showPostByCategory($categoryid)
	{
		global $db;
		global $statement;
		$query = "SELECT * FROM posts p JOIN postscategories c ON p.postid = c.postid WHERE c.categoryid = :categoryid";
		$statement = $db->prepare($query); 
		$bind_values = ['categoryid' => $categoryid];
		$statement->execute($bind_values);
		if($statement->rowCount() <= 0) {
			header("Location: index.php");
		die();
		}
	}

	function showCategories($postid)
	{
		global $db;
		// global $statement;
		$query = "SELECT categoryid FROM postscategories WHERE postid = :postid;";
		$substatement = $db->prepare($query); 
		$bind_values = ['postid' => $postid];
		$substatement->execute($bind_values);
		if($substatement->rowCount() > 0) {
			while ($row = $substatement->fetch()){
				$query = "SELECT name FROM Categories WHERE categoryid = '".$row['categoryid']."'";
				$statement = $db->prepare($query);
				$statement->execute();
				while ($row2 = $statement->fetch()){
					echo $row2['name'];
				}
				echo ' ';
			}
		} else {
			echo 'no categories assigned';
		}
	}

	function getCategories($postid)
	{
		global $db;
		global $statement;
		$query = "SELECT c.categoryid, c.name FROM categories c JOIN postscategories p on c.categoryid = p.categoryid WHERE p.postid = :postid;";
		$bind_values = ['postid' => $postid];
		$statement = $db->prepare($query);
		$statement->execute($bind_values);
	}

	function search($string){

		$min_length = 3;

		if(strlen($string) >= $min_length){

			$string = htmlspecialchars($string); 
			//$string = mysql_real_escape_string($string);
			$string = '%'.$string.'%';

			global $db;
			global $statement;
			$query = "SELECT * FROM `posts` WHERE `title` LIKE :string OR `message` LIKE :string";
			$statement = $db->prepare($query);
			$bind_values = ['string' => $string];
			$statement->execute($bind_values);

			if($statement->rowCount() > 0){

			} else {
				echo "No results";
			}

		} else {
			echo "Minimum length is ".$min_length;
		}
	}

	function searchCategory($string, $categoryid){

		$min_length = 3;

		if(strlen($string) >= $min_length){

			$string = htmlspecialchars($string); 
			//$string = mysql_real_escape_string($string);
			$string = '%'.$string.'%';

			global $db;
			global $statement;
			$query = "SELECT * FROM posts p JOIN postscategories c ON p.postid = c.postid WHERE (`title` LIKE :string OR `message` LIKE :string) AND c.categoryid = :categoryid";
			$statement = $db->prepare($query);
			$bind_values = ['string' => $string, 'categoryid' => $categoryid];
			$statement->execute($bind_values);

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