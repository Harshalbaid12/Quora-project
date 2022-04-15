<?php

include("db.php");
 session_start();
if(!isset($_SESSION['student']))
{
   header("Location:login.php");
}

  include("nav.php");
  echo "Welcome".$_GET['question'];

?>

<input type="text" value="<?php echo $_GET['question'];?>"  readonly/>
