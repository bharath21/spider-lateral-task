<?php


include("./inc/check_login_status.php");

    //adding movies to db
$reg=@$_POST['submit'];
$moviename="";$description="";$status="";
$movienameError="";$descriptionError="";
function test_input($data) {
   $data = trim($data);//removes unwanted white spaces
   
   return $data;
}

$moviesinsert = $con->prepare("INSERT INTO movies(m_id,title,description,casting,year_of_release,avg_rating,poster) VALUES ('',?,?,' ',' ', 0, ' ')");
$moviesinsert->bind_param("ss",$moviename,$description);


if($_SERVER["REQUEST_METHOD"]=="POST"){

if($reg){
	//echo"hey ";

   

  if(empty($_POST["movie_name"])){
    $movienameError="please fill  name";
    echo "movie errotr";
  }
  else{
    $moviename=test_input($_POST["movie_name"]);
   
    
  }
  
  
  if(empty($_POST["description"])){
    $descriptionError="please enter description";
    
  }
  else{
    $description=test_input($_POST["description"]);
    
  }
 	
 

  
  if($movienameError=="" &&  $descriptionError=="" ){

     
     $moviename= mysqli_real_escape_string($con,$moviename);
    $description= mysqli_real_escape_string($con,$description);
    //$query=mysqli_query($con,"INSERT INTO movies(m_id,title,description,casting,year_of_release,avg_rating,poster) VALUES ('','$moviename','$description',' ',' ',0,' ')") or die("unable to update");
    $moviesinsert->execute();

   	echo "<script>alert(\"added successfully\")</script>";
    $moviesinsert->close();
  
  
  
}
else{
	echo "there is an error";
  }


}
else{
	echo "there is an reg  error";
  }
	  }
	  echo $log_username;

header("location:$log_username");



?>