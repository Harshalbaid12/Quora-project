<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <title>FC Quora for College</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" aria-label="Fifth navbar example">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Quora For College</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05" aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="home.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="askquestion.php">Ask Question</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" href="answerquestion.php">Answer Question</a>
          </li>
          <li class="nav-item dropdown ">
            <a class="nav-link active dropdown-toggle" href="#" id="dropdown05" data-bs-toggle="dropdown" aria-expanded="false">Sort</a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdown05">
              <li><a class="dropdown-item" href="#">Most Answered Questions</a></li>
              <li><a class="dropdown-item" href="#">Least Answered Questions</a></li>
              <li><a class="dropdown-item" href="#">Not Answered Questions</a></li>
            </ul>
          </li>
          <li class="nav-item dropdown ">
            <a class="nav-link active dropdown-toggle" href="#" id="dropdown06" data-bs-toggle="dropdown" aria-expanded="false">My Profile</a>
            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="dropdown06">
              <li><a class="dropdown-item" href="myquestions.php">My Questions</a></li>
              <li><a class="dropdown-item" href="myanswers.php">My Answers</a></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control  me-2 " type="text" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>


</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</html>
