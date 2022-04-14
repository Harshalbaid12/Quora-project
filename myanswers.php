<?php
 include("db.php");
 session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}
else
{
  include("nav.php");
  echo "Welcome".$_SESSION['student'];

}


?>