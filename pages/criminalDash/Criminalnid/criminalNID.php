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
  <script defer src="../../../js/bootstrap.min.js"></script>

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


  <div class="container-fluid full-height">
    <div class="row align-items-center justify-content-center full-height">
      <div class="col-md-6">
        <form action="" method="post">
          <div class="form-group1 mb-5">
            <input type="text" name="data2" class="form-control mb-2" id="inputField" placeholder="Search">
            <button type="submit" name="submit2" class="btn btn-primary">Search</button>
          </div>
        </form>

        <table class="table-primary">
          <?php
          //District Search
          if (isset($_POST['submit2'])) {
            $oldvalue = $_POST['data2'];
            //echo "$oldvalue ";
            $conn = oci_connect('shohan', '123', '//localhost/XE');
            // Check connection
            if (!$conn) {
              echo 'Failed to connect to Oracle' . "<br>";
            }
            //else {
            //echo 'Connected successfully!' . "<br>";
            //}

            $viewName = 'criminalNidview'; // Specify the desired view name
            $col1 = 'Name';
            // Query the view data
            $query = "SELECT *
            FROM criminalNidview
            WHERE nid = '" . $oldvalue . "'";

            $stid = oci_parse($conn, $query);
            oci_execute($stid);

            // Display the result
            echo '<table class="table table-bordered table-striped table-hover">';
            echo '<thead class="table-primary">';
            echo '<tr>';
            echo '<th>FULL NAME</th>';
            echo '<th>NID</th>';
            echo '<th>DISTRICT</th>';
            echo '<th>FATHER\'S NAME</th>';
            echo '<th>MOTHER\'S NAME</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
              echo '<tr>';
              echo '<td>' . ($row['Full Name'] !== null ? htmlentities($row['Full Name'], ENT_QUOTES) : '&nbsp') . '</td>';
              echo '<td>' . ($row['NID'] !== null ? htmlentities($row['NID'], ENT_QUOTES) : '&nbsp') . '</td>';
              echo '<td>' . ($row['DISTRICT'] !== null ? htmlentities($row['DISTRICT'], ENT_QUOTES) : '&nbsp') . '</td>';
              echo '<td>' . ($row["Father's Name"] !== null ? htmlentities($row["Father's Name"], ENT_QUOTES) : '&nbsp') . '</td>';
              echo '<td>' . ($row["Mother's Name"] !== null ? htmlentities($row["Mother's Name"], ENT_QUOTES) : '&nbsp') . '</td>';
              echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
          }
          ?>
        </table>
      </div>

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