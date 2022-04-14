<?php
session_start();
include("db.php");
if(isset($_POST['submit']))
{
    $name = $_POST['name'];
	$email = $_POST['email'];
	$course = $_POST['course'];
	$class = $_POST['class'];
   
   	$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
  // echo "$password.<br>.$email.<br>.$name";
  if(mysqli_query($conn,"insert into student(emailID,name,password,course,class) values('$email','$name','$password','$course','$class')"))
  {
     echo "Registered Successfully";
     $_SESSION['student'] = $email;
     header("Location:home.php");
  }
  else{
   echo '<script language="javascript">
   alert("Email Id Already Exists");
   </script>';
    
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

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />

  <style>
    body {
      background-image: url('images/Background.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
    }
  </style>
</head>

<body>
  <!-- <section class="vh-100 bg-image" style="img src="Background1.jpg"> -->
  <div class="mask d-flex align-items-center h-150 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-5 col-lg-5 col-xl-6 mt-5">
          <div class="card mb-5 mask d-flex align-items-center h-100 gradient-custom-3" style="border-radius: 20px">
            <div class="card-body mb-0">
              <h2 class="text-uppercase text-center mb-5">
                Create an account
              </h2>

              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                <div class="form-outline mb-4">
                <label class="form-label" for="name">Your Name</label>
                <input type="text" id="name" name="name" class="form-control form-control-lg validate" onkeyup="validatename()" autocomplete ="off" required />
                <span id="textname"></span>
                </div>
                
                <div class="form-group">
         			<label for="exampleFormControlSelect1">Course</label>
    				<select name="course" class="form-control" id="exampleFormControlSelect1">
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
					  <option>Mathematics(General Level)</option>
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
    				<label for="exampleFormControlSelect2">Class</label>
    				<select name="class" class="form-control" id="exampleFormControlSelect2">
      				<option>First Year</option>
      				<option>Second Year</option>
      				<option>Third Year</option>
      				<option>Last Year</option>
   				    </select>
  				</div>
                <div class="form-outline mb-4">
                <label class="form-label" for="email">Your Email</label>
                <input type="email" id="email" name="email" class="form-control form-control-lg" autocomplete ="off" required onkeyup="validateemail()" />
                  <span id="textemail"></span>
                </div>

                <div class="form-outline mb-4">
                   <label class="form-label" for="password">Password</label>
                   <input type="password" id="password" name="password" class="form-control form-control-lg" autocomplete ="off" onkeydown="validatepassword()" required />
                   <span id="textpassword"></span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="confirmpassword">Confirm password</label>
                  <input type="password" id="confirmpassword" class="form-control form-control-lg" autocomplete ="off" onkeyup="validateconfirm()" required />
                  <span id="textconfirm"></span>
                </div>
                 
                <div class="d-flex justify-content-center">
                  <button type="submit" value="submit" name="submit" id="submitbutton" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" disabled>

                    Register
                  </button>
                </div>

                <p class="text-center text-muted mt-3 mb-0">
                  Have already an account?
                  <a href="login.php" class="fw-bold text-body"><u>Login here</u></a>
                </p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </section>
</body>
<script src="js/validation.js"></script>

</html>