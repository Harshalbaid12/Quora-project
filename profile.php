<?php



session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}
  include("db.php");
  include("nav.php");
  //echo "Welcome".$_SESSION['student'];
  if(isset($_GET['updated']))
  {
    if($_GET['updated'] == true)
    {
      echo '<div class="alert alert-warning" id="alert" role="alert">
      Profile Updated successfully !!
           </div>';
    }
  }

  $emailID = $_SESSION['student'];
  $query = mysqli_query($conn,"select * from student where emailID ='$emailID'");
  $row = mysqli_fetch_row($query);
  //print_r($row);
  $name = $row[1];
  $course = $row[3];
  $class = $row[4];
 
  $query2 = mysqli_query($conn,"select count(*) from question where emailID='$emailID'");
  $row2 = mysqli_fetch_row($query2);
  //print_r($row2);
  $noofquestion = $row2[0];

  $query3 = mysqli_query($conn,"select count(*) from answer where emailID='$emailID'");
  $row3 = mysqli_fetch_row($query3);
  //print_r($row3);
  $noofanswer = $row3[0];

  
   


?>









<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registration</title>

 
  <link rel="stylesheet" href="css/Edit_Profile_Style.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />  

  <style>
    body {
      background-image: url('images/Background.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }
     .dropdown-menu{
            background-color:#343a40;;
     } 
    
  </style>
</head>

<body>
 
    <div class="mask d-flex align-items-center h-150 gradient-custom-3">
      <div class="container h-100 ">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-5 col-lg-5 col-xl-10 mt-5">
            <div class="card mb-5 mask  h-100 gradient-custom-3" style="border-radius: 20px">
              <div class="card-body mb-0 ">
                <h2 class="text-uppercase text-center mb-5">
                   Profile
                </h2>
                <div class="img text-center">
                  <img src="images/Logo.png" class="logo " />
                </div>
    
               
                <div class="form-outline mb-4">
                  <label class="form-label" for="name">Your Name</label>
                  <input type="text" id="name" name="name" class="form-control" autocomplete="off"
                    value="<?php echo $name;?>" readonly />
                  
                </div>
    
                <div class="form-group">
                  <label for="courses">Course</label>
                  <input type="text" id="courses" class="form-control " autocomplete="off"
                    value="<?php echo $course;?>" readonly />
    
                </div>
                <div class="form-group">
                  <label for="classes">Class</label>
                  <input type="text" id="classes" class="form-control " autocomplete="off"
                    value="<?php echo $class;?>" readonly />
    
                </div>
                <div class="form-outline mb-4">
                  <label class="form-label" for="email">Your Email</label>
                  <input type="email" id="email" name="email" class="form-control " autocomplete="off"
                    required value="<?php echo $emailID;?>" readonly />
                 
                </div>
                <div class="contibution d-flex justify-content-center">
                <div class="card m-4" style="width: 18rem;">
                  <div class="card-body">
                    <h5 class="card-title">Contribution </h5>
                    <h6 class="card-subtitle mb-2 text-muted">In answering</h6>
                    <p class="card-text">You have contributed to <b><?php echo $noofanswer?></b> question/s.</p>
                    <a href="myanswers.php" class="card-link">View all answers </a>

                  </div>
                </div>
             <div class="card m-4" style="width: 18rem;">
              <div class="card-body">
                <h5 class="card-title">Contribution </h5>
                <h6 class="card-subtitle mb-2 text-muted">In asking</h6>
                <p class="card-text">You have asked <b><?php echo $noofquestion?></b> question/s.</p>
                <a href="myquestions.php" class="card-link">View all questions  </a>

              </div>
            </div>

                </div>
                
    
               
    
    
                <div class="d-flex px-5 mx-5 justify-content-center">
                  <button type="submit"  style="width: 200px;" value="submit" name="submit" onclick="window.location.href='editprofile.php';" 
                    class="btn btn-success text-color-light btn-block btn-lg gradient-custom-4 text-body">
    
                    Edit Profile
                  </button>
                </div>
              </div>
              
            </div>
            
          </div>
        </div>
       
      </div>
    </div>
 
   
  
  </html>

  <script>
      
    var alert=document.getElementById("alert");
    setTimeout(() => {
        alert.style.display="none";
    }, 4000);


    //not displaying search bar
    document.getElementById("inputsearch").style.display="none";
  </script>