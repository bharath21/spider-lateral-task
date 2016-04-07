
<?php include ("./inc/sampleheader.inc.php");
?>


<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-4 sidenav text-left">
    <?php 
    //query to find number of movies rated by particular user
      $num_movies=mysqli_query($con,"SELECT COUNT(id) AS num_movies FROM ratings WHERE id='".$user_id."'");
      $fetch_num_movies=mysqli_fetch_array($num_movies);
      $num_movies=$fetch_num_movies['num_movies'];
    ?>
    
    <h2 align="left"><a href="<?php echo $user; ?>" style="text-decoration: none">Rated By Me (<?php echo $num_movies;?>) </a></h2>
    

        
    </div>
    <div class="col-sm-8 text-left"> 
      <h1>List Of Movies</h1>
      <?php
    //query to list all movies
    $sql="SELECT * FROM movies  LIMIT 20";
    $getmovies=mysqli_query($con,$sql) or die(mysqli_error) ;

    while($row=mysqli_fetch_assoc($getmovies)) {

    $m_id = $row['m_id'];
    $title = $row['title'];
    $description = $row['description'];
    $casting = $row['casting'];
    $year_of_release = $row['year_of_release'];
    $avg_rating=$row['avg_rating'];
    $poster=$row['poster'];
      //check whether movie has a display photo ...if not display default photo

     $checkposter_pic = mysqli_query($con,"SELECT poster FROM movies WHERE m_id='$m_id'");
     $get_pic_row= mysqli_fetch_assoc($checkposter_pic);
     $poster_pic = $get_pic_row['poster'];
      if($poster_pic == ""){
        $poster_pic_db = "moviedata/posters/defaultposter.png";
   }
      else{
        $poster_pic_db = "moviedata/posters/".$poster_pic;
   }

      $num_users=mysqli_query($con,"SELECT COUNT(m_id) AS num_users FROM ratings WHERE m_id='".$m_id."'");
      $fetch_num_users=mysqli_fetch_array($num_users);
      $num_users=$fetch_num_users['num_users'];
    
    
   //poster_pic_db is movie poster
   echo
    "             <div class=\"moviename\" id=\"moviename".$m_id."\">

                  <div class=\"row\">

                  <div class=\"col-md-2 col-sm-3 col-xs-3\">
                    <img src=\"".$poster_pic_db."\" class=\"img-circle img-responsive\" height=\"50\" width=\"50\">
                  </div>

                  <div class=\"col-md-3 col-sm-4 col-xs-4\" >
                      <div id=\"title".$m_id."\"><b>".$title."</b></div>
                      <div id=\"yor".$m_id."\" class=\"text-muted\">year of release:".$year_of_release."</div>
                      <div id=\"description".$m_id."\" class=\"text-muted\">description:".$description."</div>
                      <div id=\"casting".$m_id."\" class=\"text-muted\">casting:".$casting."</div>
                      <div id=\"count".$m_id."\" class=\"text-muted\">number of ratings:".$num_users."</div>
                  </div>

                  <div class=\"col-md-2 col-sm-3 col-xs-3\" style=\"padding:15\">
                  ";
                  if($avg_rating!=0)
                  echo"

                  <div id=\"avg_rating".$m_id."\" ><b>Average Rating:".$avg_rating."</b></div>

                  </div>";
                  else
                    echo "<div id=\"avg_rating".$m_id."\" ><b>Average Rating:\"UNRATED\"</b></div>

                  </div>";

                  echo"

                  <div class=\"col-md-2 col-sm-2 col-xs-2\" >


                  <form role=\"form\" onsubmit=\"return (validate".$m_id."());\">

                  <span class=\"rate\">
                    <input id=\"stars".$m_id."\" name=\"stars\" class=\"rating\" data-symbol=\"&#9733\" data-min=\"0\" data-max=\"5\" data-step=\"0.5\" data-size=\"sm\" data-show-clear=\"false\" required=\"true\">
                    <input type=\"hidden\" name=\"m_id\" id=\"movieid".$m_id."\" value=\"$m_id\"  />
                  </span>

                <span class=\"rate\" style=\"display:inline-block;\">
                  <div id=\"rateerror".$m_id."\" style=\"color:red\"></div>
                </span>

                  </div><!--first row ends-->

                  <div class=\"row\">

                  <div class=\"col-md-2 col-sm-3 col-xs-3\">

                  <button type=\"submit\" class=\"btn btn-primary pull-right\" >
                  Submit
                  </button>

                  </div>
                  </form>


                  <div class=\"col-md-7 col-sm-9 col-xs-9\"></div>
                  </div>



                  </div>
                  </div>

                  <br>
                  <br>

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
              edit=0;//user rating for the first time
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
                //alert(".$m_id.")
                //ajax call through GET request to ratings.php
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
                    
                  });
              }
            }
            </script>


    
    
    
    ";
   


}

?>




      
      
    </div>

  </div>
</div>

<?php include_once("./inc/footer.inc.php"); ?>

</body>
</html>
