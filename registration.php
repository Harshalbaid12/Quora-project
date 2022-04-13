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
      <div class="mask d-flex align-items-center h-100 gradient-custom-3">
        <div class="container h-100">
          <div
            class="row d-flex justify-content-center align-items-center h-100"
          >
            <div class="col-12 col-md-5 col-lg-5 col-xl-6 mt-5">
              <div
                class="card mb-5 mask d-flex align-items-center h-100 gradient-custom-3"
                style="border-radius: 20px"
              >
                <div class="card-body mb-0">
                  <h2 class="text-uppercase text-center mb-5">
                    Create an account
                  </h2>

                  <form >
                    <div class="form-outline mb-4">
                      <input
                        type="text"
                         id="form3Example1cg"
                        class="form-control form-control-lg validate"
                        required
                      />
                      <label class="form-label" for="form3Example1cg"
                        >Your Name</label
                      >
                    </div>

                    <div class="form-outline mb-4">
                      <input
                        type="email"
                        id="email"
                        class="form-control form-control-lg"
                        required
                      />
                      <label class="form-label" for="email"
                        >Your Email</label
                      >
                    </div>

                    <div class="form-outline mb-4">
                      <input
                        type="password"
                        id="password"
                        class="form-control form-control-lg"
                        required
                      />
                      <label class="form-label" for="password"
                        >Password</label
                      >
                    </div>

                    <div class="form-outline mb-4">
                      <input
                        type="password"
                        id="confirmpassword"
                        class="form-control form-control-lg"
                        required
                      />
                      <label class="form-label" for="confirmpassword"
                        >Confirm  password</label
                      >
                    </div>

                    <div class="d-flex justify-content-center">
                      <button
                        type="submit"
                        class="btn btn-success btn-block btn-lg gradient-custom-4 text-body"
                        onclick = "validate()"
                        >
                       
                        Register
                      </button>
                    </div>

                    <p class="text-center text-muted mt-3 mb-0">
                      Have already an account?
                      <a href="login.php" class="fw-bold text-body"
                        ><u>Login here</u></a
                      >
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
    function validate()
    {
      var mail = document.getElementById("email").value;
      var regex = /^([a-zA-Z0-9\._]+)@([a-zA-Z0-9])+.([a-z]+)(.[a-z])?$/
      if(regex.test(mail))
      {
        alert("Valid Email");
        return true;
      }
      else{
        alter("Invalid Email");
        return false;
      }
    }
  </script>
</html>
