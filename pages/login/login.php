<?php
if (isset($_POST['submit1'])) {
  $userInputUsername = $_POST['username'];
  $userInputPassword = $_POST['password'];
  $conn = oci_connect('shohan', '123', '//localhost/XE');
  if (!$conn) {
    echo 'Failed to connect to oracle' . "<br>";
  } else {
  }
  if (!$conn) {
    $e = oci_error();
    die('Connection failed: ' . $e['message']);
  }
  $sql = "SELECT userid,pass,usertype FROM login WHERE userid = :usr AND pass = :pass";
  $stmt = oci_parse($conn, $sql);
  if (!$stmt) {
    $e = oci_error($conn);
    die('Statement preparation failed: ' . $e['message']);
  }
  oci_bind_by_name($stmt, ':usr', $userInputUsername);
  oci_bind_by_name($stmt, ':pass', $userInputPassword);
  $result = oci_execute($stmt);
  if (!$result) {
    $e = oci_error($stmt);
    die('Query execution failed: ' . $e['message']);
  }
  if ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
    session_start();
    $user = $row['USERID'];
    $usertyp = $row['USERTYPE'];
    $_SESSION['username'] = $user;
    if ($usertyp == "G") {
      header('Location: ../loggedin/general_user/loggedin_user.php');
    } else if ($usertyp == "O") {
      header('Location: ../loggedin/officer/officerLoggedin.php');
    } else {
      header('Location: ../loggedin/admin.php'); //admin
    }
  } else {
    echo "Invalid username or password<br><br>";
  }
  oci_free_statement($stmt);
  oci_close($conn);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta http-equiv="x-ua-compatible" content="ie=edge" />
  <title>Material Design for Bootstrap</title>
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />
  <!-- Google Fonts Roboto -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" />
  <!-- MDB -->
  <link rel="stylesheet" href="css/mdb.min.css" />
  <!-- Custom styles -->
  <link rel="stylesheet" href="css/style.css" />
</head>

<body>


  <!--Main Navigation-->

  <header>
    <style>
      #intro {
        background-image: url(https://mdbootstrap.com/img/new/fluid/city/008.jpg);
        height: 100vh;
      }

      /* Height for devices larger than 576px */
      @media (min-width: 992px) {
        #intro {
          margin-top: -58.59px;
        }
      }

      .navbar .nav-link {
        color: #fff !important;
      }
    </style>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark d-none d-lg-block" style="z-index: 2000;">
      <div class="container-fluid">
        <!-- Navbar brand -->

        <ul class="navbar-nav d-flex flex-row">
          <!-- Icons -->
          <li class="nav-item me-3 me-lg-0">
            <a class="nav-link" href="https://www.youtube.com/channel/UC5CF7mLQZhvx8O5GODZAhdA" rel="nofollow" target="_blank">
              <i class="fab fa-youtube"></i>
            </a>
          </li>
          <li class="nav-item me-3 me-lg-0">
            <a class="nav-link" href="https://www.facebook.com/mdbootstrap" rel="nofollow" target="_blank">
              <i class="fab fa-facebook-f"></i>
            </a>
          </li>
          <li class="nav-item me-3 me-lg-0">
            <a class="nav-link" href="https://twitter.com/MDBootstrap" rel="nofollow" target="_blank">
              <i class="fab fa-twitter"></i>
            </a>
          </li>
          <li class="nav-item me-3 me-lg-0">
            <a class="nav-link" href="https://github.com/mdbootstrap/mdb-ui-kit" rel="nofollow" target="_blank">
              <i class="fab fa-github"></i>
            </a>
          </li>
        </ul>
      </div>
      </div>
    </nav>
    <!-- Navbar -->

    <!-- Background image -->
    <div id="intro" class="bg-image shadow-2-strong">
      <div class="mask d-flex align-items-center h-100" style="background-color: rgba(0, 0, 0, 0.8);">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-xl-5 col-md-8">

              <form method="post" action="" class="bg-white rounded shadow-5-strong p-5">
                <!-- Email input -->
                <div class="form-outline mb-4">
                  <input type="text" name="username" id="form1Example1" class="form-control" />
                  <label class="form-label" for="form1Example1">USERNAME</label>
                </div>

                <!-- Password input -->
                <div class="form-outline mb-4">
                  <input type="password" name="password" id="form1Example2" class="form-control" />
                  <label class="form-label" for="form1Example2">PASSWORD</label>
                </div>

                <!-- 2 column grid layout for inline styling -->
                <div class="row mb-4">
                  <div class="col d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" value="" id="form1Example3" checked />
                      <label class="form-check-label" for="form1Example3">
                        Remember me
                      </label>
                    </div>
                  </div>

                  <div class="col text-center">
                    <!-- Simple link -->
                    <a href="../registration/userReg.php">Create Account</a>
                  </div>
                </div>

                <!-- Submit button -->
                <button name="submit1" type="submit" class="btn btn-primary btn-block">Sign in</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Background image -->
  </header>

  <!--Footer-->
  <footer class="bg-light text-lg-start">
    <hr class="m-0" />

    <div class="text-center py-4 align-items-center">
      <p>Follow US on social media</p>
      <a href="https://www.youtube.com/channel/UC5CF7mLQZhvx8O5GODZAhdA" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
        <i class="fab fa-youtube"></i>
      </a>
      <a href="https://www.facebook.com/mdbootstrap" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
        <i class="fab fa-facebook-f"></i>
      </a>
      <a href="https://twitter.com/MDBootstrap" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
        <i class="fab fa-twitter"></i>
      </a>
      <a href="https://github.com/mdbootstrap/mdb-ui-kit" class="btn btn-primary m-1" role="button" rel="nofollow" target="_blank">
        <i class="fab fa-github"></i>
      </a>
    </div>
    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2020 Copyright:
      <a class="text-dark" href="https://mdbootstrap.com/">BD Police</a>
    </div>
    <!-- Copyright -->
  </footer>
  <!--Footer-->
  <!-- MDB -->
  <script type="text/javascript" src="js/mdb.min.js"></script>
  <!-- Custom scripts -->
  <script type="text/javascript" src="js/script.js"></script>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>