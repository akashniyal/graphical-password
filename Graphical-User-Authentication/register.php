<?php
	
	session_start();
	
	if( isset($_SESSION['user_id']) ){
		header("register.php");
	}
	
	require 'database.php';
	
	$message = '';
	
	
	
	if(!empty($_POST['email']) && !empty($_POST['password'] && !empty($_POST['phone']))){
		$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
		$email = $_POST['email'];
		$password = $_POST['password'];
		$phone = $_POST['phone'];
		if(!empty($email))
		{
			$sql = 'INSERT into users (email, password) VALUES ("' . $email . '","' . $password . '")';
			$res =mysqli_query($link, $sql);
			
			print_r($res);
			$message = 'Successfully created new user';
			$_SESSION['email'] = $_POST['email'];
			header("Location: upload.php");
		
	}
	
}

?>

<!DOCTYPE html>
<html>
	
    
	<head>
		<title>Register</title>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
	</head>
    
	<style>
		.info{
        
		position: relative;
		padding-top: 15%;
		}
	</style>
    
	<body bgcolor="grey" >
		
		
		<ul>
			<li><a href="login.php">Login</a></li>
			<li><a href="#" class="active">Register</a></li>
			
			<li style="float:right " readonly><a class="black">Graphical User Authentication</a> </li>
		</ul>
		
		
		
		<h1>Register</h1>
		
		<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
		<?php endif; ?>
		
		
		<div class="parent">
			<div class="container">
				<img src="World.png" alt="penguin" style="width:309px;height:309px;">
			</div>
			
			<div class="wrapper"  >
				<div class="box 1,1">1,1</div>
				<div class="box 1,2">1,2</div>
				<div class="box 1,3">1,3</div>
				<div class="box 1,4">1,4</div>
				<div class="box 1,4">1,5</div>
				
				<div class="box 2,1">2,1</div>
				<div class="box 2,2">2,2</div>   
				<div class="box 2,3">2,3</div>
				<div class="box 2,4">2,4</div>
				<div class="box 2,4">2,5</div>
				
				<div class="box 3,1">3,1</div>
				<div class="box 3,2">3,2</div>
				<div class="box 3,3">3,3</div>
				<div class="box 3,4">3,4</div>
				<div class="box 3,4">3,5</div>
				
				<div class="box 4,1">4,1</div>
				<div class="box 4,2">4,2</div>
				<div class="box 4,3">4,3</div>
				<div class="box 4,4">4,4</div>
				<div class="box 4,4">4,5</div>
				
				<div class="box 4,1">5,1</div>
				<div class="box 4,2">5,2</div>
				<div class="box 4,3">5,3</div>
				<div class="box 4,4">5,4</div>
				<div class="box 4,4">5,5</div>
				
				
				
				
				
			</div>
		</div> 
		
		<div class="info"  >
			
			<form  method="POST" class="info" >
				<input type="email" placeholder="enter email" name="email" required>
				<br> 
				<input type='tel' placeholder="enter phone"  name="phone" title='Phone Number (Format: (555)555-5555)' required>
				<br>
				<input style="display:none" id="mytext" type="password"  name="password" readonly required> 
				
				<input type="submit" class="button" style="background-color: black;">
				<br>
				<input type="reset" value="Reset">
			</form>
			
			
			
		</div>
		
		
		<script>
			var newArray= new Array();
			window.addEventListener("DOMContentLoaded", function() {
				let boxes = document.querySelectorAll(".box");
				
				Array.from(boxes, function(box) {
					
					box.addEventListener("click", function() {
						// alert(this.classList[1]);
						var test = this.classList[1];
						newArray.push(this.classList[1]);
						
						//alert("newArray contents = "+ newArray);
						
						// alert(newArray.join(''));
						var join = newArray.join('');
						document.getElementById("mytext").value = join;   
					});   
				});   
			}); 
		</script>
		
		
		
		
		
	</body>
	</html>	