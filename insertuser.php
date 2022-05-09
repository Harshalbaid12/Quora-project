<?php

include("db.php");

$row = mysqli_fetch_row(mysqli_query($conn,"select count(*) from student"));
$totaluser = $row[0];

$row2 =  mysqli_fetch_all(mysqli_query($conn,"select * from student"));
print_r($row2);

for($i=0;$i<$totaluser;$i++)
{

}


?>