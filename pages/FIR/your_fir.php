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

    <table class="table">
      <thead>
        <tr>
          <th scope="col">Serial</th>
          <th scope="col">FIR Tag</th>
          <th scope="col">FIR Desc.</th>
          <th scope="col">FIR Type</th>
          <th scope="col">FIR Status</th>
          <th scope="col">Accused Name</th>
          <th scope="col">Accused NID</th>
          <th scope="col">Place</th>
          <th scope="col">Date</th>
        </tr>
      </thead>
      <?php
      $conn = oci_connect('shohan', '123', '//localhost/XE');
      $query = "select * from fir natural join can_make where user_id=:usr order by fir_date desc";

      $stmt = oci_parse($conn, $query);
      oci_bind_by_name($stmt, ":usr", $username);

      $result = oci_execute($stmt);

      if ($result) {
        $cnt = 1;
        while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
          $serial = $row['FIR_NO'];
          $desc = $row['FIR_DESC'];
          $type = $row['FIR_TYPE'];
          $status = $row['FIR_STATUS'];
          $acc_name = $row['ACCUSED_NAME'];
          $acc_nid = $row['ACCUSED_NID'];
          $place = $row['PLACE'];
          $date = $row['FIR_DATE'];

          // echo "$serial $desc $status";
          echo '
                    <tr>
                      <th scope="row">' . $cnt . '</th>
                      <td>#' . $serial . '</td>
                      <td>' . $desc . '</td>
                      <td>' . $type . '</td>
                      <td>' . $status . '</td>
                      <td>' . $acc_name . '</td>
                      <td>' . $acc_nid . '</td>
                      <td>' . $place . '</td>
                      <td>' . $date . '</td>';
          echo '</tr>';
          $cnt++;
        }
      }
      ?>
    </table>

    <div>
      <?php
      $conn = oci_connect('shohan', '123', '//localhost/XE');
      $query = "SELECT user_id || ' has total ' || COUNT(*) || ' FIR in initial stage.' AS \"Total initiated FIR\"
          FROM userdb NATURAL JOIN can_make NATURAL JOIN fir
          WHERE fir_status = 'initial' AND user_id = :usr
          GROUP BY user_id, fir_status";

      $stmt = oci_parse($conn, $query);
      oci_bind_by_name($stmt, ":usr", $username);
      $result = oci_execute($stmt);

      if ($result) {
        $row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC);
        $str = $row['Total initiated FIR'];

        if (isset($str)) {
          echo "<br><h2>$str</h2><br>";
        }
      }
      ?>
      <?php
      $conn = oci_connect('shohan', '123', '//localhost/XE');
      $query = "SELECT user_id || ' has total ' || COUNT(*) || ' FIR in Processing stage.' AS \"Total processing FIR\"
          FROM userdb NATURAL JOIN can_make NATURAL JOIN fir
          WHERE fir_status = 'processing' AND user_id = :usr
          GROUP BY user_id, fir_status";

      $stmt = oci_parse($conn, $query);
      oci_bind_by_name($stmt, ":usr", $username);
      $result = oci_execute($stmt);

      if ($result) {
        if ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
          $str = $row['Total processing FIR'];

          if (isset($str)) {
            echo "<h2>$str</h2><br>";
          }
        } else {
          echo "No FIR in Processing state.<br>";
        }
      } else {
        $error = oci_error($stmt);
        echo "Error: " . $error['message'] . "<br>";
      }
      ?>

      <?php
      $conn = oci_connect('shohan', '123', '//localhost/XE');
      $query = "SELECT user_id || ' has total ' || COUNT(*) || ' FIR in Completed stage.' AS \"Total completed FIR\"
          FROM userdb NATURAL JOIN can_make NATURAL JOIN fir
          WHERE fir_status = 'completed' AND user_id = :usr
          GROUP BY user_id, fir_status";

      $stmt = oci_parse($conn, $query);
      oci_bind_by_name($stmt, ":usr", $username);
      $result = oci_execute($stmt);

      if ($result) {
        if ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
          $str = $row['Total completed FIR'];

          if (isset($str)) {
            echo "<h2>$str</h2><br>";
          }
        } else {
          echo "No FIR in Completed state.<br>";
        }
      } else {
        $error = oci_error($stmt);
        echo "Error: " . $error['message'] . "<br>";
      }
      ?>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>