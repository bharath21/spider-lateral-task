<?php
		include("./inc/check_login_status.php");
		$prev=$_SERVER["HTTP_REFERER"];
		$logid=$_SESSION["user_id"];
		//receive $_GET data

		$movieid=$_GET['m_id'];
		$edit=$_GET['edit'];
		$rating=$_GET['stars'];

		//if edit=0 then user is rating particular movie for first time..else he's trying to update his ratings

	    if($_GET['stars']!=NULL && $_GET['m_id']!=NULL && $_GET['edit']!=NULL){

	    //query to find whether the user has rated a particular movie
		$count_row=mysqli_query($con,"select rating from ratings where id= '".$logid."' and m_id='".$movieid."' ");
		
		if($edit==0 && mysqli_num_rows($count_row))

		{
		   		
		    	echo "this movie is already rated by you .you can update in my your profile";
		    	
		}

		else if($edit==0){
			
			   
			//query to insert data in ratings table

			$sql = "INSERT INTO ratings(r_id,m_id,id,rating) VALUES ('','$movieid','$logid','$rating')";
			if (!$con->query($sql)) 
			{
				echo "Error inserting values ".$con->error;
				die();
			}
			else
			{	//query to update the average rating of a movie in movies table  when it is rated by the user
				$avg_con=mysqli_query($con,"SELECT AVG(rating) AS avg_rate FROM ratings WHERE m_id='".$movieid."'");
				$fetch_avg=mysqli_fetch_array($avg_con);
				$avg_rate=$fetch_avg['avg_rate'];
				$avg_rate= substr($avg_rate, 0, 4);
				$queryforrate=mysqli_query($con,"UPDATE movies SET avg_rating='".$avg_rate."' WHERE m_id='".$movieid."' ");
				if($queryforrate)
				{
					echo "Average updated";
					
				}
				
			}
		}
		//updating rating of user and average rating of  already rated movie
		else{

			
			$sql="UPDATE ratings SET rating='$rating' WHERE id= '".$logid."' and m_id='".$movieid."' ";
			$update_rating=mysqli_query($con,$sql);
			$avg_con=mysqli_query($con,"SELECT AVG(rating) AS avg_rate FROM ratings WHERE m_id='".$movieid."'");
				$fetch_avg=mysqli_fetch_array($avg_con);
				$avg_rate=$fetch_avg['avg_rate'];
				$avg_rate= substr($avg_rate, 0, 4);
				$queryforrate=mysqli_query($con,"UPDATE movies SET avg_rating='".$avg_rate."' WHERE m_id='".$movieid."' ");
				if($queryforrate)
				{
					echo "Average updated";
					//header("location:home.php");
				}




		}

	
		}
?>