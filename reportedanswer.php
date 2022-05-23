<?php
session_start();
if(!isset($_SESSION['admin']))
{
   header("Location:adminlogin.php");
}
  include("db.php");
  include("adminnav.php");
  //echo "Welcome".$_SESSION['student'];
  

  if(isset($_GET['remove']) && $_GET['reportid'])
  {
      if($_GET['remove'] == 'yes')
      {
          echo "Yes i want to remove";
          $reportid =  $_GET['reportid'];                     
          $query= mysqli_query($conn,"select questionID,emailID from reportedanswer where reportid='$reportid'");
          $row = mysqli_fetch_row($query);
          $qid = $row[0];
          $emailid = $row[1];

          $query1 = mysqli_query($conn,"update answer set reported=0 where questionId='$qid' and emailID='$emailid'");
          $query2 = mysqli_query($conn,"delete from reportedanswer where reportid='$reportid' and aid=1");
          if($query1 && $query2)
          {
             header("Location:reportedanswer.php?removed=true");
          }
          else{
             header("Location:reportedanswer.php?removed=false"); 
          }
      }
  }

  
  if(isset($_GET['delete'])  && $_GET['reportid'] )
  {
      if($_GET['delete'] == 'yes')
      {
          echo "Yes i want to delete";
          $reportid =  $_GET['reportid'];                     
          $query= mysqli_query($conn,"select questionID,emailID from reportedanswer where reportid='$reportid'");
          $row = mysqli_fetch_row($query);
          $qid = $row[0];
          $emailid = $row[1];
          $query1 = mysqli_query($conn,"delete from answer where questionId='$qid' and emailID='$emailid'");
          if($query1)
          {
             header("Location:reportedanswer.php?deleted=true");
          }
          else{
            header("Location:reportedanswer.php?deleted=false"); 
          }
      }
  }

  if(isset($_GET['removed']))
  {
    if($_GET['removed'] == "true")
    {
      echo '<div class="alert alert-success" id="alert" role="alert">
      Answer removed from report queue successfully
           </div>';
    }
    else
    {
      echo '<div class="alert alert-success" id="alert" role="alert">
      Something went wrong please try again
           </div>';
    }
  }

 if(isset($_GET['deleted']))
 {
   if($_GET['deleted'] == "true")
   {
    echo '<div class="alert alert-success" id="alert" role="alert">
    Answer deleted from database  successfully
         </div>';
   }
   else
   {
     echo '<div class="alert alert-success" id="alert" role="alert">
     Something went wrong please try again
          </div>';
   }
 }


  $query = mysqli_query($conn,"select * from reportedanswer");
  if(mysqli_fetch_row($query) !=0)
  {
    $msg="";
    echo "
    <div class='container mt-4 mb-4'>
    <div class='alert alert-warning' role='alert'>
        <h4 class='alert-heading'>Hello Admin!</h4>
        <p> Reported Answer found in database following are the reported question with their reason.</p>
        <hr>
      
     </div>
   </div>        ";
  }
  else{
    $msg="";
    echo "
      <div class='container mt-4 mb-4'>
      <div class='alert alert-success' role='alert'>
          <h4 class='alert-heading'>Hello Admin !</h4>
          <p>No Reported Answer found in database</p>
        
       </div>
     </div>        ";
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
      
  
 
</head>
<body>
<div id="container" class="container mb-4">
        <h2 class="mt-4"><?php echo $msg;?></h2>
    <?php 
     
     $query = mysqli_query($conn,"select * from reportedanswer ");
     $query2 = mysqli_query($conn,"select * from answer where reported=1");
     $rows = mysqli_fetch_all($query);
     $row3 = mysqli_fetch_all($query2);
     
     //print_r($rows); 
     if(sizeof($rows) !=0)
     {
     for($i=0;$i<sizeof($row3);$i++){?>
         <div id="card" class="card" style="width: 100%;" >
             <div class="card-body">
                <p class="card-text">Reported by <?php $allemails =  $rows[$i][4];
                                                     $namequery = mysqli_query($conn,"select name,course from student where emailID='$allemails'");
                                                     $row = mysqli_fetch_row($namequery);
                                                     
                                                     echo($row[0]);echo "<br>From ";
                                                     echo($row[1]);
                                                     ?>
                </p>
                <h5 class="card-title" id="question"><?php $qid1 =  $rows[$i][3]; $answer = mysqli_fetch_row(mysqli_query($conn,"select answer from answer where questionId='$qid1' and emailID='$allemails'"));echo $answer[0];?></h5>
                <p class="card-text"> <strong>Reason :</strong> <?php echo $rows[$i][1];?></p>
                <button onclick="window.location.href='reportedanswer.php?remove=yes&reportid=<?php echo $rows[$i][0];?>'" class="btn btn-md btn-danger">Remove from report queue</button>
                <button onclick="window.location.href='reportedanswer.php?delete=yes&reportid=<?php echo $rows[$i][0];?>'" class="btn btn-md btn-danger">Delete</button>
                
        </div>
        </div>
    <?php }
       }?>
    </div>
    <!-- </div> -->
</body>
