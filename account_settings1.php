<?php
include("./inc/sampleheader.inc.php");

?>
<?php
		$uploadpic =@$_POST['uploadpic'];
		$propic_Err="";
		$profile_pic=$profile_pic_user;
		$username=$user;

   
	   
   if(isset($_FILES['profilepic'])){
	   if(((@$_FILES["profilepic"]["type"]=="image/jpeg") || (@$_FILES["profilepic"]["type"]=="image/gif") || (@$_FILES["profilepic"]["type"]=="image/jpg") || (@$_FILES["profilepic"]["type"]=="image/png")) && (@$_FILES["profilepic"]["size"] < 2048576)){
		 $chars="abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		 $rand_dir_name = substr(str_shuffle($chars),0,15);
		 mkdir("userdata/profile_pics/$rand_dir_name"); 
		 
		 if(file_exists("userdata/profile_pics/$rand_dir_name/".@$_FILES["profilepic"]["name"])){
			 echo $_FILES["profilepic"]["name"] . "Already Taken";
		 }
		 else{
			 move_uploaded_file($_FILES["profilepic"]["tmp_name"],"userdata/profile_pics/$rand_dir_name/".$_FILES["profilepic"]["name"]);
		    $propic_Err="Uploaded and stored in :userdata/profile_pics/$rand_dir_name".@$_FILES["profilepic"]["name"];
		   $profile_pic_name=@$_FILES["profilepic"]["name"];
		   $profile_pic_query = mysqli_query($con,"UPDATE users1 SET profile_pic='$rand_dir_name/$profile_pic_name' WHERE username='$username'");
		 header("location: account_settings1.php");
		 }
		 
		 
		 
		 
	   }
	   else{
		    //$propic_Err="Invalid File ! your image must be no larger than 2 mb and it must be either a .jpg,.jpeg,.png,.gif files";
			echo '<script language="javascript">';
			echo 'alert("Invalid File ! your image must be no larger than 2 mb and it must be either a .jpg,.jpeg,.png,.gif files")';
			echo '</script>';
	   }
   }
   
		?>

<?php
$reg=@$_POST['submit'];
$un="";$tp="";$dob="";$status="";
$unErr="";$tpErr="";$dobErr="";
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
if($reg){
	 
if($_SERVER["REQUEST_METHOD"]=="POST"){
	if(empty($_POST["name"])){
		$unErr="please fill  name";
	}
	else{
		$un=test_input($_POST["name"]);
		if(!preg_match('/^[a-z A-Z]{5,}$/', $un)) { 
		// for english chars + numbers only
    // valid username, alphanumeric & longer than or equals 5 chars

  $unErr = "Only letters and white space allowed"; 
        }
		
	}
	
	
	
	
	if(empty($_POST["dob"])){
		$dobErr="please enter dob";
	}
	else{
		$dob=($_POST["dob"]);
	}
	if($_SERVER["REQUEST_METHOD"]=="POST"){
	
	if($unErr==""  && $dobErr==""){
		 
		
		$query=mysqli_query($con,"INSERT INTO personal_information(id,username,name,dob) VALUES ('','$user','$un','$dob')") or die("unable to update");
		$status="your details are received successfully";
		
	
	
	
}
	}
}
}
?>

	<?php
	$pswd1Err="";
	$pswd2Err="";
   $senddata =@$_POST['senddata'];
   $old_password = @$_POST['oldpassword'];
   $new_password = @$_POST['newpassword'];
   $repeat_password = @$_POST['newpassword2'];
   $old_password_md5 = md5($old_password);
   if($senddata){
   if($_SERVER["REQUEST_METHOD"]=="POST"){
	   $password_query = "SELECT * FROM users1 WHERE username='$user'";
	   $result = mysqli_query($con,$password_query);
	   while ($row = mysqli_fetch_assoc($result)){
		   $db_password = $row['password'];
		   if($old_password_md5 == $db_password){
			   if($new_password == $repeat_password){
				   if(strlen($new_password)>=5 && strlen($new_password)<=30){
				   $new_password_md5=md5($new_password);
				  $password_update_query = "UPDATE users1 SET password='$new_password_md5' WHERE username='$user'";
				  $result1= mysqli_query($con,$password_update_query);
                  die("success!your password is updated. u need to login again")	;	}
				   else{
					   
					   echo '<script language="javascript">';
			echo 'alert("your new password must be 5 to 30 characters long!")';
			echo '</script>';
				   }
			   }
			   else{
				   echo '<script language="javascript">';
			echo 'alert("passwords dont match")';
			echo '</script>';
			   }
		   }
		   else{
			 echo '<script language="javascript">';
			echo 'alert("old password incorrect")';
			echo '</script>';
		   }
	   }
	   
   }
   }
   ?>

 
<div class="container-fluid text-center"> 
	
  <div class="row content">
	
    <div class="col-sm-2 sidenav">
	<div class="profilepic">
		<?php echo
		"
		<img src=$profile_pic_user id='profile-photo' class='img-circle' alt='profilephoto' width='130px' height='130px' data-toggle='modal' data-target='#myModal' style='display:inline;'>
		
		<p><a href='#' id='change-picture'>Change picture</a></p>";?>
		</div>
     <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">change profile picture</h4>
      </div>
      <div class="modal-body">
	  
        <form action="" method="POST" enctype="multipart/form-data">
		<img src="<?php echo"$profile_pic";?>" width="100">
		<br><br>
		<input type="file" name="profilepic"  />
		
	<!--input type="submit" name="uploadpic" value="Upload Image" style="display:inline;"-->
	
	<button class="btn btn-default " type="submit" name="uploadpic">upload image</button>
	
	
	
	</form>
	<?php echo $propic_Err;?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

		
	 <div class="row">
		<div class="tabs-container">
			<ul class="nav nav-tabs nav-stacked" align="left">
			<li class="active"><a data-toggle="tab" href="#edit"><span class="glyphicon glyphicon-pencil"></span>Edit profie</a></li>
			
			<li><a data-toggle="tab" href="#changepassword"><span class="glyphicon glyphicon-lock"></span>changepassword</a></li>
			</ul>
		</div>
	 
	 </div>
    </div>
    <div class="col-sm-8 text-left"> 
	<div class="row">
		<div class="tab-content">
			<div id="edit" class="tab-pane fade in active">
			
			
			<h3>PERSONAL INFORMATION</h3>
			
			<form role="form" action="account_settings1.php" method="POST">
			<div class="col-sm-10">
			<div class="form-group">
			<label for="name">NAME:</label>
			<input class="form-control" id="name" name="name" placeholder="Your Full Name*" type="text" onfocus="emptyElement('status','unError')" required>
			
			</div>
			<p id="unError"><?php echo $unErr;?></p>
			</div>
			<div class="col-sm-2">
			</div>
			<!--div class="col-sm-10">
			<div class="form-group">
			<label for="number">Mobile Number:</label>
			<input class="form-control" id="number" name="number" placeholder="Your Mobile Number*" type="tel" onfocus="emptyElement('status','tpError')"  required>
			
			</div>
			<p id="tpError"><?php echo $tpErr;?></p>
			</div>
			<div class="col-sm-2">
			</div-->
			<br/>
		
		<div class="col-sm-10">
			<div class="well"> 
      <div class="form-group">
      <label>Date of Birth</label>
      <input type="date" class="form-control" id="dob" name="dob" placeholder="Date of Birth*" onfocus="emptyElement('status','dobError')" required>
	  
    </div>
	<p id="dobError"><?php echo $dobErr;?></p>
</div>
</div>

<div class="col-sm-2">
			</div>
	<div class="col-sm-10">
	<p id="status"><?php echo $status?></p>
	 <input class="pull-right" type="submit" name="submit">
	 </div>
	 <div class="col-sm-2">
			</div>
			</form>

			
		</div>
	
		<div id="changepassword" class="tab-pane fade">
			<div class="personalinfo" align="left">
	<br>
	
	<p>CHANGE PASSWORD</p>
	<form role="form" action="" method="POST" class="form-horizontal" >
	<div class="form-group ">
	<label  for="pwd1" class="control-label col-sm-2">Old Password:</label>
	<div class="col-sm-10">
	<input type="password" name="oldpassword" class="form-control" id="pwd1" placeholder="Enter old password">
	<span class="error"> <?php echo $pswd1Err;?></span>
	</div>
			</div>
	<div class="form-group">
	<label  for="pwd2" class="control-label col-sm-2">New Password:</label>
	<div class="col-sm-10">
	<input type="password" name="newpassword" class="form-control" id="pwd2" placeholder="Enter new password">
	<span class="error"> <?php echo $pswd2Err;?></span>
	</div>
			</div>
	<div class="form-group">
	<label  for="pwd3" class="control-label col-sm-2">Re-enter New Password:</label>
	<div class="col-sm-10">
	<input type="password" name="newpassword2" class="form-control" id="pwd3" placeholder="Re-Enter new password">
	<span class="error"> <?php echo $pswd2Err;?></span>
	</div>
			</div>
	<input type="submit" name="senddata" value="update password">
	
			</form>
	
	
	</div>
		</div>
		
      
    </div>
	</div>
	</div>
	
    <div class="col-sm-2 sidenav">
     
     
    </div>
  </div>
</div>
<?php include_once("./inc/footer.inc.php"); ?>
</body>

</html>