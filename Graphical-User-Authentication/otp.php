<?php
	$success = "";
	$error_message = "";
	session_start();
	require 'database.php';
	header("login.php");
	print_r($_SESSION);
	$email = $_SESSION['email'];
	//print_r($email);
	if(!empty($_POST["submit_email"])) {
		$success=1;
		// generate OTP
		$otp = rand(100000,999999);
		// Send OTP
		require('phpmailer/class.phpmailer.php');
		require('phpmailer/class.smtp.php');
		print_r($otp);
		$message_body = "One Time Password for PHP login authentication is:<br/><br/>" . $otp;
		$mail = new PHPMailer();
		$mail->IsSMTP();
		$mail->SMTPDebug = 0;
		$mail->SMTPAuth = TRUE;
		$mail->SMTPSecure = 'tls'; // tls or ssl
		$mail->Port     = "SMTP port";
		$mail->Username = "SMTP username";
		$mail->Password = "SMTP Password";
		$mail->Host     = "SMTP HOST";
		$mail->Mailer   = "smtp";
		$mail->SetFrom("FROM EMAIL", "FROM NAME");
		$mail->AddAddress($email);
		$mail->Subject = "OTP to Login";
		$mail->MsgHTML($message_body);
		$mail->IsHTML(true);		
		$result = $mail->Send();
		print_r($result);
		//return $result;
		$sql = "INSERT INTO otp_expiry (email,otp,is_expired) VALUES ('".$email."','" . $otp . "', 0)";
		$row = mysqli_query($link, $sql);
			if($row>1) {
				$success=1;
			}
		
	}
	
	if(!empty($_POST["submit_otp"])) {
		$sql = "SELECT * FROM otp_expiry WHERE email = '".$email."' ORDER BY sno DESC";
		$row = mysqli_fetch_assoc(mysqli_query($link, $sql));
		print_r($row);
		if($_POST['otp'] == $row['otp'] ){
			$sql = "UPDATE otp_expiry SET is_expired='1' WHERE otp='" . $_POST["otp"] . "'";
			$row = mysqli_query($link, $sql);
			$success = 2;
			header("Location: profile.php");
			} else {
			$success =1;
			$error_message = "Invalid OTP!";
		}	
	}
?>
<html>
	<head>
		<title>User Login</title>
		<style>
			body{
			bgcolor:grey;
			text-align:center;
			}
			
			.tableheader { font-size: 20px; }
			.tablerow { padding:20px; }
			.error_message {
			color: #b12d2d;
			background: #ffb5b5;
			border: #c76969 1px solid;
			}
			.message {
			text-align:center;
			width: 100%;
			margin-left:37%;
			max-width: 300px;
			padding: 10px 30px;
			border-radius: 4px;
			margin-bottom: 5px;    
			}
			.login-input {
			border: #CCC 1px solid;
			padding: 10px 20px;
			border-radius:4px;
			}
			.btnSubmit {
			padding: 10px 20px;
			background: #2c7ac5;
			border: #d1e8ff 1px solid;
			color: #FFF;
			border-radius:4px;
			}
		</style>
	</head>
	<body bgcolor="grey">
		<?php
			if(!empty($error_message)) {
			?>
			<div class="message error_message"><?php echo $error_message; ?></div>
			<?php
			}
		?>
		
		<form name="frmUser" method="post" action="">
			<div class="tblLogin">
				<?php 
					if(!empty($success == 1)) { 
					?>
					<div class="tableheader">Enter OTP</div>
					<p style="color:#fff;">Check your email for the OTP</p>
					
					<div class="tablerow">
						<input type="text" name="otp" placeholder="One Time Password" class="login-input" required>
					</div>
					<div class="tableheader"><input type="submit" name="submit_otp" value="Submit" style="background-color: black;color:white"></div>
					<?php 
						} else if ($success == 2) {
					?>
					<p style="color:#31ab00;">Welcome, You have successfully loggedin!</p>
					<?php
					}
					else {
					?>
					
					<div class="tableheader">Enter Your Login Email</div>
					<div class="tablerow"><input type="text" name="email" placeholder="Email" class="login-input" value="<?php echo $email?>" required></div>
					<div class="tableheader"><input type="submit" name="submit_email" value="Submit" style="background-color: black;color:white"></div>
					<?php 
					}
				?>
			</div>
		</form>
	</body></html>	