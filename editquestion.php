<?php

 session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}

  include("db.php");
  include("nav.php");
  //echo "Welcome".$_SESSION['student'];


  //if redirected from delete button to delete question

  if(isset($_GET['delete']) && isset($_GET['deletequestion']))
  {
      if($_GET['delete'] == true)
      {
        $deletequestion = $_GET['deletequestion'];  
        $query = mysqli_query($conn,"delete from question where question='$deletequestion'");
        if($query)
        {
             header("Location:myquestions.php?deleted=true");
        } 
        else{
            header("Location:myquestions.php?deleted=false");
        }
      }
  }
  




  //getting question through link
  $question="";
   if(isset($_GET['question']))
   {
    $question = $_GET['question'];
   }
   
   $url = "editquestion.php?question=".$question;
   //posted edited question
   if(isset($_POST['submit']))
   {
       $editedquestion = $_POST['editedquestion'];
       $query = mysqli_query($conn,"update question set question = '$editedquestion' where question = '$question'");
       if($query)
       {
           
           header("Location:myquestions.php?edited=true");
       }
       else
       {
           echo "Something Went Wrong";
       }

   }
   
?>

<div class="container mt-4 mb-4">
    <h2 class="mb-3">Editing Previous Question</h2>
   <form  action="<?php echo $url?>" method="post">
    <p>Here is your question start editing below</p>
   <input type="text" class="form-control mt-2 mb-4" name="editedquestion"  value="<?php echo $question?>" >
   <button  type="submit" name="submit" value='Submit' class="btn btn-md btn-primary" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Make permanent changes to question" >Edit</button>
   <button type ="reset" class="btn btn-md btn-primary"  data-bs-toggle="tooltip" data-bs-placement="right" title="Revert all changes done to the question">Revert</button>
</form>



  </form>

</div>

<script src="js/tooltip.js"></script>
<script>
      document.getElementById("inputsearch").style.display="none";
</script>