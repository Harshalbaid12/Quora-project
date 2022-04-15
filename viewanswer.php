<?php
 include("db.php");
 session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}


  include("nav.php");
  //echo "Welcome".$_SESSION['student'];
  $question = $_GET['question'];
  $query = mysqli_query($conn,"select emailID from question where question='$question'");
  $row = mysqli_fetch_row($query);
  $email = $row[0];
  $query2 = mysqli_query($conn,"select name,course,class from student where emailID='$email'");
  $row2 = mysqli_fetch_row($query2);

  

  //getting all answer for particular question
  
  $query3 = mysqli_query($conn,"select * from answer");
  $row3 = mysqli_fetch_all($query3);
  if (sizeof($row3) ==0 )
     {
        $msg = "No Answers yet for this question";
     }
  else
  {

  }

                   
  //echo $question;


?>

<div class="container mt-4 mb-4">
       <div class="card" style="width: 100%;">
             <div class="card-body">
                 <p class="car-text"><?php echo "Posted by ".$row2[0]."<br>"."From ".$row2[2]." ".$row2[1]; ?></p>
                 <h5 class="card-title" id="question"><?php echo $question;?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                <button class="btn btn-md" >
                 <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bell-slash-fill" viewBox="0 0 16 16">
  						<path d="M5.164 14H15c-1.5-1-2-5.902-2-7 0-.264-.02-.523-.06-.776L5.164 14zm6.288-10.617A4.988 4.988 0 0 0 8.995 2.1a1 1 0 1 0-1.99 0A5.002 5.002 0 0 0 3 7c0 .898-.335 4.342-1.278 6.113l9.73-9.73zM10 15a2 2 0 1 1-4 0h4zm-9.375.625a.53.53 0 0 0 .75.75l14.75-14.75a.53.53 0 0 0-.75-.75L.625 15.625z"/>
				</svg>
                 </button>
                 <button class="btn btn-md" id="answer" onclick="gotofunction()">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
  				<path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
				</svg>
				</button>
                <button class="btn btn-md">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-octagon" viewBox="0 0 16 16">
  				<path d="M4.54.146A.5.5 0 0 1 4.893 0h6.214a.5.5 0 0 1 .353.146l4.394 4.394a.5.5 0 0 1 .146.353v6.214a.5.5 0 0 1-.146.353l-4.394 4.394a.5.5 0 0 1-.353.146H4.893a.5.5 0 0 1-.353-.146L.146 11.46A.5.5 0 0 1 0 11.107V4.893a.5.5 0 0 1 .146-.353L4.54.146zM5.1 1 1 5.1v5.8L5.1 15h5.8l4.1-4.1V5.1L10.9 1H5.1z"/>
 			    <path d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z"/>
				</svg>
				</button>
                <div class="card">
                    <div class="card-body">
                         <p class="card-text"><?php echo $msg;?></p>
                    </div>
                </div>
            </div>
        </div>
</div>

<script>
    function gotofunction()
    {
        let question = document.getElementById('question').innerHTML;
        //console.log(question);
        window.location.href='answerquestion.php?question='+question;
    }

</script>