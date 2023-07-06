<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <!-- <script src="js/bootstrap.min.js"></script> -->
  <script defer src="js/bootstrap.bundle.js"></script>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="#">BD POLICE</a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav ms-auto mb-2 mx-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Police Station</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Contacts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Web</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Complain</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active btn btn-primary" aria-current="page" href="pages/login/login.php">Login</a>
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
        <!-- <img src="images/carousal1.jpg" class="d-block w-100 img-fluid" alt="..."> -->
      </div>
      <div class="carousel-item carousal-img bg-img2">
        <!-- <img src="images/carousal2.jpg" class="d-block w-100 img-fluid" alt="..."> -->
      </div>
      <div class="carousel-item carousal-img bg-img3">
        <!-- <img src="images/carousal3.jpg" class="d-block w-100 img-fluid" alt="..."> -->
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

  <div class="container-fluid full-height">
    <div class="row align-items-center justify-content-center full-height">
      <div class="col-md-6">
        <form action="" method="post">
          <div class="form-group1 mb-5">
            <label for="inputField" class="mb-2">Insert</label>
            <input type="text" name="data1" class="form-control mb-2" id="inputField" placeholder="Salgrade">
            <input type="text" name="data11" class="form-control mb-2" id="inputField" placeholder="Losal">
            <input type="text" name="data12" class="form-control mb-2" id="inputField" placeholder="Hisal">
            <button type="submit" name="submit1" class="btn btn-primary">Submit</button>
          </div>
          <div class="form-group1 mb-5">
            <label for="inputField" class="mb-2">Update</label>
            <input type="text" name="data2" class="form-control mb-2" id="inputField" placeholder="Enter Old Value">
            <br>
            <input type="text" name="data21" class="form-control mb-2" id="inputField" placeholder="Enter New Value">
            <button type="submit" name="submit2" class="btn btn-primary">Submit</button>
          </div>
          <div class="form-group1 mb-5">
            <label for="inputField" class="mb-2">Delete</label>
            <input type="text" name="data3" class="form-control mb-2" id="inputField" placeholder="Enter your text">
            <button type="submit" name="submit3" class="btn btn-primary bg-danger">Submit</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- for insertion -->
  <?php
  if (isset($_POST['submit1'])) {
    $salgrade = $_POST['data1'];
    $losal = $_POST['data11'];
    $hisal = $_POST['data12'];
    $conn = oci_connect('shohan', '123', '//localhost/XE');
    // Check connection
    if (!$conn) {
      echo 'Failed to connect to oracle' . "<br>";
    } else {
      echo 'Connected successfully!' . "<br>";
    }

    //query to fetch data
    $query = "INSERT INTO SALGRADE VALUES (:val1,:val11,:val12)";
    $stid = oci_parse($conn, $query);
    if (!$stid) {
      $m = oci_error($conn);
      trigger_error('Could not parse statement: ' . $m['message'], E_USER_ERROR);
    }
    oci_bind_by_name($stid, ":val1", $salgrade);
    oci_bind_by_name($stid, ":val11", $losal);
    oci_bind_by_name($stid, ":val12", $hisal);
    if (!oci_execute($stid)) {
      $error = oci_error($stid);
      exit("Sql execution failed: " . $error['message']);
    }
    oci_free_statement($stid);
    oci_close($conn);
    echo "success" . "<br>";
  }
  ?>
  <!-- for updatation -->
  <?php
  if (isset($_POST['submit2'])) {
    $oldvalue = $_POST['data2'];
    $newvalue = $_POST['data21'];
    $conn = oci_connect('shohan', '123', '//localhost/XE');
    // Check connection
    if (!$conn) {
      echo 'Failed to connect to oracle' . "<br>";
    } else {
      echo 'Connected successfully!' . "<br>";
    }

    //query to fetch data
    $query = "update salgrade set grade=:val1 where grade=:val2";
    $stid = oci_parse($conn, $query);
    if (!$stid) {
      $m = oci_error($conn);
      trigger_error('Could not parse statement: ' . $m['message'], E_USER_ERROR);
    }
    oci_bind_by_name($stid, ":val1", $newvalue);
    oci_bind_by_name($stid, ":val2", $oldvalue);
    if (!oci_execute($stid)) {
      $error = oci_error($stid);
      exit("Sql execution failed: " . $error['message']);
    }
    oci_free_statement($stid);
    oci_close($conn);
    echo "success" . "<br>";
  }
  ?>

    <!-- for deletion -->
    <?php
  if (isset($_POST['submit3'])) {
    $x = $_POST['data3'];
    $conn = oci_connect('shohan', '123', '//localhost/XE');
    // Check connection
    if (!$conn) {
      echo 'Failed to connect to oracle' . "<br>";
    } else {
      echo 'Connected successfully!' . "<br>";
    }

    //query to fetch data
    $query = "delete from salgrade where grade=:val1";
    $stid = oci_parse($conn, $query);
    if (!$stid) {
      $m = oci_error($conn);
      trigger_error('Could not parse statement: ' . $m['message'], E_USER_ERROR);
    }
    oci_bind_by_name($stid, ":val1", $x);
    if (!oci_execute($stid)) {
      $error = oci_error($stid);
      exit("Sql execution failed: " . $error['message']);
    }
    oci_free_statement($stid);
    oci_close($conn);
    echo "success" . "<br>";
  }
  ?>

  <table>
    <tr class="table-header">
      <th>Salgrade</th>
      <th>Losal</th>
      <th>Hisal</th>
    </tr>

    <?php
    $conn = oci_connect('shohan', '123', '//localhost/XE');
    // Check connection
    if (!$conn) {
      echo 'Failed to connect to oracle' . "<br>";
    } else {
      echo 'Connected successfully!' . "<br>";
    }

    //query to fetch data
    $query = 'SELECT grade, losal, hisal FROM salgrade';
    $stid = oci_parse($conn, $query);

    if (!$stid) {
      $m = oci_error($conn);
      trigger_error('Could not parse statement: ' . $m['message'], E_USER_ERROR);
    }
    print "oci_parse executed";
    echo '<br>';

    $r = oci_execute($stid);
    if (!$r) {
      $m = oci_error($stid);
      trigger_error('Could not execute statement: ' . $m['message'], E_USER_ERROR);
    }
    print "oci executed" . "\n";
    echo '<br>';

    //retrieving data as a tuple 
    print '<table border="1">';
    while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
      print '<tr>';
      foreach ($row as $item) {
        print '<td>' . ($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp') . '</td>';
      }
      print '</tr>';
    }

    print '</table>';
    print "table end";
    oci_close($conn);

    ?>
  </table>
</body>

</html>