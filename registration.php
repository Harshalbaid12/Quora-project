<?php

include("db.php");
if(isset($_POST['submit']))
{
  $name = $_POST['name'];
	$email = $_POST['email'];
	$password = password_hash($_POST['password'],PASSWORD_BCRYPT);
  // echo "$password.<br>.$email.<br>.$name";
  if(mysqli_query($conn,"insert into student(emailID,name,password,course,class) values('$email','$name','$password','new','notknown')"))
  {
     echo "Registered Successfully";
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
<script>
  var check1 = false;
  var check2 = false;
  var check3 = false;
  var check4 = false;
 
  function validatename()
  {
    var name = document.getElementById("name").value;
    var text = document.getElementById("textname");
    var namereg = /^[A-Za-z\s]+$/;
    if(name.match(namereg))
    {
      text.innerHTML = "Valid Name";
      text.style.color = "green";
      check4 = true;
    }
    else
    {
      text.innerHTML = "Please enter valid name";
      text.style.color = "red";
      check4 = false;
    }
  }



  function validateemail() {
    var mail = document.getElementById("email").value;
    var text = document.getElementById("textemail");

      var regex = /^[^ ]+@[^ ]+\.[a-z]{2,3}$/;
    if (mail.match(regex)) 
    {
      text.innerHTML = "Valid Email id";
      text.style.color = "green";
      check1 = true;

    }
    else 
    {
      
      text.innerHTML = "Please enter valid email id";
      text.style.color = "red";
      check1 = false;
    }
    formvalidator();
  }

  function validatepassword()
  {
    var password = document.getElementById("password").value;
    var text = document.getElementById("textpassword");
    
    if(password.length >= 7)
    {
      text.innerHTML = "Valid  Password";
      text.style.color = "green";
      check2 =  true;
    }
    else
    {
      text.innerHTML = "Password must be more than 8 chars" ;
      text.style.color = "red";
      check2 = false;
    }
    formvalidator();
  }

 function validateconfirm()
 {
    var confirmpassword = document.getElementById("confirmpassword").value;
    var password = document.getElementById("password").value;
    var text = document.getElementById("textconfirm");
    console.log(confirmpassword);
    console.log(password);
     if(confirmpassword == password)
     {
      text.innerHTML = "Password Matches";
      text.style.color = "green";
      check3 =  true;
     }

     else
     {
      text.innerHTML = "Password Doesn't Matches";
      text.style.color = "red";
      check3 = false;
     }
   formvalidator();
 }

 function formvalidator()
 {
      if(check1 && check2 && check3 && check4)
      {
         document.getElementById("submitbutton").disabled = false;
         
      }
     
 }



</script>

</html>