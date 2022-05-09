<?php
session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}

include("db.php");
$reportedby = $_SESSION['student'];
//print_r($_POST);
if(isset($_GET['email']) && isset($_GET['question']) && isset($_GET['reason']))
{
    $answerid  = $_GET['email'];
    $question = $_GET['question'];
    $reason = $_GET['reason'];


    $row2 = mysqli_fetch_row(mysqli_query($conn,"select emailID from answer where answerid='$answerid'"));
    $email = $row2[0];    
    $query = mysqli_query($conn,"select questionID from question where question='$question'" );
    $row = mysqli_fetch_row($query);
    $qid = $row[0];




    $query3 = mysqli_query($conn,"insert into reportedanswer(reason,reportedby,questionID,emailID) values('$reason','$reportedby','$qid','$email')");
    if($query3)
    {
        if(mysqli_query($conn,"update answer set reported=1 where answerid='$answerid'"))
        {
            header("Location:viewanswer.php?question=$question&reportedanswer=true");
        }
        else
        {
            echo "Something Went Wrong Please Try Again";
        }
    }
    else
    {
        header("Location:viewanswer.php?question=$question&reportedanswer=already");
       
    }
}






if(isset($_POST['submit']))
{
   
    $reason = $_POST['reason'];
    $question = $_POST['question'];
     $query1 = mysqli_query($conn,"select * from question where question='$question'");
     $row1 = mysqli_fetch_row($query1);
     print_r($row1);
     $qid = $row1[0];
     $owner = $row1[4];

    $query2 = mysqli_query($conn,"insert into reportquestion(questionID,owneremailID,reportedby,reason) values ('$qid','$owner','$reportedby','$reason') ");
    if($query2)
    {
        if(mysqli_query($conn,"update question set reported=1 where questionID ='$qid'"))
        {
            header("Location:home.php?reportedquestion=true");
        }
        else
        {
            header("Location:home.php?reportedquestion=false");
        }
    }
    else
    {
       
        header("Location:viewanswer.php?question=$question&reportedquestion=already");

    }
   
}

?>