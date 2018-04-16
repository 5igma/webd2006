<?php
	include_once('config.php');

	$pageTitle="Index";

	include_once('header.php');

	if(!$_SESSION['varify']){
		header('Location: varify.php');
	}

	if (!isset($_SESSION['userid'])){
		header("Location: index.php?msg=notLogin");
	}

	function resize_image($file, $w, $h, $crop=FALSE) {
	    list($width, $height) = getimagesize($file);
	    $r = $width / $height;
	    if ($crop) {
	        if ($width > $height) {
	            $width = ceil($width-($width*abs($r-$w/$h)));
	        } else {
	            $height = ceil($height-($height*abs($r-$w/$h)));
	        }
	        $newwidth = $w;
	        $newheight = $h;
	    } else {
	        if ($w/$h > $r) {
	            $newwidth = $h*$r;
	            $newheight = $h;
	        } else {
	            $newheight = $w/$r;
	            $newwidth = $w;
	        }
	    }
	    $src = imagecreatefromjpeg($file);
	    $dst = imagecreatetruecolor($newwidth, $newheight);
	    imagecopyresampled($dst, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

	    return $dst;
	}

	// file_upload_path() - Safely build a path String that uses slashes appropriate for our OS.
    // Default upload path is an 'uploads' sub-folder in the current folder.
    function file_upload_path($original_filename, $upload_subfolder_name = 'uploads') {
       $current_folder = dirname(__FILE__);
       
       // Build an array of paths segment names to be joins using OS specific slashes.
       $path_segments = [$current_folder, $upload_subfolder_name, basename($original_filename)];
       
       // The DIRECTORY_SEPARATOR constant is OS specific.
       return join(DIRECTORY_SEPARATOR, $path_segments);
    }

    // file_is_an_image() - Checks the mime-type & extension of the uploaded file for "image-ness".
    function file_is_an_image($temporary_path, $new_path) {
        $allowed_mime_types      = ['image/gif', 'image/jpeg', 'image/png'];
        $allowed_file_extensions = ['gif', 'jpg', 'jpeg', 'png'];
        
        $actual_file_extension   = pathinfo($new_path, PATHINFO_EXTENSION);
        $actual_mime_type        = getimagesize($temporary_path)['mime'];
        
        $file_extension_is_valid = in_array($actual_file_extension, $allowed_file_extensions);
        $mime_type_is_valid      = in_array($actual_mime_type, $allowed_mime_types);
        
        return $file_extension_is_valid && $mime_type_is_valid;
    }
    
    $image_upload_detected = isset($_FILES['image']) && ($_FILES['image']['error'] === 0);
    $upload_error_detected = isset($_FILES['image']) && ($_FILES['image']['error'] > 0);

    if ($image_upload_detected) { 
        $image_filename        = $_FILES['image']['name'];
        $temporary_image_path  = $_FILES['image']['tmp_name'];
        $new_image_path        = file_upload_path($image_filename);
        $actual_file_extension   = pathinfo($new_image_path, PATHINFO_EXTENSION);
        


        if (file_is_an_image($temporary_image_path, $new_image_path)) {
        	$imagename = $_SESSION["uname"].'.'.$actual_file_extension;
        	$userid = $_SESSION["userid"];
            $active = true;

            move_uploaded_file($temporary_image_path, $new_image_path);
            $img = resize_image($new_image_path, 200, 200);
            imagejpeg($img, $new_image_path);
            rename($new_image_path, './uploads/'.$imagename);
            

			$query = "SELECT userid FROM profileimage WHERE userid = :userid LIMIT 1";
			$statement = $db->prepare($query);
			$bind_values = ['userid' => $userid];
			$statement->execute($bind_values);

			if($statement->rowCount() == 0){
				$query = "INSERT INTO profileimage (userid, imagename, active) VALUES (:userid, :imagename, :active)";
	            $statement = $db->prepare($query);
	            $bind_values = ['userid' => $userid, 'imagename' => $imagename, 'active' => $active];
	            $statement->execute($bind_values);
	            header('location:profile.php');
			} else {
				$query = "UPDATE profileimage SET imagename = :imagename, active = :active WHERE userid = :userid";
	            $statement = $db->prepare($query);
	            $bind_values = ['userid' => $userid, 'imagename' => $imagename, 'active' => $active];
	            $statement->execute($bind_values);
	            header('location:profile.php');
			}


            
        }
    }
?>

<form method="post" enctype="multipart/form-data">
	<label for="image">Select Profile Image:</label>
	<input type="file" name="image" id="image">
	<input type="submit" name="submit" value="Upload Image">
</form>

<?php if ($upload_error_detected): ?>

        <p>Error Number: <?= $_FILES['image']['error'] ?></p>

    <?php elseif ($image_upload_detected): ?>

    <?php endif ?>