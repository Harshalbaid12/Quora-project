<?php
 include("db.php");
 session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}

  include("nav.php");
  //echo "Welcome".$_SESSION['student'];


  //student emailid 
  $emailID = $_SESSION['student'];


//check if delete answerparameter is set  for deletion of answer
 if(isset($_GET['deleteanswer']) && isset($_GET['delete']))
 {
   if($_GET['delete'] == "true")
   {
     $deleteanswer = $_GET['deleteanswer'];
     $prevq = mysqli_query($conn,"select questionId from answer where answer = '$deleteanswer'");
     $row = mysqli_fetch_row($prevq);
     $qid = $row[0];
     
     $query = mysqli_query($conn,"delete from answer where questionId='$qid' and emailID='$emailID'");
     
     if($query)
     {
      header("Location:myanswers.php?deleted=true");
     
     }
     else
     {
      header("Location:myanswers.php?deleted=false");
     }
   }
 }



  $question="";
  if(isset($_GET['question']))
  {
    $question = $_GET['question'];
  }
  
if(isset($_GET['redirectedfromanswer']))
{
  if($_GET['redirectedfromanswer'] == "true")
  {
    echo '<div class="alert alert-danger" id="alert" role="alert">
   You have answered this question previously So you can edit your answer but can\'t answer one question more than once<br> Therefore you are redirected to here if you want to edit  !
  </div>';
  }
}







//getting id for the question that has been sent through link for which the answer has to edited
//1.get id for question

 $query = mysqli_query($conn,"select questionID from question where question='$question'");
 $rowforquestionid = mysqli_fetch_row($query);
 $qid = $rowforquestionid[0];

 //2.quering for answer having qid and emailid as given as answer is unique for (qid,emailID)

 $query2 = mysqli_query($conn,"select * from answer where questionId='$qid' and emailID='$emailID'");
 $rowforanswer = mysqli_fetch_row($query2);
 $answer = $rowforanswer[0];



 //posted edited answer operation here 
 $url = "editanswer.php?question=".$question;
 if(isset($_POST['submit']))
 {
   $editedanswer = $_POST['answer'];
   $updateanswer = mysqli_query($conn,"update answer set answer='$editedanswer' where questionId='$qid' and emailID='$emailID'");
   if($updateanswer)
   {
      header("Location:myanswers.php?edited=true");
   }
   else
   {
      header("Location:myanswers.php?edited=false");
   }
 }
 
 

?>

<!-- HTML code starts here -->

<div class="container mt-4 mb-4">
   <form action="<?php echo $url;?>" method="post">
     <h5>Question</h5>
   <div class="input-group mb-3">
        <input type="text" class="form-control"  value="<?php echo $question?>"  readonly >
   </div>
   <h5>Your Answer start editing below</h5>
   <textarea class="form-control mt-3 mb-3" rows="7"  name="answer"  onfocus="this.innerHTML" ><?php echo $answer?></textarea>
   <button  type="submit" name="submit" value='Submit' class="btn btn-md btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Make permanent changes to question" >Edit</button>
   <button type ="reset" class="btn btn-md btn-primary"  data-bs-toggle="tooltip" data-bs-placement="right" title="Revert all changes done to the question">Revert</button>

   </form>
</div>





<script src="js/tooltip.js"></script>



<script>

document.getElementById("inputsearch").style.display="none";




    var alert=document.getElementById("alert");
    setTimeout(() => {
        alert.style.display="none";
    }, 10000);
</script>
