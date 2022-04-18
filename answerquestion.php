<?php


 session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}

  include("db.php");
  include("nav.php");
  if(!isset($_GET['question']))
  {
     header("Location:home.php");
     
  }
$question = $_GET['question'];
   


$queryforquestionid = mysqli_query($conn,"select questionID from question where question='$question'");
$row = mysqli_fetch_row($queryforquestionid);
$qid = $row[0];
$queryforemailid = mysqli_query($conn,"select emailID from answer where questionId='$qid'");
$row2 =  mysqli_fetch_all($queryforemailid);
$url1 = "editanswer.php?question=".$question."&redirectedfromanswer=true";
$url2 = "answerquestion.php?question=".$question;
$url3 = "viewanswer.php?question=".$question;
//checking if a user is trying to answer the same same question 
//print_r($row2);
   
     if($row2 !=NULL)
     {
       foreach($row2 as $row)

        if($row[0] == $_SESSION['student'])
        {
            header("Location:$url1");
        }

      }


// inserting data in answer database if new answer is there 

if(isset($_POST['submit']))
{
  $answer = $_POST['answer'];

  $emailID = $_SESSION['student'];
  date_default_timezone_set('Asia/Kolkata');
  $time = date('Y/m/d H:i:s');
  $datetime = explode(" ",$time);

  $insertinanswer = mysqli_query($conn,"insert into answer (answer,date,time,questionId,emailID) values('$answer','$datetime[0]','$datetime[1]','$qid','$emailID')");
  if($insertinanswer)
  {
    header("Location:$url3");
  }
  echo "Something went wrong please try again";

}


?>
<div class="container mt-4 mb-4">
<form action="<?php echo $url2;?>" method="post">
<div class="input-group mb-3">
 <input type="text" class="form-control"  value="<?php echo $question?>"  readonly >
 </div>
  <textarea class="form-control mt-3 mb-3" rows="7"  name="answer" placeholder="start typing your answer here " required></textarea>

  <button type="submit" name="submit" value='Submit' class="btn btn-md btn-primary" >Post</button>
</form>

</div>

<script>
    document.getElementById("inputsearch").style.display="none";
</script>
