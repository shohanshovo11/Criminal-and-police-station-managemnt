<!-- <?php
      session_start();
      $username = $_SESSION['username'];
      // echo $username;
      ?> -->
<!doctype html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="stylesheet" href="../../../css/style.css">
  <link rel="stylesheet" href="../../../css/bootstrap.min.css">
  <link rel="stylesheet" href="fir.css">
  <!-- <script src="js/bootstrap.min.js"></script> -->
  <script defer src="../../js/bootstrap.min.js"></script>

</head>

<body class="bg-dark text-light">
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
  <br><br>
  <div class="container">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <form class="d-flex" action="" method="post">
          <input class="form-control me-2" type="text" name="src" placeholder="Search By District" aria-label="Search">
          <button class="btn btn-outline-primary" type="submit" name="submit">Search</button>
        </form>
      </div>
    </div>
  </div>

  <br><br>
  <div class="container bg-dark">
    <table class="table bg-dark">
      <?php
      if (isset($_POST["submit"])) {
        echo '<thead>
    <tr>
      <th scope="col">SERIAL</th>
      <th scope="col">STATION ID</th>
      <th scope="col">ADDRESS</th>
      <th scope="col">OFFICER NAME</th>
      <th scope="col">PHONE NUMBER</th>
    </tr>
  </thead>';
        $value = $_POST['src'];
        // echo "heelo\nasldfskajdhf\nsahdfkhasdkfjhka";
        $conn = oci_connect('shohan', '123', '//localhost/XE');
        $query = "SELECT p.station_id AS \"STATION ID\",
                           p.street || ',' || p.city || ',' || p.district AS \"ADDRESS\",
                           o.first_name || ' ' || o.middle_name || ' ' || o.last_name AS \"OFFICER NAME\",
                           p_number AS \"PHONE NUMBER\"
                    FROM officer o
                    JOIN connected_to c ON o.sp_id = c.sp_id
                    JOIN policestation p ON c.station_id = p.station_id
                    JOIN phone_num pn ON pn.sp_id = o.sp_id
                    WHERE p.district LIKE '%" . $value . "%'
                    ORDER BY p.district";


        $stmt = oci_parse($conn, $query);
        $result = oci_execute($stmt);

        if ($result) {
          $cnt = 1;
          while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
            $serial = $row['STATION ID'];
            $desc = $row['ADDRESS'];
            $type = $row['OFFICER NAME'];
            $status = $row['PHONE NUMBER'];

            // echo "$serial $desc $type $status";
            echo '
                  <tr>
                    <th scope="row">' . $cnt . '</th>
                    <td>' . $serial . '</td>
                    <td>' . $desc . '</td>
                    <td>' . $type . '</td>
                    <td>' . $status . '</td>';
            echo '</tr>';
            $cnt++;
          }
        }
      }
      ?>
    </table>
    <div>


      <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>