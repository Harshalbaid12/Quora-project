<?php
 include("db.php");
 session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}

  include("nav.php");
  echo "Welcome".$_SESSION['student'];

  $question = $_GET['question'];
  if($_GET['redirectedfromanswer'] == true)
  {
    echo '<script language="javascript">
      alert("You have already answered this question So kinldy edit your previous answer ::YOU CANNOT WRITE MULTIPLE ANSWER FOR SAME QUESTION");
      </script>';
  }



?>