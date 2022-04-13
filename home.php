<?php

include("db.php");
include("nav.php");

if(mysqli_query($conn,'insert into student(emailID,name,password,course,class) values("asasass.com","dvsd",12345678,"maths","fy")'))
{
    echo "Done";
} 
else
{
    echo "Not Done";
  }

?>
