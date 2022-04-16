<?php
 
 session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}

include("db.php");
include("nav.php");




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
</head>
<body>
    <div class="container">
        <h2 class="mt-4">My Answers </h2>
    <?php 
     $email = $_SESSION['student'];
     $query = mysqli_query($conn,"select answer,date,time,questionId from answer where emailID='$email'");
     $rows = mysqli_fetch_all($query);
     
     //print_r($rows); 
     
     for($i=0;$i<sizeof($rows);$i++){ $qid = $rows[$i][3];  $query2 = mysqli_query($conn,"select question from question where questionID='$qid'");
      $row = mysqli_fetch_row($query2);?>
         <div class="card" style="width: 100%;">
             <div class="card-body">
                <h6 class="card-title"><?php echo $rows[$i][0];?></h6>
                <p class="card-text">Answered on <?php echo $rows[$i][1];?> &nbsp &nbsp At <?php echo $rows[$i][2];?> hrs &nbsp &nbsp For question(<?php echo "<b>".$row[0]."</b>";?>)</p>
                 <button class="btn btn-md btn-primary"> Edit Answer</button>
                 <button class="btn btn-md btn-danger"> Delete Answer</button>
                 
             
            </div>
        </div>
    <?php }?>
    </div>
</body>
</html>
