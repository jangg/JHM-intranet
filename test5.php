<?php

error_reporting(0);

?>

<?php

$msg = ""; 

// check if the user has clicked the button "UPLOAD" 

if (isset($_POST['uploadfile'])) {

	$filename = $_FILES["choosefile"]["name"];

	$tempname = $_FILES["choosefile"]["tmp_name"];  

		$folder = "image/".$filename;   

	// connect with the database

	$db = mysqli_connect("localhost", "root", "", "Image_Upload"); 

		// query to insert the submitted data

		$sql = "INSERT INTO image (filename) VALUES ('$filename')";

		// function to execute above query

		mysqli_query($db, $sql);       

		// Add the image to the "image" folder"

		if (move_uploaded_file($tempname, $folder)) {

			$msg = "Image uploaded successfully";

		}else{

			$msg = "Failed to upload image";

	}

}

$result = mysqli_query($db, "SELECT * FROM image");

?>
<!DOCTYPE html>

<html>
<head>

	<title>Image Upload in PHP</title>

	<! link the css file to style the form >

	<link rel="stylesheet" type="text/css" href="style.css" />
	<style>
	#wrapper{
	
		width: 50%;
	
		margin: 20px auto;
	
		border: 2px solid #dad7d7;
	
	}
	
	form{
	
		width: 50%;
	
		margin: 20px auto;
	
	}
	
	form div{
	
		margin-top: 5px;
	
	}
	
	img{
	
		float: left;
	
		margin: 5px;
	
		width: 280px;
	
		height: 120px;
	
	}
	
	#img_div{
	
		width: 70%;
	
		padding: 5px;
	
		margin: 15px auto;
	
		border: 1px solid #dad7d7;
	
	}
	
	#img_div:after{
	
		content: "";
	
		display: block;
	
		clear: both;
	
	}
	</style>
</head>

<body>

	<div id="wrapper">

		<! specify the encoding type of the form using the 

				enctype attribute >

		<form method="POST" action="" enctype="multipart/form-data">        

			<input type="file" name="choosefile" value="" />

			<div>

				<button type="submit" name="uploadfile">

				UPLOAD

				</button>

			</div>

		</form>

	</div>

</body>

</html>