<?php


session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}
  include("db.php");
  include("nav.php");
  //echo "Welcome".$_SESSION['student'];
  $query = mysqli_query($conn,"select * from question");
  if(mysqli_fetch_row($query) !=0)
  {
    $msg="All Asked Questions";
  }
  else{
    $msg="No question asked till now BE The First to Ask";
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/home.css">
 
</head>
<body>
<div class="container mb-4">
        <h2 class="mt-4"><?php echo $msg;?></h2>
    <?php 
     
     $query = mysqli_query($conn,"select question,date,time,emailID from question");
     $rows = mysqli_fetch_all($query);
     
     //print_r($rows); 
     
     for($i=0;$i<sizeof($rows);$i++){?>
         <div class="card" style="width: 100%;" >
             <div class="card-body">
                <p class="card-text">Posted by <?php $allemails =  $rows[$i][3];
                                                     $namequery = mysqli_query($conn,"select name,course from student where emailID='$allemails'");
                                                     $row = mysqli_fetch_row($namequery);
                                                     
                                                     echo($row[0]);echo "<br>From ";
                                                     echo($row[1]);
                                                     ?>
                </p>
                <h5 class="card-title" id="question"><?php echo $rows[$i][0];?></h5>
                <p class="card-text">Click to view all answers of this question or if you want to answer it.</p>
                 <!--
				 
				
			 -->
        </div>
        </div>
    <?php }?>
    </div>
    <!-- </div> -->
</body>
<script src="js/homefunction.js"></script>
</html>
<!--  bell-->
<!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-square-fill" viewBox="0 0 16 16">
  <path d="M2 16a2 2 0 0 1-2-2V2a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H2zm6.5-4.5V5.707l2.146 2.147a.5.5 0 0 0 .708-.708l-3-3a.5.5 0 0 0-.708 0l-3 3a.5.5 0 1 0 .708.708L7.5 5.707V11.5a.5.5 0 0 0 1 0z"/>
</svg> arrow -->
<!-- <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-octagon-fill" viewBox="0 0 16 16">
  <path d="M11.46.146A.5.5 0 0 0 11.107 0H4.893a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146zM8 4c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995A.905.905 0 0 1 8 4zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
</svg> report -->
<!-- 
<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-fill" viewBox="0 0 16 16">
                    <path d="M8 16a2 2 0 0 0 2-2H6a2 2 0 0 0 2 2zm.995-14.901a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 6c0 1.098-.5 6-2 7h14c-1.5-1-2-5.902-2-7 0-2.42-1.72-4.44-4.005-4.901z"/>
                </svg> -->