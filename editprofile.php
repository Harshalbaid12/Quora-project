<?php


session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}
  include("db.php");
  include("nav.php");
  //echo "Welcome".$_SESSION['student'];
  $emailID = $_SESSION['student'];
  $query = mysqli_query($conn,"select * from student where emailID ='$emailID'");
  $row = mysqli_fetch_row($query);
  //print_r($row);
  $name = $row[1];
  $course = $row[3];
  $class = $row[4];



  if(isset($_POST['submit']))
  {
     
    $name = $_POST['name'];
    $course = $_POST['course'];
    $class = $_POST['class'];
    $email = $_POST['email'];

    $query = mysqli_query($conn,"update student set name='$name',course='$course',class='$class',emailID='$email' where emailID='$emailID'");
    if($query)
    {
      $_SESSION['student'] = $email; 
      header("Location:profile.php?updated=true");
    }
    else
    {
      header("Location:profile.php?updated=false");
    }
    
       
  }









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

<body onload="defaultset();">
 
    <div class="mask d-flex align-items-center h-150 gradient-custom-3">
      <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col-12 col-md-5 col-lg-5 col-xl-6 mt-5">
            <div class="card mb-5 mask d-flex align-items-center h-100 gradient-custom-3" style="border-radius: 20px">
              <div class="card-body mb-0 " >
                <h2 class="text-uppercase text-center mb-5">
                  Edit Profile
                </h2>
                <div class="img text-center">
                <img src="images/Logo.png" class="logo " />
                </div>
               
                <form action="editprofile.php" method="post">
                  <div class="form-outline mb-4">
                  <label class="form-label" for="name">Your Name</label>
                  <input type="text" id="name" name="name" class="form-control form-control-lg validate" onkeyup="validatename()" autocomplete ="off" value = "<?php echo $name;?>" required />
                  <span id="textname"></span>
                  </div>
                  
                  <div class="form-group">
                 <label for="courses">Course</label>
              <select name="course" class="form-control" onclick="selected();" id="courses" >
                <option>B.A Economics</option>
                <option>B.A English</option>
                <option>B.A French</option>
                <option>B.A German</option>
                <option>B.A Hindi</option>
              <option>B.A History</option>
              <option>B.A Marathi</option>
              <option>B.A Philosophy</option>  
              <option>B.A Sociology</option>
              <option>B.A Political Sci.</option>
              <option>B.A Sanskrit</option>
              <option>B.A Psychology</option>
              <option>BSc Animation</option>
              <option>BSc BioTech</option>
              <option>BSc Botany</option>  
              <option>BSc Chemistry</option>
              <option>BSc CS</option>
              <option>BSc Electronics</option>
              <option>BSc Environmental Sci.</option>
              <option>BSc Geology</option>
              <option>BSc Mathematics</option>  
              <option>BSc Microbiology</option>
              <option>BSc Organic Chemistry</option>
              <option>BSc Physics</option>
              <option>BSc Statistics</option>
              <option>BSc Zoology</option>
              <option>M.A Economics</option>  
              <option>M.A English</option>
              <option>M.A Marathi</option>
              <option>M.A Psychology</option>
              <option>MSc Analytical Chemistry</option>
              <option>MSc Biochemistry</option>
              <option>MSc Biotech</option>
              <option>MSc Botany</option>
              <option>MSc Computer Application</option>
              <option>MSc CS</option>
              <option>MSc Data Science</option>
              <option>MSc Electronic Science</option>
              <option>MSc Geology</option>
              <option>MSc IMCA</option>
              <option>MSc Organic Chemistry</option>
              <option>MSc Physics</option>
              <option>MSc Zoology</option>
              <option>Applied Statistics</option>
              <option>Geography(General Level)</option>
              <option>Mathematics(  General Level)</option>
              <option>B.Voc. Media and Communication</option>
              <option>B.Voc. Digital Art & Animation</option>
              <option>B.Voc. Photography & Audio-Video Production</option>
              <option>Ph.D Botany</option>
              <option>Ph.D Electronics Science</option>
              <option>Ph.D English</option>
              <option>Ph.D Environmental Science</option>
              <option>Ph.D Geology</option>
              <option>Ph.D Physics</option>
              <option>Ph.D Zoology</option>
              </select>
            </div>
                    <div class="form-group">
              <label for="classes">Class</label>
              <select name="class" class="form-control" onclick="selected();" id="classes">
                <option>First Year</option>
                <option>Second Year</option>
                <option>Third Year</option>
                <option>Last Year</option>
                 </select>
            </div>
                  <div class="form-outline mb-4">
                  <label class="form-label" for="email">Your Email</label>
                  <input type="email" id="email" name="email" class="form-control form-control-lg" autocomplete ="off" required value="<?php echo $emailID;?>" onkeyup="validateemail()" />
                    <span id="textemail"></span>
                  </div>
  
                  <!-- <div class="form-outline mb-4">
                     <label class="form-label" for="password">Password</label>
                     <input type="password" id="password" name="password" class="form-control form-control-lg" autocomplete ="off" onkeydown="validatepassword()" required />
                     <span id="textpassword"></span>
                  </div>
  
                  <div class="form-outline mb-4">
                    <label class="form-label" for="confirmpassword">Confirm password</label>
                    <input type="password" id="confirmpassword" class="form-control form-control-lg" autocomplete ="off" onkeyup="validateconfirm()" required />
                    <span id="textconfirm"></span>
                  </div> -->
                   
                  <div class="d-flex justify-content-center">
                    <button type="submit" value="submit" name="submit" id="updatebutton" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" disabled>
  
                      Update
                    </button>
                  </div>
                  
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </section>
    <div class="hidden" style="display:none">
      <p id="course"><?php echo $course;?></p>
      <p id="class"><?php echo $class;?></p>
    </div>
  </body>
  <script src="js/validation.js"></script>
  
  </html>

  <script>

   // default selecting the course and class for editing
   function defaultset()
  {
   var valuecourse = document.getElementById("course").innerText;
    var valueclass = document.getElementById("class").innerText;
    
    
    var orgcourse = document.getElementById("courses");
    var course = document.createElement("option");
     course.innerText=valuecourse;
     course.setAttribute('selected',"true");
      orgcourse.appendChild(course);
      
      var orgclass = document.getElementById("classes");
      var classs = document.createElement("option");
      classs.innerText=valueclass;
     classs.setAttribute('selected',"true");
      orgclass.appendChild(classs);



  }
    //not displaying search bar
    document.getElementById("inputsearch").style.display="none";
    
  </script>