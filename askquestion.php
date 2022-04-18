<?php


session_start();
if(!isset($_SESSION['student']))
{
  header("Location:login.php");
}

 include("db.php");
 include("nav.php");
 if(isset($_POST['submit']))
 {
     $question = $_POST['question'];
     $email = $_SESSION['student'];
     date_default_timezone_set('Asia/Kolkata');
     $time = date('Y/m/d H:i:s');
     $datetime = explode(" ",$time);
     $msg=" ";

     $query = mysqli_query($conn,"select * from question where question='$question'");

     if(mysqli_fetch_row($query) !=0)
     {
        echo '<div class="alert alert-danger" id="alert" role="alert">
                Question Already Exists!
                     </div>';
     }
     else{

         echo "Question is new";
         $insert = mysqli_query($conn,"insert into question(question,date,time,emailID) values('$question','$datetime[0]','$datetime[1]','$email')");
         if($insert)
         {
           
            header("Location:home.php?added=true");
         }
         else{
            echo '<div class="alert alert-dark" id="alert" role="alert">
                Something went wrong please try again!
                     </div>';
         }
     }
     
 }

 //echo "Welcome".$_SESSION['student'];
?>

<!DOCTYPE html>
<html lang="en">
<body>

    <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    <h3 class="mt-4">Ask Question That will help you and other students also</h3>
    <div class="form-group">
        <label>Question</label><br>
        <input class="form-control" type="text" name="question" placeholder="Type your question here" required><br>
        
    </div>
    <br>
    <button class="btn btn-primary"  type="submit" name="submit" value=1>Go Ask</button>

    </form>
    </div>
</body>

</html>
<script>
    
    var alert=document.getElementById("alert");
    setTimeout(() => {
        alert.style.display="none";
    }, 4000);


    document.getElementById("inputsearch").style.display="none";
</script>