<?php

$conn = mysqli_connect("localhost","root","","quoradb");
if(!$conn)
{
    die("Connection failed");
}
else
 echo "Connection successfull";



?>