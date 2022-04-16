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
        <h2 class="mt-4">My Asked Questions</h2>
    <?php 
     $email = $_SESSION['student'];
     $query = mysqli_query($conn,"select question,date,time from question where emailID='$email'");
     $rows = mysqli_fetch_all($query);
     //print_r($rows); 
     
     for($i=0;$i<sizeof($rows);$i++){?>
         <div class="card" style="width: 100%;">
             <div class="card-body">
                <h5 class="card-title"><?php echo $rows[$i][0];?></h5>
                <p class="card-text">Asked on <?php echo $rows[$i][1];?> &nbsp &nbsp At <?php echo $rows[$i][2];?> hrs</p>
                 <button class="btn btn-md btn-primary"> Edit Question</button>
                 <button class="btn btn-md btn-primary"> View Answers </button>
                 <button class="btn btn-md btn-danger"> Delete Question</button>
             
            </div>
        </div>
    <?php }?>
    </div>
</body>
</html>
