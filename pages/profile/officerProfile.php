<?php
session_start();
$username = $_SESSION['username'];
$conn = oci_connect('shohan', '123', '//localhost/XE');
if (!$conn) {
  echo 'Failed to connect to oracle' . "<br>";
} else {
}
if (!$conn) {
  $e = oci_error();
  die('Connection failed: ' . $e['message']);
}
$sql = "SELECT * FROM officer natural join loginOfficer WHERE userid = :usr";
$stmt = oci_parse($conn, $sql);
if (!$stmt) {
  $e = oci_error($conn);
  die('Statement preparation failed: ' . $e['message']);
}
oci_bind_by_name($stmt, ':usr', $username);
$result = oci_execute($stmt);
if (!$result) {
  $e = oci_error($stmt);
  die('Query execution failed: ' . $e['message']);
}
if ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
  $fname = $row['FIRST_NAME'];
  $mname = $row['MIDDLE_NAME'];
  $lname = $row['LAST_NAME'];
  $fdob = $row['DOB'];
  $dob = date("Y-m-d", strtotime($fdob));
  $street = $row['HOME_ADDRESS'];
  $city = $row['CITY'];
  $district = $row['DISTRICT'];
  $post_code = $row['POST_CODE'];
  $age = $row['AGE'];
  // echo "$userid $fname $mname $lname $phone $dob $street $city $district $post_code $age<br>";

}
oci_free_statement($stmt);
oci_close($conn);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../../../css/bootstrap.min.css">
  <script defer src="../../../js/bootstrap.bundle.js"></script>

</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="../loggedin/officer/officerLoggedin.php">BD POLICE</a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav ms-auto mb-2 mx-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../loggedin/officer/officerLoggedin.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../stationdetails/stationDetails.php">Your Station Details</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../criminalDash/criminaldash.php">Criminal</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../FIR/policeView.php">Complain Management</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Application
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="../application/create.php">Create Application</a>
              <a class="dropdown-item" href="../application/view.php">Your Application</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link active btn btn-primary" aria-current="page" href="../profile/officerProfile.php"><?php echo "$username" ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active btn btn-danger" aria-current="page" href="../../index.php"><?php echo "Logout" ?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-fluid bg-dark text-white">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <form class="needs-validation" novalidate method="post">
          <div class="form-row">
            <div class="col-md-8 mb-3 mx-auto">
              <label for="validationCustom01">First name</label>
              <input type="text" name="fnamefield" class="form-control" id="validationCustom01" placeholder="First name" value="<?php echo $fname; ?>" required>
            </div>
            <div class="col-md-8 mb-3 mx-auto">
              <label for="validationCustom01">Middle name</label>
              <input type="text" name="mnamefield" class="form-control" id="validationCustom01" placeholder="Middle name" value="<?php echo $mname; ?>" required>
            </div>
            <div class="col-md-8 mb-3 mx-auto">
              <label for="validationCustom02">Last name</label>
              <input type="text" name="lnamefield" class="form-control" id="validationCustom02" placeholder="Last name" value="<?php echo $lname; ?>" required>
            </div>
            <div class="col-md-8 mb-3 mx-auto">
              <label for="validationCustomDate">Date Of Birth</label>
              <br>
              <input type="date" name="datefield" value="<?php echo $dob; ?>">
            </div>
            <div class="col-md-8 mb-3 mx-auto">
              <label for="validationCustonAge">Age</label>
              <input type="text" class="form-control" id="validationCustom02" placeholder="Age" value="<?php echo $age; ?>" readonly>
            </div>
            <div class="col-md-8 mb-3 mx-auto">
              <label for="validationCustomUsername">User ID</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text" id="inputGroupPrepend">@</span>
                </div>
                <input type="text" name="useridfield" class="form-control" id="validationCustomUsername" placeholder="Username" aria-describedby="inputGroupPrepend" value="<?php echo $username; ?>" readonly required>
              </div>
            </div>
            <div class="col-md-8 mb-3 mx-auto">
              <label for="validationCustomStreet">Street</label>
              <input type="text" name="streetfield" class="form-control" id="validationCustomStreet" placeholder="Street" value="<?php echo $street; ?>" required>
            </div>
            <div class="col-md-8 mb-3 mx-auto">
              <label for="validationCustom03">City</label>
              <input type="text" name="cityfield" class="form-control" id="validationCustom03" placeholder="City" value="<?php echo $city; ?>" required>
            </div>
            <div class="col-md-8 mb-3 mx-auto">
              <label for="validationCustom04">District</label>
              <input type="text" name="districtfield" class="form-control" id="validationCustom04" placeholder="District" value="<?php echo $district; ?>" required>
            </div>
            <div class="col-md-8 mb-3 mx-auto">
              <label for="validationCustom05">Post Code</label>
              <input type="text" name="postcodefield" class="form-control" id="validationCustom05" placeholder="Post Code" value="<?php echo $post_code; ?>" required>
            </div>
            <div class="col-md-8 mb-3 mx-auto">
              <button class="btn btn-primary" type="submit" name="submit">Update</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  // echo "Run<br>";
  if (isset($_POST['submit'])) {
    $nfname = $_POST['fnamefield'];
    $nmname = $_POST['mnamefield'];
    $nlname = $_POST['lnamefield'];
    $ndob = $_POST['datefield'];
    $nuserid = $_POST['useridfield'];
    $nstreet = $_POST['streetfield'];
    $ncity = $_POST['cityfield'];
    $ndistrict = $_POST['districtfield'];
    $npost = $_POST['postcodefield'];
    $conn = oci_connect('shohan', '123', '//localhost/XE');
    // Check connection
    if (!$conn) {
      echo 'Failed to connect to oracle' . "<br>";
    }

    //query to fetch data
    $query = "update officer set first_name=:val2 ,middle_name=:val3,last_name=:val4,dob=to_date(:val6,'yyyy-mm-dd'),home_address=:val7,city=:val8,district=:val9,post_code=:val10 where sp_id=(select o.sp_id from officer o 
    join officeruserid c
    on o.sp_id=c.sp_id
    where c.user_id=:usr)";
    $stid = oci_parse($conn, $query);
    if (!$stid) {
      $m = oci_error($conn);
      trigger_error('Could not parse statement: ' . $m['message'], E_USER_ERROR);
    }
    oci_bind_by_name($stid, ":val2", $nfname);
    oci_bind_by_name($stid, ":val3", $nmname);
    oci_bind_by_name($stid, ":val4", $nlname);
    oci_bind_by_name($stid, ":val6", $ndob);
    oci_bind_by_name($stid, ":val7", $nstreet);
    oci_bind_by_name($stid, ":val8", $ncity);
    oci_bind_by_name($stid, ":val9", $ndistrict);
    oci_bind_by_name($stid, ":val10", $npost);
    oci_bind_by_name($stid, ":usr", $username);
    if (!oci_execute($stid)) {
      $error = oci_error($stid);
      exit("Sql execution failed: " . $error['message']);
    }
    oci_free_statement($stid);
    oci_close($conn);
    // echo "success" . "<br>";
    $_SESSION['username'] = $nuserid;
  }
  ?>

  <script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
      'use strict';
      window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
          form.addEventListener('submit', function(event) {
            if (form.checkValidity() === false) {
              event.preventDefault();
              event.stopPropagation();
            }
            form.classList.add('was-validated');
          }, false);
        });
      }, false);
    })();
  </script>
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>

</html>