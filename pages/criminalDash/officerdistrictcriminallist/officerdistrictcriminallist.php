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
            <h1><label for="inputField" class="mb-2">District Information</label>
              <h1>
          </div>

          <table>

            <?php

            //District Print
            //echo "$oldvalue";
            $conn = oci_connect('shohan', '123', '//localhost/XE');
            // Check connection
            if (!$conn) {
              echo 'Failed to connect to Oracle' . "<br>";
            }
            //else {
            // echo 'Connected successfully!' . "<br>";
            //}

            //if ($createViewResult) {
            //  echo "View '$viewName' created successfully!" . "<br>";
            //} else {
            //  $m = oci_error($createViewStatement);
            // echo 'Failed to create view: ' . $m['message'] . "<br>";
            //}

            // Query the view data
            $query = "SELECT o.first_name||' '||o.middle_name||' '||o.last_name,c.first_name||' '||c.middle_name||' '||c.last_name,c.nid,c.father,c.mother,c.street||','||c.city||','||c.district 
            from login l
            inner join officeruserid ofc
            on l.userid=ofc.user_id
            inner join officer o
            on ofc.sp_id=o.sp_id
            inner join handles h 
            on o.sp_id=h.sp_id  
            inner join criminal c
            on h.nid=c.nid
            where o.district=c.district
            ";
            $stid = oci_parse($conn, $query);

            // Define the column variables
            //oci_define_by_name($stid, 'DISTRICT', $district);
            //oci_define_by_name($stid, 'nid', $criminal);

            oci_execute($stid);

            // Display the result
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-striped table-hover">';
            echo '<thead class="table-primary">';
            echo '<tr>';
            echo '<th scope="col" class="fw-bold">Officer</th>';
            echo '<th scope="col" class="fw-bold">Criminal Name</th>';
            echo '<th scope="col" class="fw-bold">NID</th>';
            echo '<th scope="col" class="fw-bold">Father\'s Name</th>';
            echo '<th scope="col" class="fw-bold">Mother\'s Name</th>';
            echo '<th scope="col" class="fw-bold">Address</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';

            while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
              print '<tr>';
              foreach ($row as $item) {
                print '<td>' . ($item !== null ? htmlentities($item, ENT_QUOTES) : '&nbsp') . '</td>';
              }
              print '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo '</div>';

            oci_close($conn);



            ?>
          </table>
      </div>




</body>

</html>