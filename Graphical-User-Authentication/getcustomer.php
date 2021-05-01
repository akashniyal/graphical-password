<?php
session_start();

if( isset($_SESSION['user_id']) ){
	header("login.php");
}

require 'database.php';

/* [FETCH IMAGE] */
$stmt = $pdo->prepare("SELECT `data` FROM `upload` WHERE `name`=?");
$stmt->execute(array($_GET['f']));
$img = $stmt->fetch();

/* [OUTPUT] */
// DO MORE ERROR CHECKING & HANDLING HERE IF YOU WANT
// NOT FOUND - SHOW BLANK IMAGE
if ($img==false) { 
  require "0-not-found.jpg";
} else {
  echo $img['data'];
}


?>

