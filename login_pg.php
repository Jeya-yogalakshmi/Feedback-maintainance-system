<?php
require_once ("DbConn.php");
session_start();
?>
<html>
<head>
	<meta charset="UTT-8"/>
  	<meta name="viewpoint" content="width=device-width, initial-scale=1.0"/>
  	<meta http-equiv="X-UA-Compatible" content="ie=edge"/>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

body{
	margin: 0;
	padding: 0;
}
body:before{
	content: '';
	position: fixed;
	width: 100vw;
	height: 100vh;
	background-image: url("https://res.cloudinary.com/twenty20/private_images/t_watermark-criss-cross-10/v1571223279000/photosp/29c0e998-750d-435d-bdf7-7a9572ceb9aa/stock-photo-shopping-technology-sale-laptop-web-banner-computer-keyboard-promotion-29c0e998-750d-435d-bdf7-7a9572ceb9aa.jpg");
	background-position: center center;
	background-repeat: no-repeat;
	background-attachment: fixed;
	-webkit-background-size:cover;
	background-size:cover;
	-webkit-filter:blur(8px);
	-moz-filter:blur(8px);
	filter:
}
.contact_form{
	position: absolute;
	top: 50%;
	left: 50%;
	-webkit-transform:translate(-50%,-50%);
	-moz-transform:translate(-50%,-50%);
	-ms-transform:translate(-50%,-50%);
	-o-transform:translate(-50%,-50%);
	transform: translate(-50%,-50%);
	width: 25%;
	height: 50%;
	padding: 80px 40px;
	background:rgba(0,0,0,0.6);
	border-color: red;
	border-width: 50px;
}
.avatar{
	position: absolute;
	width: 80px;
	height: 80px;
	border-radius: 50%;
	overflow: hidden;
	top: calc(-80px / 2);
	left: calc(50% - 40px);
}
.contact_form h2{
	margin: 0;
	padding: 0;
	color: #fff;
	text-align: center;
	text-transform: uppercase;
}
.contact_form p{
	margin: 0;
	padding: 0;
	font-weight: bold;
	color: #fff;
	font-size: 19;
}
.contact_form input{
	width: 100%;
	margin-bottom: 20px;
}
.contact_form input[type=text]{
	border: none;
	border-bottom: 1px solid #fff;
	background:transparent;
	outline: none;
	height: 35px;
	color: #fff;
	font-size: 15px;
}
.contact_form input[type=password]{
	border: none;
	border-bottom: 1px solid #fff;
	background:transparent;
	outline: none;
	height: 35px;
	color: #fff;
	font-size: 15px;
}
.contact_form input[type=submit]{
	height: 35px;
	color: #fff;
	font-size: 17px;
	background:red;
	cursor:pointer;
	border-radius: 25px;
	border:none;
	outline: none;
	margin-top: 15%;
	width: 100%;
}
.contact_form a{
	color: #fff;
	font-size: 14px;
	font-weight: bold;
	text-decoration: none;
}
input[type=checkbox]{
	width: 20%;
}
.account{
	font-size: 100px;
	font-weight: bold;
	position:relative;
	margin-bottom: 15px;
	color: white;
	padding: 25px;
}
.form_input{
	position: relative;
	display: flex;
	align-items: center;
	justify-content: center;
	width: 100%;
}
.icon{
	position: absolute;
	right: 15px;
	top: -10px;
	font-size: 25px;
	color: white;
	height: 100%;
	display: flex;
	align-items: center;
	justify-content: center;

}
#hide1{
	display: none;
}
</style>
</head>
<body>
	<div class="bg-img"></div>
<div class="contact_form">
	<img src="https://f1.pngfuel.com/png/13/136/63/hair-style-woman-female-girl-avatar-person-video-face-png-clip-art.png" alt="" class="avatar">
<form method="post">
	<p>user name:</p>
  	<input type="text" id="Username" placeholder="Enter username" name="Username"><br><br>
  	<p>password:</p>
  	<div class="form_input">
  		<input type="password" id="Password" name="Password" placeholder="Enter password" autocomplete="off" >
  		<span class="icon" onclick="myFunction()">
  			<i id="hide1" class="fa fa-eye"></i>
  			<i id="hide2" class="fa fa-eye-slash"></i>
  		</span>
  	</div>
  	<input type="submit" value="Sign in">
</form>
</div>
<script>
	function validateForm() {
  		var x = document.forms["myForm"]["Username"].value;
  		if (x == "") {
    	alert("Username must be filled out");
    	return false;
  		}
  		var x = document.forms["myForm"]["Password"].value;
  		if (x == "") {
    	alert("Password must be filled out");
    	return false;
  		}
	}
</script>
<script >
	function myFunction(){
		var p = document.getElementById("Password");
		var q = document.getElementById("hide1");
		var r = document.getElementById("hide2");

		if(p.type === 'password'){
			p.type = "text";
			q.style.display = "block";
			r.style.display = "none";
		}
		else{
			p.type = "password";
			q.style.display = "none";
			r.style.display = "block";
		}
	}
</script>
<?php
if($_POST){
	$Username=$_POST["Username"];
	$Password=$_POST["Password"];
	$selectQuery	=	"SELECT * FROM students WHERE Username='".$Username."' AND Password='".$Password."'";
	$result	=	mysqli_query($con,$selectQuery);
	if($result && $row= mysqli_fetch_array($result)){
//		header("Location: feedback_pg.php");
//		exit();
//		echo "<script>alert('successfully logged in...');</script>";
		$_SESSION['uname']=$Username;
		$_SESSION['studentid']=$row[0];
//		var_dump($_SESSION);
		echo "<script>window.location.href='feedback_pg.php';</script>";
	}
	else{
		echo "<script>alert('Login failed...');</script>";
	}
}
?>
</body>
</html>
