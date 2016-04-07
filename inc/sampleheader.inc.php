<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>spider_task_4thApr</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- bootstrap css -->
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <!-- jquery mobile -->
  <script src="http://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>
  <!-- jquery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- bootstrap js -->
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <!-- font awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="maxcdn.bootstrapcdn/Font-Awesome-master/Font-Awesome-master/css/font-awesome.min.css">
  <!-- ratings -->
  <link href="bootstrapratings/css/star-rating.min.css" media="all" rel="stylesheet" type="text/css" />
  <script src="bootstrapratings/js/star-rating.min.js" type="text/javascript"></script> 
  

  <?php

include("./inc/check_login_status.php");

// Initialize any variables that the page might echo
//can manipulate with user information

$u = "";
$user_id=$_SESSION["user_id"];

// check if user_ok is true

if($user_ok == true){
      $user=$_SESSION["user_name"];
      $check_pic_user = mysqli_query($con,"SELECT profile_pic FROM users1 WHERE username='$user'");
      $get_pic_row_user=mysqli_fetch_assoc($check_pic_user);
      $profile_pic_db_user = $get_pic_row_user['profile_pic'];
      if($profile_pic_db_user == ""){
          $profile_pic_user = "img/default_pic.jpg";
   }
      else{
          $profile_pic_user = "userdata/profile_pics/".$profile_pic_db_user;
   }
  
}

//
else{
  echo "click below to login";
  echo "<a href='index.php'>here</a>";
  exit();
}

// Check to see if the viewer is the account owner which isn known by $isowner

?>

  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    
    .row.content {height: 450px}
    
    
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
   
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }


  </style>

  <script>
  function emptyElement(x,y){
  document.getElementById(x).innerHTML = "";
  document.getElementById(y).innerHTML = "";
}
</script>


</head>
<body id="mypage">

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
                               
      </button>
      <a  class="navbar-brand" href="http://localhost/spider_task_4thApr/home.php">MOVIEBUFF</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      
      <ul class="nav navbar-nav navbar-right">
        <li ><a href="/spider_task_4thApr/<?php echo $user; ?>"><img class="" style="height: 32px; width: 32px; border-radius: 100%; display: inline;"  src="<?php echo $profile_pic_user;?>" alt="<?php echo $user;?>"></a></li>
    <!--<li><a href="account_settings.php">settings</a></li>-->
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">MY ACCOUNT
      <span class="caret"></span></a>
      
      <ul class="dropdown-menu">
        
        <li ><a href="account_settings1.php"><span class="glyphicon glyphicon-asterisk"></span>SETTINGS</a></li>
        <li ><a data-toggle="tab" href="#ratedmovies"><span class="glyphicon glyphicon-pencil"></span>my ratings</a></li>
        
        
        <li ><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>logout</a></li>
        
      </ul>
      
    </li>
        
      </ul>
    </div>
  </div>
</nav>
  
