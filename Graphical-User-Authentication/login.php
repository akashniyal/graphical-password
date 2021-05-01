<?php
	
	session_start();
	require 'database.php';
	if( isset($_SESSION['email']) ){
		header("login.php");
		
		//print_r($_SESSION);
		$email = $_SESSION['email'];
		//$_SESSION['attemps'] = 0;
		
		
		
		if(isset($email) && isset($_POST['password'])){
			
			/*$records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
				$records->bindParam(':email', $_POST['email']);
				$records->execute();
				$results = $records->fetch(PDO::FETCH_ASSOC);
				
				$message = '';
				
				if((!empty($results)) && password_verify($_POST['password'], $results['password']) ){
				
				$_SESSION['email'] = $results['email'];
				header("Location: profile.php");
				
				} else {
				$message = 'Sorry, those credentials do not match';
				}
				
				endif;
			*/
			$password = $_POST['password'];
			$email = $_POST['email'];
			$sql = "SELECT id,email,password FROM users WHERE email = '".$email."'";
			$row = mysqli_fetch_assoc(mysqli_query($link, $sql));
			//print_r($row);
			if($row > 0){
				if($row['password']==$password){
					$message = 'Successfully Logged in';
					$_SESSION['email'] = $_POST['email'];
					header("Location: otp.php");
					//session_destroy();
					}else {
					//print_r($_SESSION);
					if(!ISSET($_SESSION['attempt'])){
						$_SESSION['attempt'] = 1;
						$message = 'Invalid username or password. "'.$_SESSION['attempt'].'" attempt';
						}else{
						$_SESSION['attempt'] += 1;
						$message = 'Invalid username or password. "'.$_SESSION['attempt'].'" attempt';
					}
					if($_SESSION['attempt'] >= 4){
						$message = 'disabled.. Please Try after some time';
						$_SESSION['msg'] = "disabled.. Please Try after some time";
						//header("Location: index.php");
					}
					
					
					
				} 
				
				}else{
				$message = 'Sorry there must have been an issue creating your account';
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
	}
	
?>
<!DOCTYPE html>
<html>
	
	<!----HEAD------------------------>    
	<head>
		<center><title>Login</title></center>
		<link rel="stylesheet" type="text/css" href="assets/css/style.css">
		<link href="https://fonts.googleapis.com/css?family=Playfair+Display" rel="stylesheet">
	</head>
	<!----HEAD------------------------> 
	
	<style>
		.info{
		
		position: relative;
		padding-top: 30%;
		}
		
		
	</style>
	
	<!----BODY------------------------>     
	<body bgcolor="grey">
		
		<ul>
			<?php if(empty($_SESSION)){?>
				<li class="active"><a href="home.php">Login</a></li>
				<?php }else{?>
				<li class="active"><a href="#" class="active" >Login</a></li>
			<?php } ?>
			<li><a href="register.php">Register</a></li> 
			<li style="float:right"><a class="black">Graphical User Authentication</a></li>
			<li style="float:right"><a  ><? echo $email;?> </a></li>
		</ul>
		
		<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
		<?php endif; ?>
		
		<h1>Login</h1>
		
		
		<div class="parent">
			<div class="container">
				<?php 
					require 'database.php';
					if( isset($_SESSION['email']) ){
						$email = $_SESSION['email'];
					
					$sql = "SELECT image FROM images WHERE email = '".$email."'";
					$row = mysqli_fetch_assoc(mysqli_query($link, $sql));
					?>
				
				<?php if($row){ ?> 
					<div class="gallery">  
						<img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" alt="penguin" style="width:309px;height:309px;">
						<?php } ?> 
					</div> 
					<?php }else{ ?> 
					<p class="status error">Image(s) not found...</p> 
				<?php } ?>
			</div>
			
			<div >
				<div class="wrapper" >
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
			
		</div> 
		
		
		
		
		<div class="info">
			<form  method="POST">
				
				<input class="form-control" type="email" placeholder="Enter your email" name="email" value='<?php if(isset($_SESSION['email'])){echo $email;}?>' readonly required>
				<br>
				
				<input style="display:none;" id="mytext" onfocus="this.value=''" type="password" placeholder="password" name="password" readonly required> 
				<button id="reset">Clear Password</button>
				<br>
				
				<?php if(isset($_SESSION['attempt'])){if($_SESSION['attempt'] >= 4){  }else{?>
					<input type="submit" style="background-color: black;">
				<?php }}else{ ?>
				<input type="submit" style="background-color: black;">
				<?php } ?>
				<a href="index.php" class="btn">Back</a>
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
		
		<script type="text/javascript">
			document.getElementById('reset').onclick= function() {
				var field= document.getElementById('mytext');
				field.value= field.defaultValue;
			};
		</script>
		
		<!----JAVASCRIPT------------------------> 
		
	</body>
	<!----BODY------------------------> 
	
</html>	