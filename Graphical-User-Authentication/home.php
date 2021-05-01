<?php
	
	session_start();
	
	require 'database.php';
	
	if(!empty($_POST['email'])){
		/*
			$records = $conn->prepare('SELECT email FROM users WHERE email = :email');
			$records->bindParam(':email', $_POST['email']);
			$records->execute();
			$results = $records->fetch(PDO::FETCH_ASSOC);
			
			$message = '';
			
			if(!$results) {
			$message = 'Sorry, those credentials do not match';
			
			} else {
			$email = $_POST['email'];
			$_SESSION['email'] = $email;
			header("Location: login.php");
			
			};
			
			
			
			endif;
		*/
		
		$email = $_POST['email'];
		$sql = "SELECT email FROM users WHERE email = '".$email."'";
		$res =mysqli_query($link, $sql);
		//print_r($res);
		if(mysqli_num_rows($res) > 0){
			$email = $_POST['email'];
			$_SESSION['email'] = $email;
			header("Location: login.php");
		}
		else{
			$message = 'Sorry, those credentials do not match';
		}
	}
		//$result = $conn->query("SELECT image FROM users WHERE email = 'test9@gmail.com'");
		
		
        //$imgData = $result->fetch(PDO::FETCH_ASSOC);
        
        //Render image
		//header("Content-type: image/png"); 
		//header("Content-type: image/jpeg");
		//echo $imgData['image']; 
        
		//$sql = "SELECT image FROM users WHERE email = 'test14@gmail.com'";
		
		//$sth = $conn->query($sql);
		//$sth->execute();
		//$result = $sth->fetchAll(\PDO::FETCH_ASSOC);
		
		//header("Content-type: image/png");
		//echo $result['imageContent'];
		
		
	?>
	
	
	
	
	<!DOCTYPE html>
	<html>
		
		<!----HEAD------------------------>    
		<head>
			<center><title>Login</title></center>
			<link rel="stylesheet" type="text/css" href="assets/css/style.css">
			<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
      
      <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

		</head>
		<!----HEAD------------------------> 
		
		
		<!----BODY------------------------>     
		<body bgcolor="grey">
			
	   		<ul>
				<li><a href="login.php" class="active" >Login</a></li >
				<li><a href="register.php">Register</a></li> 
				<li style="float:right"><a class="black">Graphical User Authentication</a></li>
			</ul>
			
			
			<h1>Login</h1>
			
			
			<?php if(!empty($message)): ?>
			<p><?= $message ?></p>
			<?php endif; ?>
			
			
			
			<div class="info">
				<form  method="POST">
					
					<input class="form-control" type="email" placeholder="Enter your email" name="email" required>
					
					<br>
					<input type="submit" style="background-color: black;">
					
				</form>
			</div>
			
			<!----JAVASCRIPT------------------------>    
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
			
			<!----JAVASCRIPT------------------------> 
			
		</body>
		<!----BODY------------------------> 
		
	</html>	