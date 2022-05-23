<?php include("adminnav.php")?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <link rel="stylesheet" href="css/Admin_Control_Style.css" />
    <title>admin contrl</title>
  </head>
  <body>
    <form method="POST" action="Edit_Profile.php">
      <div class="container mt-4">
        <h2 class="text-center mt-4 mb-4">Admin Control</h2>
        <!-- <img class="mx-auto block" src="images/Admin Image.png" class="admin-image" /> -->
       
        <div class=" container row d-flex justify-content-center">
          <div class="reported-question card col-4 border rounded p-4 m-2" onclick="window.location.href='reportedquestion.php'">
        <img class="question-icon" src="images/Question Icon.png" >
            <a class="reported-question-text">Reported Questions</a>
          </div>
          <div class="reported-answers card col-4 border rounded p-4 m-2" onclick="window.location.href='reportedanswer.php'">
            <img class="answer-icon" src="images/Answers Icon.png">
            <a  class="">Reported answers</a>
          </div>
          <!-- <div class="all-users card col-4 border rounded p-4 m-2" onclick="window.location.href='alluser.php'">
            <img class="users-icon" src="images/Users Icon.png">
            <a href="#" class="all-users-text">All users</a>
          </div>
          <div class="all-que-ans card col-4 border rounded p-4 m-2" onclick="window.location.href='allquestionanswer.php'">
            <img class="all-q-a-icon" src="images/Q&A Icon.png">
            <a href="#" class="all-que-ans">All questions & answers</a>
          </div> -->
        </div>
      </div>
  </body>
</html>
