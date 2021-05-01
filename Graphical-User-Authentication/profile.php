<?php

session_start();

$email = $_SESSION['email'];

require 'database.php';

if(!empty($_POST['email']) && !empty($_POST['password'])):
	
	$records = $conn->prepare('SELECT id,email,password FROM users WHERE email = :email');
	$records->bindParam(':email', $_POST['email']);
	$records->execute();
	$results = $records->fetch(PDO::FETCH_ASSOC);

	$message = '';

	if(count($results) > 0 && password_verify($_POST['password'], $results['password']) ){

		$_SESSION['user_id'] = $results['id'];
		header("login.php");

	} else {
		$message = 'Sorry, those credentials do not match';
	}

endif;

if(empty($email)){
    $user = '';
} else {
    $user =  $email;
}

?>




<!DOCTYPE html>
<html>
    
<!----HEAD------------------------>    
<head>
	<center><title>Profile</title></center>
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	
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
 
    <li><a href="index.php">Logout</a></li>
                <li style="float:right"><a class="black">Graphical User Authentication</a></li>
    <li style="float:right"><a  ><? echo $user;?> </a></li>
  
</ul>

	<?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

	<h1>Profile</h1>
    <h2>Welcome <? echo $user;?>! </h2>
    

    
</body>
<!----BODY------------------------> 
    
</html>