<?php
session_start();
$username = $_SESSION['username'];
// echo $username;
?>
<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../../../css/bootstrap.min.css">
  <!-- <script src="js/bootstrap.min.js"></script> -->
  <script defer src="../../../js/bootstrap.bundle.js"></script>

</head>

<style>
  .table {
    font-size: 1.2rem;
  }
</style>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="../loggedin/general_user/loggedin_user.php">BD POLICE</a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav ms-auto mb-2 mx-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../loggedin/general_user/loggedin_user.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../policeStation/policeStation.php">Police Station</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="../SearchOfficer/searchofficer.php">Officer Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Web</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Complain
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="../FIR/fir.php">Create FIR</a>
              <a class="dropdown-item" href="../FIR/your_fir.php">Your FIR</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link active btn btn-primary" aria-current="page" href="../profile/userProfile.php"><?php echo "$username" ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link active btn btn-danger" aria-current="page" href="../../index.php"><?php echo "Logout" ?></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div class="container">
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">Serial</th>
          <th scope="col">Description</th>
          <th scope="col">Your Status</th>
        </tr>
      </thead>
      <?php
      $conn = oci_connect('shohan', '123', '//localhost/XE');
      $query = "select * from jobs";
      $query2 = "select * from can_apply";

      $stmt = oci_parse($conn, $query);
      $result = oci_execute($stmt);

      $stmt2 = oci_parse($conn, $query2);
      $result2 = oci_execute($stmt2);
      $applied_job;

      if ($result2) {
        while ($row2 = oci_fetch_array($stmt2, OCI_RETURN_NULLS + OCI_ASSOC)) {
          $user = $row2['USER_ID'];
          $job_id = $row2['JOB_ID'];
          if ($user == $username) {
            $applied_job[$job_id] = $user;
          }
        }
      }

      if ($result) {
        $sr = 1;
        while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
          $serial = $row['JOB_ID'];
          $desc = $row['DESCRIP'];
          $status = $row['STATUS'];
          // echo "$serial $desc $status";
          echo '
                    <tr>
                      <th scope="row">' . $sr . '</th>
                      <td>' . $desc . '</td>';
          $sr++;
          if (isset($serial) && isset($applied_job[$serial])) {
            echo '<td><button class="btn btn-primary"><a href="#" class="text-light text-decoration-none">Applied</a></button</td>';
          } else {
            echo '<td><button class="btn btn-primary"><a href="applied.php?job_id=' . $serial . '" class="text-light text-decoration-none">Apply</a></button</td>';
          }
          echo '</tr>';
        }
      }
      ?>
    </table>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>