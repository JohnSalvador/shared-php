<?php
//NOTE: $_FILES is a multi-associative array
/* $name = $_FILES['file']['name']; my version */
//$size = $_FILES['file']['size'];
//$type = $_FILES['file']['type'];

/* $tmp_name = $_FILES['file']['tmp_name']; */
//$error = $_FILES['file']['error'];
$max_size = 100000;

if(isset($_FILES['file']['name']) && isset($_FILES['file']['tmp_name'])){
	
	$name = $_FILES['file']['name'];
	$tmp_name = $_FILES['file']['tmp_name'];
	$type = $_FILES['file']['type'];
	$size = $_FILES['file']['size'];
	
	$extension = strtolower(substr($name, strpos($name,'.')+1));
	
	if(!empty($name)){
		if(($extension=='jpg'||$extension=='jpeg')
		&&($type=='image/jpeg'||$type=='image/jpg')
		&&$size<$max_size){
			echo 'OK.';
			$location = 'uploads/';
			if(move_uploaded_file($tmp_name, $location.$name)){
				echo 'Uploaded!';
			}
		} else {
			echo 'File must be a jpg or jpeg image file & must be less than 100kb';	
		}
	} else{
		'Please choose a file.';
	}
}
?>

<form action="upload.php" method="POST" enctype="multipart/form-data">
	<input type="file" name="file"/> <br /><br />
    <input type="submit" value="Submit" />
</form>

