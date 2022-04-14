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
        echo '<script language="javascript">
        alert("Question Already Exist bro , So Kindly check answer for the question and if no answer is provided Sorry but you have to wait for answers ");
        </script>';;
     }
     else{

         echo "Question is new";
         $insert = mysqli_query($conn,"insert into question(question,date,time,emailID) values('$question','$datetime[0]','$datetime[1]','$email')");
         if($insert)
         {
            echo '<script language="javascript">
            alert("Your Question was Added Sucessfully");
            </script>';
            header("Location:home.php");
         }
         else{
            echo '<script language="javascript">
            alert("Something went wrong Please try again");
            </script>';
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
