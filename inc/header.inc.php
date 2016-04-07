<?php
include("check_login_status.php");
// If user is already logged in, header him to his user page

if($user_ok == true){
	$user=$_SESSION["user_name"];
	header("location: ".$_SESSION["user_name"]);
    exit();
}

else{
	$user="";
}

?>




<!DOCTYPE html>
<html lang="en">
<head>
	<title>MOVIEBUFF</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<link rel="stylesheet"  type="text/css" href="./css/style.css" />
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<link href="http://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link href="http://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>

<body id="mypage" data-spy="scroll" data-target=".navbar" data-offset="50">
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php">MOVIEBUFF</a>
		</div>
		<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav navbar-right">
				
				<?php
				if($user==""){
				echo'
				<li><a href="#log_in">Login</a></li>
				<li><a href="#sign_up">Signup</a></li>';
				}
				else{
					echo'
					<li><a href="$user">my_profile</a></li>;
					<li><a href="account_settings1.php">account settings</a></li>';
					
				}

				?>
				<li><a href="#about_us">About us</a></li>
				
			</ul>
		</div>
	</div>
</nav>







