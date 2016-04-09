<?php

include("./inc/sampleheader.inc.php");
$u = "";

// _GET username is set, and sanitize it

//check if _GET username exists ...and if not redirect to index page

//$username = $GET['u'] whereas $user = account owner


if(isset($_GET["u"])){
	$username = mysqli_real_escape_string($con,$_GET['u']);
	$query="SELECT * FROM users1 WHERE username='$username'";
		$result=mysqli_query($con,$query);
		if(mysqli_num_rows($result)==1){
			$user_row = mysqli_fetch_assoc($result);
			$username=$user_row['username'];
			$profile_id = $user_row["id"];
			$profile_pic_db = $user_row['profile_pic'];
			if($profile_pic_db == ""){
				$profile_pic = "img/default_pic.jpg";
			}
			else{
			$profile_pic = "userdata/profile_pics/".$profile_pic_db;
				}
			}
		else
		{
			echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/spider_task_4thApr/index.php\">";
		
         	exit();		
		}
	
}
 else {
    		echo "<meta http-equiv=\"refresh\" content=\"0; url=http://localhost/spider_task_4thApr/index.php\">";
		
         	exit();
}

// Check to see if the viewer is the account owner which isn known by $isowner
	$isOwner = "no";
	if($username == $log_username && $user_ok == true){
		$isOwner = "yes";
}

//adding movies to database

$reg=@$_POST['submit'];
$moviename="";$description="";$status="";
$movienameError="";$descriptionError="";
function test_input($data) {
   $data = trim($data);//removes unwanted white spaces
   
   return $data;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

if($reg){
	echo"hey ";

   

  if(empty($_POST["movie_name"])){
    $movienameError="please fill  name";
    echo "movie errotr";
  }
  else{
    $moviename=test_input($_POST["movie_name"]);
   
    
  }
  
  
  if(empty($_POST["description"])){
    $descriptionError="please enter description";
    echo "description error";
  }
  else{
    $description=test_input($_POST["description"]);
    
  }
 
 

  
  if($movienameError=="" &&  $descriptionError=="" ){

     
    //$moviename=mysqli_real_escape_string($con,$moviename);
    //$description=mysqli_real_escape_string($con,$description);
    $query=mysqli_query($con,"INSERT INTO movies(m_id,title,description,casting,year_of_release,avg_rating,poster) VALUES ('','$moviename','$description',' ',' ',0,' ')") or die("unable to update");
    $status="movie details are received successfully";
    
  
  
  
}
else{
	echo "there is an error";
  }


}
else{
	echo "there is an reg  error";
  }
	  }



?>






<?php
		//upload profile pic
		$uploadpic =@$_POST['uploadpic'];
		$propic_Err="";
		$check_pic = mysqli_query($con,"SELECT profile_pic FROM users1 WHERE username='$username'");
		$get_pic_row=mysqli_fetch_assoc($check_pic);
		$profile_pic_db = $get_pic_row['profile_pic'];
   		if($profile_pic_db == ""){
	   		$profile_pic = "img/default_pic.jpg";
  		 }
   		else{
	   		$profile_pic = "userdata/profile_pics/".$profile_pic_db;
   		}
   		//$profile_pic is the profile photo of username got by _GET and $profile_pic_user is the profile photo of logged in user

   
	   
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
			 header("location: $username");
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

		     
		

  
<div class="container-fluid text-center"> 
	
  <div class="row content">
   
	<div class="col-sm-2  pr0 sidenav">
	<div>
		<div  id="profile-pic-container">
		<?php 
		if($user==$username){
		echo
		"
			<img src=$profile_pic_user id='profile-photo' class='img-circle' alt='profilephoto' width='130px' height='130px' data-toggle='modal' data-target='#myModal' style='display:inline;'>
		
		<p><a href='#' id='change-picture'>Change picture</a></p>";}
		
		if($user!=$username){
			echo
			"<img src=$profile_pic id='profile-photo' class='img-circle' alt='profilephoto' width='130px' height='130px' style='display:inline;'>";}
		
			?>
		</div>
		</div>
		<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content for uploading photo -->
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
	
	<button class="btn btn-default" type="submit" name="uploadpic">upload image</button>
	
	
	
	</form>
	<?php echo $propic_Err;?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

		
	<?php
	//account owner page 
	if($user==$username){
	echo'
	<div class="row">
     <div class="tabs-container">
		<ul class="nav nav-tabs nav-stacked" align="left">
			
			
			<li class="active"><a data-toggle="tab" href="#ratedmovies"><span class="glyphicon glyphicon-pencil"></span>Rated Movies</a></li>
			<li><a  href="account_settings1.php"><span class="glyphicon glyphicon-cog"></span>Settings</a></li>

			<li><a  href="home.php"><span class="glyphicon glyphicon-film"></span>Movies List</a></li>

			<li ><a data-toggle="tab" href="#pageMiddle">ANY DEFAULT USER DATA</a></li>

						<li ><a data-toggle="tab" href="#addmovies">Add movies</a></li>

			
		</ul>
	 </div>
	</div>';}
	//other user page
	 else
		 echo'
	<div class="row">
     <div class="tabs-container">
		<ul class="nav nav-tabs nav-stacked" align="left">
			<li class="active"><a data-toggle="tab" href="#otheruser_ratedmovies"><span class="glyphicon glyphicon-pencil"></span>Rated Movies</a></li>	

		</ul>
		
	 </div>
	 <br/>
	 <button class="btn btn-default" type="submit" name="FOLLOW">FOLLOW</button>
	 </div>';
	 
	 ?>
	 </div>
	
    <div class="col-sm-10  text-left" style='display:block;'> 
	
      <?php 
	  if($user==$username)
	  		include('user_row_content.php');
		else
			include('another_user_row_content.php')
  ?>

		
	

    </div>

  </div>
</div>
<?php include_once("./inc/footer.inc.php"); ?>
</body>

</html>