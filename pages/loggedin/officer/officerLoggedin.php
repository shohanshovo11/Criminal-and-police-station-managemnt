<?php
session_start();
$username = $_SESSION['username'];
// echo $username;
?>
<!doctype html>
<html lang="en">

<head>
  <style>
    body,
    html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: Arial, sans-serif;
    }

    body {
      background-color: #f5f5f5;
    }

    .container {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      height: 50%;
    }

    .text {
      font-size: 30px;
      text-align: center;
      margin-bottom: 20px;
      color: #333;
      text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
    }

    .button {
      padding: 12px 24px;
      background-color: #007bff;
      color: #fff;
      font-size: 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
      transition: background-color 0.3s ease;
    }

    .button:hover {
      background-color: #0056b3;
    }
  </style>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../../../css/bootstrap.min.css">
  <!-- <script src="js/bootstrap.min.js"></script> -->
  <script defer src="../../../js/bootstrap.bundle.js"></script>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="../../loggedin/officer/officerLoggedin.php">BD POLICE</a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav ms-auto mb-2 mx-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../../loggedin/officer/officerLoggedin.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../../stationdetails/stationDetails.php">Your Station Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../../criminalDash/criminaldash.php">Criminal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../../FIR/policeView.php">Complain Management</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Application
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="../../application/create.php">Create Application</a>
              <a class="dropdown-item" href="../../application/view.php">Your Application</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link active btn btn-primary" aria-current="page" href="../../profile/officerProfile.php"><?php echo "$username" ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active btn btn-danger" aria-current="page" href="../../../index.php"><?php echo "Logout" ?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner img-fluid">
      <div class="carousel-item carousal-img active bg-img1">
      </div>
      <div class="carousel-item carousal-img bg-img2">
      </div>
      <div class="carousel-item carousal-img bg-img3">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>