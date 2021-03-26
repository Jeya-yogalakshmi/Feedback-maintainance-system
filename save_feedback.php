<?php
session_start();
var_dump($_SESSION);
require_once ("DbConn.php");

$feedback 	=	$_POST['feedback'];
$Category 	=	$_POST['Category'];
$PostedBy 	=	$_SESSION['studentid'];
$date		=	date('Y-m-d');

$query="insert into feedbackdetails values(default,'$feedback','$PostedBy','$date','Not Adressed','$Category',0,0)";
mysqli_query($con,$query);

if($con->error){
	echo $con->error;
}
header('Location: feedback_pg.php?inserted=1');
?>
