var check1 = false;
var check2 = false;
var check3 = false;
var check4 = false;
var check5 = false;

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

  updateformvalidator();
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
  loginformvalidator();
  updateformvalidator();
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
  loginformvalidator();
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


function selected()
{
  
  document.getElementById("updatebutton").disabled = false;
       
  
}


function formvalidator()
{
    if(check1 && check2 && check3 && check4)
    {
       document.getElementById("submitbutton").disabled = false;
       
    }
   
}


function loginformvalidator()
{
    if(check1 && check2)
    {
       document.getElementById("submit").disabled = false;
       
    }
   
}

function updateformvalidator()
{
  
    if(check1 || check4 )
    {
       document.getElementById("updatebutton").disabled = false;
      
       
    }

   
}


