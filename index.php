<?php include ("./inc/header.inc.php");?>


<?php
//signup validation
$reg=@$_POST['reg'];
$un="";$em="";$em2="";$pswd="";$pswd2="";$d="";$u_check="";
$unErr="";$emErr="";$em2Err="";$pswdErr="";$pswd2Err="";

//sanitizing data
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   
   return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

	$d = date("y-m-d");

	if(empty($_POST["username"])){
	$unErr="please fill first name";
		}

	else{

	$un=test_input($_POST["username"]);

	if (!preg_match("/^[a-zA-Z0-9 ]*$/",$un)) {
       $unErr = "Only letters and white space allowed"; 
     }

	 $u_query= "select * from users1 where username='$un'";
    $u_result = mysqli_query($con,$u_query);
	if(mysqli_num_rows($u_result)>=1){
		$unErr = "username already taken";
	}
}
if(empty($_POST["email1"])||empty($_POST["email2"])){
	$emErr="please fill email address";
}
else{
	$em = test_input($_POST["email1"]);
	$em2 = test_input($_POST["email2"]);
     // check if e-mail address is well-formed
     if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
       $emErr = "Invalid email format"; 
     }
	$e_query= "select * from users1 where email='$em'";
    $e_result = mysqli_query($con,$e_query);
	if(mysqli_num_rows($e_result)>=1){
		$emErr = "email already taken";
	}
	if($em != $em2){
		$emErr = "emails dont match";
	}
}

if(empty($_POST["password1"])||empty($_POST["password2"])){
	$pswdErr="please fill password";
}

else{
	$pswd=$_POST["password1"];
	$pswd2=$_POST["password2"];
	if(strlen($pswd)>30||strlen($pswd)<5){
		$pswdErr="your password must be between 5 and 30 characters long";
	}

	if($pswd != $pswd2){
		$pswdErr="passwords dont match";
	}
	
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
	
if($unErr=="" && $emErr=="" && $em2Err=="" && $pswdErr==""){
	//md5 password(encryption)
$pswd = md5($pswd);
$pswd2 = md5($pswd2);
$query=mysqli_query($con,"INSERT INTO users1(id,username,email,password,sign_up_date,bio,profile_pic,user_photos) VALUES ('','$un','$em','$pswd','$d','','','')");
die("<h2>login to get started</h2>");
}
}



}


//login validation
if(isset($_POST["user_login"]) && isset($_POST["password_login"])){
    $user_login =  preg_replace('#[^A-Za-z0-9]#i','',$_POST["user_login"]);
	$password_login = $_POST["password_login"];
	$password_login_md5 = md5($password_login);
	$sql = "SELECT id FROM users1 WHERE username='$user_login' AND password='$password_login_md5' LIMIT 1";
	$result= mysqli_query($con,$sql);
	//if login crediential information is correct
	if (mysqli_num_rows($result)== 1){
		while($row=mysqli_fetch_array($result,MYSQLI_NUM)){
			$db_id=$row[0];
			//$db_username = $row["username"];
			//$db_pass_str = $row["password"];
			
		}
		$_SESSION['user_id'] = $db_id;
		$_SESSION["user_name"]=$user_login;
		$_SESSION['password'] = $password_login_md5;
		
		//set cookies for 30 days
		setcookie("id", $db_id, strtotime( '+30 days' ), "/", "", "", TRUE);
		setcookie("user", $user_login, strtotime( '+30 days' ), "/", "", "", TRUE);
    	setcookie("pass", $password_login_md5, strtotime( '+30 days' ), "/", "", "", TRUE); 
        
		/*
		if(count($_COOKIE)>0){
			echo "enabled\n";
		}*/
		//header to home page
		header("location:home.php");
		exit();
	}
	else{
		echo "either username or password is incorrect,try again!";
	exit();
	}
	
	}
	

?>


<div id="myCarousel" class="carousel slide" data-ride="carousel" data-interval="1500" data-pause=false>
	<!--indicators-->
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
		<li data-target="#myCarousel" data-slide-to="3"></li>
		<li data-target="#myCarousel" data-slide-to="4"></li>
	</ol>
	
	<!--Wrapper for slides-->
	<div class="carousel-inner" role="listbox">
		<div class="item active">
			<img src="./img/super11.jpg"/ alt="baby_photo" width="1280" height="720">
			<div class="carousel-caption">
				<h3>adorable</h3>
			</div>
		</div>
		<div class="item">
			<img src="./img/super12.jpg"/ alt="girl_photo" width="1280" height="720">
			<div class="carousel-caption">
				<h3>t</h3>
			</div>
		</div>
		<div class="item">
			<img src="./img/super13.jpg"/ alt="samantha_photo" width="1280" height="720">
			<div class="carousel-caption">
				<h3>sha</h3>
			</div>
		</div>
		<div class="item">
			<img src="./img/super14.jpg"/ alt="baby2_photo" width="1280" height="720">
			<div class="carousel-caption">
				<h3>adorable</h3>
			</div>
		</div>
		<div class="item">
			<img src="./img/super15.jpg"/ alt="hero_photo" width="1280" height="720">
			<div class="carousel-caption">
				<h3>Haha</h3>
			</div>
		</div>
	</div>
	
	<!--left and right controls-->
	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>
<div id="log_in" class="bg-1">
<div class="container row">
	<div class="col-sm-4 text-center">
		<div class="thumbnail">
			<img src="./img/super16.jpg"/ alt="alia_photo" width="700" height="500">
			<p><strong>CELEB MANIA</strong></p>
		</div>
	</div>
	<div class="col-sm-8 container">
		<h2>SIGN IN BELOW</h2>
		<form role="form" action="index.php" method="POST" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">Email/Username/mobile_no.:</label>
				<div class="col-sm-8"> 
				<input type="text" name="user_login" class="form-control" id="email" placeholder="Email/Username/mobile_no.">
				</div>
			</div>
			<div class="form-group">
				<label  for="pwd" class="control-label col-sm-4">Password:</label>
				<div class="col-sm-8">
				<input type="password" name="password_login" class="form-control" id="pwd" placeholder="Enter password">
				</div>
			</div>
			<div class="row">
			<div class="col-sm-4"></div>
			<div class="checkbox col-sm-4">
				<label><input type="checkbox" name="remember_me">Remember Me</label>
			</div>
			<div class="col-sm-2"></div>
			<div class="col-sm-2">
			<button type="submit" name="login" class="btn btn-default">LOG IN</button>
			</div>
			</div>
		</form>
	</div>
</div>
</div>
<div id="sign_up" class="bg-1">
<div class="container row">
	<div class="col-sm-4 text-center">
		<div class="thumbnail">
			<img src="./img/img1.jpg"/ alt="samantha_photo" width="700" height="500">
			<p><strong>CELEB MANIA</strong></p>
		</div>
	</div>
	<div class="col-sm-8 container">
		<h2>SIGN UP BELOW</h2>
		<form role="form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" class="form-horizontal">
			<div class="form-group">
				<label class="control-label col-sm-4" for="username">Username/mobile_no.:</label>
				<div class="col-sm-8"> 
				<input type="text" name="username" class="form-control" id="username" placeholder="Username(white spaces are not allowed)." required>
				<span class="error"> <?php echo $unErr;?></span>
				</div>
			</div>
			<div class="form-group">
				<label  for="pwd1" class="control-label col-sm-4">Password:</label>
				<div class="col-sm-8">
				<input type="password" name="password1" class="form-control" id="pwd1" placeholder="Enter password(minimum 5 chars )" required>
				<span class="error"> <?php echo $pswdErr;?></span>
				</div>
			</div>
			<div class="form-group">
				<label  for="pwd2" class="control-label col-sm-4">Reenter Password:</label>
				<div class="col-sm-8">
				<input type="password" name="password2" class="form-control" id="pwd2" placeholder="Enter password Again" required>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">Email:</label>
				<div class="col-sm-8"> 
				<input type="email" name="email1" class="form-control" id="email" placeholder="Enter Valid Email" required>
				<span class="error"> <?php echo $emErr;?></span>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-sm-4" for="email">Reenter Email:</label>
				<div class="col-sm-8"> 
				<input type="email" name="email2" class="form-control" id="email" placeholder="Reenter Email" required>
				</div>
			</div>
			<div class="row">
			<div class="col-sm-10"></div>
			<div class="col-sm-2">
			<button type="submit" name="reg" class="btn btn-default">Sign Up</button>
			</div>
			</div>
		</form>
	</div>
</div>
</div>
<div id="about_us" class="bg-1">
<div class="container">
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators 
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>-->

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active text-center">
			<h3>WHAT IS THIS ABOUT</h3>
			<p>this site is about rating movies...</p>
		</div>
		<div class="item text-center">
			<h3>WHAT CAN YOU DO HERE</>
			<p>you can rate movies here...blah blah</p>
		</div>know
		<div class="item text-center">
			<h3>WHAT U NEED TO START</h3>
			<p>just sign up and get started </p>
		</div>
	</div>
	<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
		<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
	</div>
</div>
</div>
<?php include ("./inc/footer.inc.php");?>

			
					
				
			
			
	