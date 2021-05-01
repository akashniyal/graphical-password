<?php
	
	session_start();
	
	$email = $_SESSION['email'];
	
	require 'database.php';
	if(isset($_POST['submit'])){
		$status = 'error'; 
		$email = $_POST['email'];
		if(!empty($_FILES["image"]["name"])) { 
			// Get file info 
			$fileName = basename($_FILES["image"]["name"]); 
			$fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
			
			// Allow certain file formats 
			$allowTypes = array('jpg','png','jpeg','gif'); 
			if(in_array($fileType, $allowTypes)){ 
				$image = $_FILES['image']['tmp_name']; 
				$imgContent = addslashes(file_get_contents($image)); 
				
				// Insert image content into database 
				$db = new mysqli($server, $username, $password, $database);
				
				//Insert image content into database
				$sql = 'INSERT into images (image, email) VALUES ("' . $imgContent . '","' . $email . '")';
				$res =mysqli_query($link, $sql);
				if($res){
					$message =  "File uploaded successfully.";
					
					header("Location: profile.php");
					}else{
					$message =  "File upload failed, please try again.";
				} 
				}else{
				$message =  "Please select an image file to upload.";
			}
		}
		
	}
		if(empty($email)){
			$user = '';
			} else {
			$user =  $email;
		}
	?>
	
	<!DOCTYPE html>
	<html lang="en">
		<!----HEAD------------------------>    
		<head>
			<center><title>Profile</title></center>
			<link rel="stylesheet" type="text/css" href="assets/css/style.css">
			
		</head>
		<!----HEAD------------------------> 
		
		
		
		<body bgcolor="grey">
			
			<ul>
				
				
                <li style="float:right"><a class="black">Graphical User Authentication</a></li>
				<li style="float:right"><a  ><? echo $user;?> </a></li>
				
			</ul>
			
			<h1>Upload</h1>
			
			<?php if(!empty($message)): ?>
			<p><?= $message ?></p>
			<?php endif; ?>
			
			<form  method="post" enctype="multipart/form-data" >
				<font face="verdana">Select PNG image to upload (MAX SIZE: 1 MB) :</font>
				<input type="file" name="image" accept="image/*"/ required>
				<br>
				<img id="preview" style="width:309px;height:309px;"/>
				<br>
				<input type="email" placeholder="enter email" name="email" value="<?php echo $user;?>" readonly required>
				<br>
				<input type="submit" name="submit" value="UPLOAD"/>
			</form>
			
			<script>
				var inp = document.querySelector('input');
				inp.addEventListener('change', function(e){
					var file = this.files[0];
					var reader = new FileReader();
					reader.onload = function(){
						document.getElementById('preview').src = this.result;
					};
					reader.readAsDataURL(file);
				},false);
			</script>
			
		</body>
	</html>	