<?php 
// include database connection 
require 'database.php';
$email = $_GET['email'];

$result = $conn->query("SELECT image FROM images WHERE email=$email");
$imgData = $result->fetch(PDO::FETCH_ASSOC);
header("Content-type: image/png");
echo $imgData['image']; 
?>
