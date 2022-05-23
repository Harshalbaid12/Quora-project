<?php
session_start();
if(!isset($_SESSION['admin']))
{
   header("Location:adminlogin.php");
}
  include("db.php");
  include("adminnav.php");
  //echo "Welcome".$_SESSION['student'];

  

  if(isset($_GET['remove']) && $_GET['question'])
  {
      if($_GET['remove'] == 'yes')
      {
          echo "Yes i want to remove";
          $reportid =  $_GET['question'];                     
          $query= mysqli_query($conn,"select questionID from reportquestion where reportid='$reportid'");
          $row = mysqli_fetch_row($query);
          $qid = $row[0];

          $query1 = mysqli_query($conn,"update question set reported=0 where questionID='$qid'");
          $query2 = mysqli_query($conn,"delete from reportquestion where reportid='$reportid' and aid=1");
          if($query1 && $query2)
          {
             header("Location:reportedquestion.php?removed=true");
          }
          else{
             header("Location:reportedquestion.php?removed=false"); 
          }
      }
  }

  if(isset($_GET['delete'])  && $_GET['question'] )
  {
      if($_GET['delete'] == 'yes')
      {
          echo "Yes i want to delete";
          $reportid =  $_GET['question'];                     
          $query= mysqli_query($conn,"select questionID from reportquestion where reportid='$reportid'");
          $row = mysqli_fetch_row($query);
          $qid = $row[0];
          $query1 = mysqli_query($conn,"delete from question where questionID='$qid'");
          if($query1)
          {
             header("Location:reportedquestion.php?deleted=true");
          }
          else{
            header("Location:reportedquestion.php?deleted=false"); 
          }
      }
  }



  if(isset($_GET['removed']))
  {
    if($_GET['removed'] == "true")
    {
      echo '<div class="alert alert-success" id="alert" role="alert">
      Question removed from report queue successfully
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
    Question deleted from database  successfully
         </div>';
   }
 else
   {
    echo '<div class="alert alert-success" id="alert" role="alert">
    Something went wrong please try again
         </div>';
   }
 }


  $query = mysqli_query($conn,"select * from reportquestion");
  if(mysqli_fetch_row($query) !=0)
  {
    $msg="";
    echo "
    <div class='container mt-4 mb-4'>
    <div class='alert alert-warning' role='alert'>
        <h4 class='alert-heading'>Hello Admin!</h4>
        <p> Reported Question found in database following are the reported question with their reason.</p>
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
          <p>No Reported question found in database</p>
        
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
     
     $query = mysqli_query($conn,"select * from reportquestion ");
     $rows = mysqli_fetch_all($query);
     $true="true";
     //print_r($rows); 
     
     for($i=0;$i<sizeof($rows);$i++){?>
         <div id="card" class="card" style="width: 100%;" >
             <div class="card-body">
                <p class="card-text">Reported by <?php $allemails =  $rows[$i][3];
                                                     $namequery = mysqli_query($conn,"select name,course from student where emailID='$allemails'");
                                                     $row = mysqli_fetch_row($namequery);
                                                     
                                                     echo($row[0]);echo "<br>From ";
                                                     echo($row[1]);
                                                     ?>
                </p>
                <h5 class="card-title" id="question"><?php $qid =  $rows[$i][1]; $question = mysqli_fetch_row(mysqli_query($conn,"select question from question where questionID='$qid'"));echo $question[0];?></h5>
                <p class="card-text"> <strong>Reason :</strong> <?php echo $rows[$i][4]; ?></p>
                <button onclick="window.location.href='reportedquestion.php?remove=yes&question=<?php echo $rows[$i][0];?>'" class="btn btn-md btn-danger">Remove from report queue</button>
                <button onclick="window.location.href='reportedquestion.php?delete=yes&question=<?php echo $rows[$i][0];?>'" class="btn btn-md btn-danger">Delete</button>
                
        </div>
        </div>
    <?php }?>
    </div>
    <!-- </div> -->
</body>
<script>
  
  var alert=document.getElementById("alert");
    setTimeout(() => {
        alert.style.display="none";
    }, 8000);


</script>