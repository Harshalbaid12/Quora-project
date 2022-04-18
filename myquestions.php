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
    echo '<div class="alert alert-primary" id="alert" role="alert">
   Question was edited succesfully!
  </div>';
}

if(isset($_GET['deleted']))
{
    echo '<div class="alert alert-danger" id="alert" role="alert">
   Question was deleted succesfully!
  </div>';
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
        <h2 class="mt-4">My Asked Questions</h2>
    <?php 
     $email = $_SESSION['student'];
     $query = mysqli_query($conn,"select question,date,time from question where emailID='$email'");
     $rows = mysqli_fetch_all($query);
    //  print_r(sizeof($rows));
     if(sizeof($rows) == 0)
     {
         echo "No Question asked by you<br>";
         echo "<button id='askquestion' class='btn btn-primary btn-md mt-4 mb-4' onclick='askquestion();' >Ask question</button>";

     }
     else{
     for($i=0;$i<sizeof($rows);$i++){?>
         <div class="card" style="width: 100%;">
             <div class="card-body">
                <h5 class="card-title"><?php echo $rows[$i][0];?></h5>
                <p class="card-text">Asked on <?php echo $rows[$i][1];?> &nbsp &nbsp At <?php echo $rows[$i][2];?> hrs</p>
                 <button onclick = "window.location.href='editquestion.php?question=<?php echo $rows[$i][0];?>'" class="btn btn-md btn-primary"> Edit Question</button>
                 <button onclick = "window.location.href='viewanswer.php?question=<?php echo $rows[$i][0];?>'" class="btn btn-md btn-primary"> View Answers </button>
                 <button id="delete" class="btn btn-md btn-danger" value="<?php echo $rows[$i][0];?>" data-bs-toggle="modal" data-bs-target="#staticBackdrop" > Delete Question</button>
                 
            </div>
        </div>
    <?php }
        }    ?>
    </div>
                   
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do You Really want to delete Please Confirm
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

       var question = deletebutton.value;
       window.location.href= "editquestion.php?deletequestion="+question+"&delete=true";
     }

     function askquestion()
     {
         window.location.href="askquestion.php";
     }
     document.getElementById("inputsearch").style.display="none";
</script>