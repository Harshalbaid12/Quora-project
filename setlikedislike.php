<?php
session_start();
include("db.php");
// setcookie("like_1"," ",1);
// setcookie("like_2"," ",1);
$currentuser = $_SESSION['student'];
//include_once("insertuser.php");
//print_r($_POST);
if(isset($_POST['type']) && $_POST['type'] !=' ' && isset($_POST['id']) && $_POST['id'] >0 && isset($_POST['user']))
{
    $type =$_POST['type'];
    $answerid = $_POST['id'];
    $userid = $_POST['user'];

    

    
    if($type == 'like')
    {

        $upcount = mysqli_fetch_row(mysqli_query($conn,"select * from answervotes where answerid='$answerid' and emailID='$userid' and upvotes=1"));
        // print_r($upcount);
        if($upcount != null)
        {
        
            mysqli_query($conn,"update answervotes set upvotes=0 where answerid='$answerid' and emailID='$currentuser'");
            
            $operation = "unlike";
            
        }
      
        else
        {
            // $downcount = mysqli_fetch_row(mysqli_query($conn,"select * from answervotes where answerid='$answerid' and emailID='$userid' and downvotes=1"));
            // if($downcount != null)//1
               
            //    mysqli_query($conn,"update answervotes set downvotes=0 where answerid='$answerid' and emailID='$currentuser'");

               
            // }

            if(mysqli_query($conn,"insert into answervotes(answerid,emailID,upvotes,downvotes) values('$answerid','$currentuser',1,0)"))
            {

            }
            else
            {
                mysqli_query($conn,"update answervotes set upvotes=1,downvotes=0 where answerid='$answerid' and emailID='$currentuser'");
            }
            $operation = "like";

          

        }
       
    }
    
    if($type == 'dislike')
    {

        $count = mysqli_fetch_row(mysqli_query($conn,"select * from answervotes where answerid='$answerid' and emailID='$userid' and downvotes=1"));
         
        if($count != null)
        {
            mysqli_query($conn,"update answervotes set downvotes=0 where answerid='$answerid' and emailID='$currentuser'");
            $operation = "undislike";
        }
        else
        {
            // $countvote = mysqli_fetch_row(mysqli_query($conn,"select * from answervotes where answerid='$answerid' and emailID='$userid' and upvotes=1"));
        
            // if($countvote != null)
            // {
               
            //     mysqli_query($conn,"update answervotes set votes=0 where answerid='$answerid' and emailID='$currentuser'");
              
            // }

           if(mysqli_query($conn,"insert into answervotes(answerid,emailID,upvotes,downvotes) values('$answerid','$currentuser',0,1)"))
            {

            }
            else
            {
                mysqli_query($conn,"update answervotes set downvotes=1,upvotes=0 where answerid='$answerid' and emailID='$currentuser'");
            }
            $operation = "dislike";
        }
     
        //  
    }
   



    $row3 = mysqli_fetch_row(mysqli_query($conn,"select count(*) from answervotes where upvotes=1 and answerid='$answerid'"));
    $row4 = mysqli_fetch_row(mysqli_query($conn,"select count(*) from answervotes where downvotes=1 and answerid='$answerid'" ));
    //echo $row3[0];

    $likes = $row3[0];
    $dislikes = $row4[0];
    mysqli_query($conn,"update answer set votes='$likes',downvotes='$dislikes' where answerid='$answerid'");
   
    echo json_encode([
          'operation'=>$operation,
          'likecount'=>$row3[0],
          'dislikecount'=>$row4[0]
       
    ]);
}


?>