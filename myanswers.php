<?php
 
 session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}

include("db.php");
include("nav.php");

if(isset($_GET['edited']))
{
    if($_GET['edited'] == true)
    {
        echo '<div class="alert alert-primary" id="alert" role="alert">
        Answer was edited succesfully!
       </div>';
    }
    else{
        echo '<div class="alert alert-danger" id="alert" role="alert">
        Something went wrong please try again!
       </div>';
    }
}




if(isset($_GET['deleted']))
{
    if($_GET['deleted'] == true)
    {
        echo '<div class="alert alert-primary" id="alert" role="alert">
        Answer was deleted succesfully!
       </div>';
    }
    else{
        echo '<div class="alert alert-danger" id="alert" role="alert">
        Something went wrong please try again!
       </div>';
    }
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
    <div class="container mb-4">
        <h2 class="mt-4">My Answers </h2>
    <?php 
     $email = $_SESSION['student'];
     $query = mysqli_query($conn,"select answer,date,time,questionId from answer where emailID='$email'");
     $rows = mysqli_fetch_all($query);
     if(sizeof($rows) == 0)
     {
         echo "No Question answered by you<br>";
         echo "<button id='answerquestion' class='btn btn-primary btn-md mt-4 mb-4' onclick='answerquestion();' >Look for some question to answer</button>";

     }
     else{
     //print_r($rows); 
     
     for($i=0;$i<sizeof($rows);$i++){ $qid = $rows[$i][3];  $query2 = mysqli_query($conn,"select question from question where questionID='$qid'");
      $row = mysqli_fetch_row($query2);?>
         <div class="card" style="width: 100%;">
             <div class="card-body">
                <h6 class="card-title"><?php echo $rows[$i][0];?></h6>
                <p class="card-text">Answered on <?php echo $rows[$i][1];?> &nbsp &nbsp At <?php echo $rows[$i][2];?> hrs &nbsp &nbsp For question(<?php echo "<b>".$row[0]."</b>";?>)</p>
                 <button class="btn btn-md btn-primary" onclick = "window.location.href='editanswer.php?question=<?php echo $row[0];?>'"> Edit Answer</button>
                 <button id="delete" class="btn btn-md btn-danger"  value="<?php echo $rows[$i][0];?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop" > Delete Answer</button>
                 
             
            </div>
        </div>
    <?php 
           }
        }?>
    </div>
    
                   
                   <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                       <div class="modal-dialog">
                           <div class="modal-content">
                               <div class="modal-header">
                                   <h5 class="modal-title" id="staticBackdropLabel">Confirm delete</h5>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                               </div>
                               <div class="modal-body">
                                   Do You Really want to delete the answer changes will we permanent.
                               </div>
                               <div class="modal-footer">
                                   <button type="button" class="btn btn-success" data-bs-dismiss="modal" >No Wait</button>
                                   <button type="button" id="yesdelete" data-bs-dismiss="modal" class="btn btn-danger" onclick="delet();">Yes Delete</button>
                               </div>
                           </div>
                       </div>
                   </div>
</body>
</html>

<script>
   var alert=document.getElementById("alert");
    setTimeout(() => {
        alert.style.display="none";
    }, 4000);


    function delet()
    {
      
       var deletebutton = document.getElementById("delete");

       var answer = deletebutton.value;
       window.location.href= "editanswer.php?deleteanswer="+answer+"&delete=true";
     }


    function answerquestion()
    {
        window.location.href = "home.php";
    }


    document.getElementById("inputsearch").style.display="none";
    </script>
