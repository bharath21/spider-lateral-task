
<?php
/*this file checks user login ststus i.e., 
if session is set(which is the case when user is switching between pages)
 or if cookies is set(which is the case when user opens site afetr closing browser)*/
session_start();
include("connect.inc.php");
// Files that inculde this file at the very top would NOT require 
// connection to database or session_start()
// Initialize some vars
$user_ok = false;
$log_id = "";
$log_username = "";
$log_password = "";
// User Verify function

function evalLoggedUser($conx,$id,$u,$p){
	$sql = "SELECT id FROM users1 WHERE username='$u' AND password='$p' LIMIT 1";
    $query = mysqli_query($conx, $sql);
    $numrows = mysqli_num_rows($query);
	if($numrows > 0){
		return true;
	}
}

//if sessions are set
if(isset($_SESSION["user_id"]) && isset($_SESSION["user_name"]) && isset($_SESSION["password"])) {
	$log_id = preg_replace('#[^0-9]#', '', $_SESSION['user_id']);
	$log_username = preg_replace('#[^a-z0-9]#i', '', $_SESSION['user_name']);
	$log_password = preg_replace('#[^a-z0-9]#i', '', $_SESSION['password']);
	// Verify the user

	$user_ok = evalLoggedUser($con,$log_id,$log_username,$log_password);}
	//if cookies are set

    else if(isset($_COOKIE["id"]) && isset($_COOKIE["user"]) && isset($_COOKIE["pass"])){
	$_SESSION['user_id'] = preg_replace('#[^0-9]#', '', $_COOKIE['id']);
    $_SESSION['user_name'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['user']);
    $_SESSION['password'] = preg_replace('#[^a-z0-9]#i', '', $_COOKIE['pass']);

	$log_id = $_SESSION['user_id'];
	$log_username = $_SESSION['user_name'];
	$log_password = $_SESSION['password'];
	// Verify the user
	$user_ok = evalLoggedUser($con,$log_id,$log_username,$log_password);}
	//lastlogin update
	if($user_ok == true){
		// Update their lastlogin datetime field
		$sql = "UPDATE users1 SET lastlogin=now() WHERE id='$log_id' LIMIT 1";
        $query = mysqli_query($con, $sql);
	}


?>

 
