		<!--tab content-->
    <?php include("./inc/connect.inc.php"); ?>

		<div class="tab-content">
		
		
		<div id="ratedmovies" class="tab-pane fade in active">

     	 <h3>Rated Movies</h3>
      <?php 

    $num_movies=mysqli_query($con,"SELECT COUNT(id) AS num_movies FROM ratings WHERE id='".$user_id."'");
     $fetch_num_movies=mysqli_fetch_array($num_movies);
    $num_movies=$fetch_num_movies['num_movies'];
    ?>



    
    <h2 align="left">Rated By Me (<?php echo $num_movies;?>) </h2>

   

    <?php
    	//query to list movies rated by user
       $sql="SELECT * FROM ratings WHERE id='$user_id' LIMIT 20";
       $getusermovies=mysqli_query($con,$sql) or die(mysqli_error) ;
       //query to find whether user is admin to add movies
       $sql="SELECT admin_flag FROM users1 WHERE id='$user_id' ";
       $getadminflag=mysqli_query($con,$sql) or die(mysqli_error) ;

       $row_adminflag=mysqli_fetch_assoc($getadminflag);
       $user_adminflag=$row_adminflag['admin_flag'];



       while($row=mysqli_fetch_assoc($getusermovies)) {
	            $m_id = $row['m_id'];
	            $rating=$row['rating'];
		       $sql="SELECT title FROM movies WHERE m_id='$m_id'"; 
		       $gettitle=mysqli_query($con,$sql) or die(mysqli_error);
		       $row=mysqli_fetch_assoc($gettitle);
		       $title=$row['title'];




   $checkposter_pic = mysqli_query($con,"SELECT poster FROM movies WHERE m_id='$m_id'");
   $get_pic_row= mysqli_fetch_assoc($checkposter_pic);
   $poster_pic = $get_pic_row['poster'];
  if($poster_pic == ""){
     $poster_pic_db = "moviedata/posters/defaultposter.png";
   }
   else{
     $poster_pic_db = "moviedata/posters/".$poster_pic;
   }

       echo
    "      <div class=\"moviename\" id=\"moviename".$m_id."\">

            <div class=\"row\">

           <div class=\"col-md-2 col-sm-2 col-xs-2\">
                    <img src=\"".$poster_pic_db."\" class=\"img-circle img-responsive\" height=\"50\" width=\"50\">
                  </div>
            <div class=\"col-md-3 col-sm-4 col-xs-4\" >
                    <div id=\"title".$m_id."\"><b>".$title."</b></div>
          
                  <div id=\"rating".$m_id."\" class=\"text-muted\">rating given:".$rating."</div>
            </div>

            <div class=\"col-md-2 col-sm-3 col-xs-3\" >


                  <form role=\"form\" onsubmit=\"return (validate".$m_id."());\">

                  

                  <span class=\"rate\">
                  <input id=\"stars".$m_id."\" name=\"stars\" class=\"rating\" data-symbol=\"&#9733\" data-min=\"0\" data-max=\"5\" data-step=\"0.5\" data-size=\"sm\" data-show-clear=\"false\" required=\"true\">
                  <input type=\"hidden\" name=\"m_id\" id=\"movieid".$m_id."\" value=\"$m_id\"  />
                </span>
                <span class=\"rate\" style=\"display:inline-block;\">
                  <div id=\"rateerror".$m_id."\" style=\"color:red\"></div>
                </span>

                  </div>

                  
                  <div class=\"col-md-2 col-sm-3 col-xs-3\">
                <button type=\"submit\" class=\"btn btn-primary pull-right\" >
                Update
                </button>
                </div>
                 </form>


                
               



            </div><!--1st row ends-->
            </div><!--moviename class ends-->

            <br>
            <br>
            <hr>

            <script type=\"text/javascript\">
            var rate=0;
            

            $(\"#stars".$m_id."\").rating({
            starCaptions: {0.5:\"Pathetic\", 1: \"Extremely Poor\", 1.5:\"Very Poor\", 2: \"Poor\", 2.5: \"Average\", 3: \"Above Average\", 3.5:\"Good\", 4: \"Very Good\", 4.5:\"Excellent\", 5: \"Perfect\"},
            starCaptionClasses: {0.5: \"text-danger\", 1: \"text-danger\", 1.5: \"text-warning\", 2: \"text-warning\", 2.5: \"text-info\", 3: \"text-info\", 3.5: \"text-primary\", 4: \"text-primary\", 4.5: \"text-success\", 5: \"text-success\"},
            clearCaption: \"\"
            });

            $(\"#stars".$m_id."\").on('rating.change', function(event, value, caption) {
            rate=value;
            $(\"rateerror".$m_id."\").html(\"\");
            });


            function validate".$m_id."()
            {
              edit=1;
              err=0;
                  
              if(rate==0)
              { 
                $(\"#rateerror".$m_id."\").html(\"Please enter a rating\");
                err=1;

              }
              
              
              if(err==1)
                return false;
              
              else
              {
                stars = $(\"#stars".$m_id."\").val();
                var movieid=$(\"#movieid".$m_id."\").val();
                alert(".$m_id.")

                $.ajax({
                      type: \"GET\",
                      url: 'ratings.php',
                      data:{\"stars\": stars,
                            \"m_id\":".$m_id.",
                            \"edit\":edit
                          },
                  }).done(function(msg)
                  {
                    alert(msg);
                    if(msg==\"rated\")
                    {
                      alert(\"You have already rated this movie!\");
                    }
                  });
              }
            }
            </script>


    
    
    
    ";









       }

?>


          </div>

	<div id="pageMiddle" class="tab-pane fade ">
		<h3><?php echo $username; ?></h3>
		<p>Is the viewer the page owner, logged in and verified? <b><?php echo $isOwner; ?></b></p>
		<p>id: <?php echo $profile_id; ?></p>
  
		</div>

    <div id="addmovies" class="tab-pane fade ">

    <?php
    if($user_adminflag==0){
      echo "<h3>sorry you cant add movies as you are not admin</h3>";


    }
    else{
      echo"
      <h3>Add Movie</h3>
      <form role=\"form\" action=\"addmovies.php\" method=\"POST\">
        <div class=\"col-sm-10\">
      <div class=\"form-group\">
      <label for=\"movie_name\">MOVIE NAME:</label>
      <input class=\"form-control\" id=\"movie_name\" name=\"movie_name\" placeholder=\"Enter Movie Name*\" type=\"text\" onfocus=\"emptyElement('status','movienameError')\" required>
      
      </div>
      <p id=\"movienameError\"><?php echo $movienameError;?></p>
      </div>
      <div class=\"col-sm-2\">
      </div>

        <div class=\"col-sm-10\">
      <div class=\"form-group\">
      <label for=\"description\">Description:</label>
      <input class=\"form-control\" id=\"description\" name=\"description\" placeholder=\"Enter Description of the movie*\" type=\"text\" onfocus=\"emptyElement('status','description')\" required>
      
      </div>
      <p id=\"descriptionError\"><?php echo $descriptionError;?></p>
      </div>
      <div class=\"col-sm-2\">
      </div>

      <div class=\"col-sm-10\">
  <p id=\"status\"><?php echo $status ?></p>
   <input class=\"pull-right\" type=\"submit\" name=\"submit\">
   </div>
   <div class=\"col-sm-2\">
      </div>
      </form>
      ";
      
       
    }
    ?>
  
    </div>

		</div>