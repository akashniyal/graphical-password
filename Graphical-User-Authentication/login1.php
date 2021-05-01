<?php

session_start();

require 'database.php';

if(!empty($_POST['email'])):
	
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
</head>
<!----HEAD------------------------> 
  

<!----BODY------------------------>     
<body bgcolor="grey">

	   		<ul>
  <li><a href="login1.php" class="active" >Login</a></li >
    <li><a href="register.php">Register</a></li> 
  <li style="float:right"><a class="black">Graphical User Authentication</a></li>
</ul>

	
	<h1>Login</h1>
    
    
      <?php if(!empty($message)): ?>
		<p><?= $message ?></p>
	<?php endif; ?>

        

    <div class="info">
	<form  method="POST">
		
		<input type="email" placeholder="Enter your email" name="email" required>
       
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