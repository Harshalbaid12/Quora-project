<?php

include("db.php");
session_start();
$msg="";
 if(isset($_POST['submit']))
 {
 	 $email = $_POST['email'];
  	 $password = $_POST['password'];
	 $query = "select password from admin where email='$email'";
	 $queryy = mysqli_query($conn,$query);
	 if(mysqli_num_rows($queryy) != 0)
	 {
		 //echo "chalo email hai teri ";
		//  $passwordcheck = mysqli_query($conn,$query);
		 $row = mysqli_fetch_row($queryy);
		 if($password === $row[0])
		 {
			 //echo "Dono sahi hai tere acha hai";
			 $msg = "";
			 $_SESSION['admin'] = $email;
			header("Location:admin_control.php");
		 }
		 else
		 {
			 //echo "Bhai password yaad kar ";
			 $msg="Incorrect Password";
		 }
		//  if()
	 }
	 else{
		 //echo "Email nai hai bhai teri";
		 $msg = "Email Doesn't Exists";
	 }

 }
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login</title>

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css">

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
  <div class="mask d-flex align-items-center h-80 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-5 col-lg-5 col-xl-6 mt-5">
          <div class="card mb-5 mask d-flex align-items-center h-100 gradient-custom-3" style="border-radius: 20px">
            <div class="card-body mb-0">
              <h2 class="text-uppercase text-center mb-5">
                Admin Login
              </h2>

              <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">


                <div class="form-outline mb-4">
                  <label class="form-label" for="email"> Email</label>
                  <input type="email" id="email" name="email" class="form-control form-control-lg" autocomplete ="off" onkeyup="validateemail()" required />
                  <span id="textemail"></span>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="password">Password</label>
                  <input type="password" id="password" name="password" class="form-control form-control-lg" autocomplete ="off" onkeyup="validatepassword()" required />
                  <span id="textpassword"></span>
                </div>



                <div class="d-flex justify-content-center">
                  <button type="submit" name="submit" value="1" id="submit" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body" disabled>
                    Login
                  </button> <br>
				  
                </div>
				<p id="msg" class="text-center"><?php echo $msg;?></p>
               
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