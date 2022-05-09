<?php
 include("db.php");
 session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}


  include("nav.php");
  //echo "Welcome".$_SESSION['student'];
   $currentuser = $_SESSION['student'];

if(isset($_GET['reportedanswer']))
{
    if($_GET['reportedanswer'] == "true")
    {
        echo '<div class="alert alert-success" id="alert" role="alert">
    Your report has been recorded but the answer will be visible.<br>Our team will go through the answer again and take the necessary action required.
         </div>';
    }

    if($_GET['reportedanswer'] == "already")
    {
        echo '<div class="alert alert-danger" id="alert" role="alert">
    Your have already reported the answer please have patience we are working on it.
         </div>';
    }
}

if(isset($_GET['reportedquestion']))
{
    if($_GET['reportedquestion'] == "already")
    {
        echo '<div class="alert alert-danger" id="alert" role="alert">
    Your have already reported the question please have patience we are working on it.
         </div>';
    }
}





  $question = $_GET['question'];
  $query = mysqli_query($conn,"select emailID,questionID from question where question='$question'");
  $row = mysqli_fetch_row($query);
  $email = $row[0];
  $questionID = $row[1];
  $query2 = mysqli_query($conn,"select name,course,class from student where emailID='$email'");//for question posted by 
  $row2 = mysqli_fetch_row($query2);

  
  
  

  //getting all answer for particular question
  
  $query3 = mysqli_query($conn,"select * from answer where questionID='$questionID'");
  $row3 = mysqli_fetch_all($query3);
  //print_r($row3);
 


                   
  //echo $question;


?>

<!-- Bootstrap icon -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


<!-- Jquery  -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<div class="container mt-4 mb-4" onload="load();">
       <div class="card" style="width: 100%;">
             <div class="card-body">
                 <p class="car-text"><?php echo "Posted by ".$row2[0]."<br>"."From ".$row2[2]." ".$row2[1]; ?></p>
                 <h5 class="card-title" id="question"><?php echo $question;?></h5>
                <!-- <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p> -->
                <button class="btn btn-md" onclick="notif()" data-bs-toggle="tooltip" data-bs-placement="top" title="Turn On Notification for this question">
                 
                <i id="notif" class="fa-solid fa-bell-slash"></i>
                 </button>
                 <button class="btn btn-md" onclick="gotofunction()"  data-bs-toggle="tooltip" data-bs-placement="top" title="Answer this Question">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen-fill" viewBox="0 0 16 16">
  				<path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z"/>
				</svg>
				</button>
                <button class="btn btn-md btn-danger "data-bs-toggle="modal" data-bs-target="#staticBackdrop" >
                 Report!
                </button>
                <?php  if (sizeof($row3) ==0 )
                    {
        
                ?>
                <div class="card mt-4">
                    <div class="card-body">
                         <p class="card-text">No answer yet for this question.</p>
                    </div>
                </div>
                <?php  } 
                  else
                  {

                    for($i=0;$i<sizeof($row3);$i++)
                    {    

                        $id = $row3[$i][8];    
                        $sql = mysqli_query($conn,"select * from answervotes where answerid='$id' and emailID='$currentuser'");
                        $row5 = mysqli_fetch_row($sql);
                        // print_r($row5);
                        $like="bi-hand-thumbs-up";
                        $dislikeclass = " bi-hand-thumbs-down";
                        if($row5 != null)
                        {
                            if($row5[2] == 1)
                            {
                                $like = "bi-hand-thumbs-up-fill";
                            }
                           
                            
                            if($row5[3] == 1)
                            {
                                $dislikeclass = " bi-hand-thumbs-down-fill";
                            }
                        }
                       
                        // echo $id;
                         //for answer posted by 
                        $emailforanswer =$row3[$i][4];
                        $query4 = mysqli_query($conn,"select name,course,class from student where emailID='$emailforanswer'");//for question posted by 
                         $row4 = mysqli_fetch_row($query4);
                        // print_r($row4);
                       
                     ?> 
                 <div class="card mt-4">
                    <div class="card-body" id="answer<?php echo $row3[$i][8];?>">
                         <p class="card-text"><?php echo "Answered by ".$row4[0]."<br>"."From ".$row4[2]." ".$row4[1];?></p>
                         <p class ="card-text answer"><?php echo $row3[$i][0];?></p>
                        
                         
                         <i onclick="update_likedislike('<?php echo $row3[$i][8]?>','<?php echo $currentuser;?>','like');" class="bi   m-3 <?php echo $like;?>" id="like_<?php echo $row3[$i][8];?>" data-bs-toggle="tooltip" data-bs-placement="top" title="If you find this answer usefull then click to Upvote this answer"></i><span id="votesup" value=""><?php echo $row3[$i][6];?></span>  
                         <i onclick="update_likedislike('<?php echo $row3[$i][8]?>','<?php echo $currentuser;?>','dislike');" class="bi <?php echo $dislikeclass;?> m-3" id="dislike_<?php echo $row3[$i][8];?>" data-bs-toggle="tooltip" data-bs-placement="top" title="If you find this answer not usefull then click to downvote this answer"></i><span id="votesdown" value=""><?php echo $row3[$i][7];?></span>
                        
                        
                        
                         <button id="report" class="btn btn-md btn-danger m-4 report" data-bs-toggle="modal" data-bs-target="#staticBackdrop2" value="<?php echo $row3[$i][8]; ?>">
                          Report!
				        </button>
                       
                    </div>
              <?php  
                    }  
                 }?>

            </div>
        </div>
</div>
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Reason for Reporting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Why you want to report this question please select the reason from below
                </div>
                <form action="report.php" method="post"> 
                    <div class="container">
                    <input type="radio" id="1" name="reason" value="It contains abusive content" checked>
                    <label for="1">It contains abusive content</label><br>
                    <input type="radio" id="2" name="reason" value="It contains offensive content">
                    <label for="2">It contains offensive content</label><br>
                    <input type="radio" id="3" name="reason" value="It has information which should not be shared">
                    <label for="3">It has information which should not be shared</label><br>
                    <input type="radio" id="4" name="reason" value="It conatins irrelevant answer which has no meaning">
                    <label for="4">It has no meaning</label>
                   <input type="text" name="question" style="display:none" value="<?php echo $question;?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" >No Wait</button>
                    <button type="submit" name="submit" value =1    data-bs-dismiss="modal" class="btn btn-danger" > Report</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    
<div class="modal fade" id="staticBackdrop2" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Reason for Reporting</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Why you want to report this answer please select the reason from below
                </div>
               
                    <div class="container">
                    <input type="radio" id="1" name="reason2" value="It contains abusive content" checked>
                    <label for="1">It contains abusive content</label><br>
                    <input type="radio" id="2" name="reason2" value="It contains offensive content">
                    <label for="2">It contains offensive content</label><br>
                    <input type="radio" id="3" name="reason2" value="It has information which should not be shared">
                    <label for="3">It has information which should not be shared</label><br>
                    <input type="radio" id="4" name="reason2" value="It conatins irrelevant answer which has no meaning">
                    <label for="4">It has no meaning</label><br>
                    <input type="radio" id="5" name="reason2" value="It is repetetive">
                    <label for="4">It is repetetive</label>
                   <input type="text" id="question" name="question" style="display:none" value="<?php echo $question;?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" >No Wait</button>
                    <button type="button" name="submitanswer" value =1   id="yesdelete" data-bs-dismiss="modal" class="btn btn-danger" > Report</button>
                </div>
               
            </div>
        </div>
    </div>
<script src="js/tooltip.js"></script>
<script>
   

//alert msg js


var alert=document.getElementById("alert");
    setTimeout(() => {
        alert.style.display="none";
    }, 15000);



//report button js
   
   var allreportbutton = document.getElementsByClassName("report");
   Array.from(allreportbutton).forEach(button => {
           button.addEventListener("click",function(event){
                  var milgaya = event.target;
                  var emailofanswer = milgaya.value;
                  var question = document.getElementById("question").innerHTML;
                  var yes = document.getElementById("yesdelete");
                 
                  yes.addEventListener("click",function(event){
                    var reasons = document.getElementsByName("reason2");
                    Array.from(reasons).forEach(reason => {
                        if(reason.checked == true)
                        {
                            var gotreason = reason.value;
                            window.location.href = "report.php?email="+emailofanswer+"&question="+question+"&reason="+gotreason;
                        }
                    });

                      //console.log(reason);
                  });
                  
        
           });
   });
 

    function gotofunction()
    {
        let question = document.getElementById('question').innerHTML;
        //console.log(question);
        window.location.href='answerquestion.php?question='+question;
    }

    function notif()
     {
        
        var notif=document.getElementById("notif");
         if(notif.classList.contains("fa-bell-slash"))
         {
             notif.classList.remove("fa-bell-slash");
             notif.classList.add("fa-bell");
             
         }
         else
         {
             notif.classList.add("fa-bell-slash");
             notif.classList.remove("fa-bell");
             
         }
       
      
        
     }
     function update_likedislike(id,user,type)
     {
        // var question = document.getElementById("question");
       // console.log(id);
        jQuery.ajax({
            url:"setlikedislike.php",
            type:'post',
            data:'id='+id+'&user='+user+'&type='+type,
            success:function(result)
            {

               
              result = jQuery.parseJSON(result);
               // console.log(result);
                if(result.operation == 'like')
                {
                    jQuery("#like_"+id).addClass('bi-hand-thumbs-up-fill');
                  jQuery("#like_"+id).removeClass('bi-hand-thumbs-up');

                  jQuery("#dislike_"+id).addClass('bi-hand-thumbs-down');
                  jQuery("#dislike_"+id).removeClass('bi-hand-thumbs-down-fill'); 
                 
                 
                }
                else if(result.operation == 'unlike')
                {
                    jQuery("#like_"+id).removeClass('bi-hand-thumbs-up-fill');
                  jQuery("#like_"+id).addClass('bi-hand-thumbs-up'); 
                }
                else if(result.operation == 'undislike')
                {
                    jQuery("#dislike_"+id).removeClass('bi-hand-thumbs-down-fill');
                  jQuery("#dislike_"+id).addClass('bi-hand-thumbs-down'); 
                }
               else if(result.operation == 'dislike')
                {
                  jQuery("#dislike_"+id).removeClass('bi-hand-thumbs-down');
                  jQuery("#dislike_"+id).addClass('bi-hand-thumbs-down-fill'); 
                  jQuery("#like_"+id).removeClass('bi-hand-thumbs-up-fill');
                  jQuery("#like_"+id).addClass('bi-hand-thumbs-up'); 
                 
                }
                jQuery("#answer"+id+" #votesup").html(result.likecount);
                jQuery("#answer"+id+" #votesdown").html(result.dislikecount);
            }
        });
    //    

     }




        
    
    document.getElementById("inputsearch").style.display="none"; 
</script>





