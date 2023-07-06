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

  <link rel="stylesheet" href="../../css/style.css">
  <link rel="stylesheet" href="../../css/bootstrap.min.css">
  <!-- <script src="js/bootstrap.min.js"></script> -->
  <script defer src="../../js/bootstrap.min.js"></script>

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
            <a class="nav-link active" aria-current="page" href="../SearchOfficer/searchofficer.php">Officer Information</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Web</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Complain</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active btn btn-primary" aria-current="page" href="../../profile/userProfile.php"><?php echo "$username" ?></a>
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
            <label for="inputField" class="mb-2">Search Police Officers Information</label>
            <input type="text" name="data12" class="form-control mb-2" id="inputField" placeholder="Search By Name">
            <button type="submit" name="submit1" class="btn btn-primary">Search</button>
          </div>
        </form>
        <form action="" method="post">
          <div class="form-group1 mb-5">
            <input type="text" name="data2" class="form-control mb-2" id="inputField" placeholder="Search By District">
            <button type="submit" name="submit2" class="btn btn-primary">Search</button>
          </div>
        </form>

        <table class="table-primary">

          <?php

          //Name Search
          if (isset($_POST['submit1'])) {
            $oldvalue = $_POST['data12'];
            //echo "$oldvalue";
            $conn = oci_connect('shohan', '123', '//localhost/XE');
            // Check connection
            if (!$conn) {
              echo 'Failed to connect to Oracle' . "<br>";
            }
            //else {
            // echo 'Connected successfully!' . "<br>";
            //}

            // Drop the existing view if it exists
            $existingView = 'OfficerView'; // Specify the existing view name
            $dropViewQuery = "DROP VIEW $existingView";
            $dropViewStatement = oci_parse($conn, $dropViewQuery);
            $dropViewResult = oci_execute($dropViewStatement);

            // Create the view
            $viewName = 'OfficerView'; // Specify the desired view name
            $col1 = 'Name';

            $createViewQuery = "CREATE VIEW $viewName AS SELECT first_name||' '||middle_name||' '||last_name as \"$col1\", Age, District FROM officer";
            $createViewStatement = oci_parse($conn, $createViewQuery);
            $createViewResult = oci_execute($createViewStatement);

            //if ($createViewResult) {
            //  echo "View '$viewName' created successfully!" . "<br>";
            //} else {
            //  $m = oci_error($createViewStatement);
            // echo 'Failed to create view: ' . $m['message'] . "<br>";
            //}

            // Query the view data
            $query = "SELECT \"$col1\", Age, District FROM $viewName WHERE \"$col1\" LIKE '%' || :oldvalue || '%'";
            $stid = oci_parse($conn, $query);
            oci_bind_by_name($stid, ':oldvalue', $oldvalue);

            // Define the column variables
            oci_define_by_name($stid, $col1, $name);
            oci_define_by_name($stid, 'AGE', $age);
            oci_define_by_name($stid, 'DISTRICT', $district);

            oci_execute($stid);

            // Display the result
            echo '<div class="table-responsive">';
            echo '<table class="table table-bordered table-striped table-hover">';
            echo '<thead class="table-primary">';
            echo '<tr>';
            echo '<th scope="col" class="fw-bold">Name</th>';
            echo '<th scope="col" class="fw-bold">Age</th>';
            echo '<th scope="col" class="fw-bold">District</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
                echo '<tr>';
                echo '<td>' . ($name !== null ? htmlentities($name, ENT_QUOTES) : '&nbsp;') . '</td>';
                echo '<td>' . ($age !== null ? htmlentities($age, ENT_QUOTES) : '&nbsp;') . '</td>';
                echo '<td>' . ($district !== null ? htmlentities($district, ENT_QUOTES) : '&nbsp;') . '</td>';
                echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            

            oci_close($conn);
          }


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

            // Drop the existing view if it exists
            $existingView = 'OfficerView'; // Specify the existing view name
            $dropViewQuery = "DROP VIEW $existingView";
            $dropViewStatement = oci_parse($conn, $dropViewQuery);
            $dropViewResult = oci_execute($dropViewStatement);

            // Create the view
            $viewName = 'OfficerView'; // Specify the desired view name
            $col1 = 'Name';
            $createViewQuery = "CREATE VIEW $viewName AS SELECT first_name||' '||middle_name||' '||last_name as \"$col1\", Age, District FROM officer";
            $createViewStatement = oci_parse($conn, $createViewQuery);
            $createViewResult = oci_execute($createViewStatement);

            //if ($createViewResult) {
            //  echo "View '$viewName' created successfully!" . "<br>";
            //} else {
            //$m = oci_error($createViewStatement);
            //echo 'Failed to create view: ' . $m['message'] . "<br>";
            //}

            // Query the view data
            $query = "SELECT District, \"$col1\", Age FROM $viewName WHERE District LIKE '%' || :oldvalue || '%'";
            $stid = oci_parse($conn, $query);
            oci_bind_by_name($stid, ':oldvalue', $oldvalue);

            // Define the column variables
            oci_define_by_name($stid, 'DISTRICT', $district);
            oci_define_by_name($stid, $col1, $name);
            oci_define_by_name($stid, 'AGE', $age);

            oci_execute($stid);

            // Display the result
            echo '<table class="table table-bordered table-striped table-hover">';
            echo '<thead class="table-primary">';
            echo '<tr>';
            echo '<th>District</th>';
            echo '<th>Name</th>';
            echo '<th>Age</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
              echo '<tr>';
              echo '<td>' . ($district !== null ? htmlentities($district, ENT_QUOTES) : '&nbsp') . '</td>';
              echo '<td>' . ($name !== null ? htmlentities($name, ENT_QUOTES) : '&nbsp') . '</td>';
              echo '<td>' . ($age !== null ? htmlentities($age, ENT_QUOTES) : '&nbsp') . '</td>';
              echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table>';
            
            // Count the number of police officers for each district
            $countQuery = "SELECT District, COUNT(*) AS OfficerCount FROM $viewName GROUP BY District";
            $countStatement = oci_parse($conn, $countQuery);
            oci_execute($countStatement);
            
            echo '<br>';
            echo '<table class="table table-bordered table-striped table-responsive">';
            echo '<thead class="table-primary">';
            echo '<tr>';
            echo '<th>District</th>';
            echo '<th>Officer Count</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            while ($row = oci_fetch_array($countStatement, OCI_RETURN_NULLS + OCI_ASSOC)) {
              $districtName = isset($row['DISTRICT']) ? htmlentities($row['DISTRICT'], ENT_QUOTES) : 'Unknown District';
              $officerCount = isset($row['OFFICERCOUNT']) ? htmlentities($row['OFFICERCOUNT'], ENT_QUOTES) : 0;
            
              echo '<tr>';
              echo "<td>$districtName</td>";
              echo "<td>$officerCount</td>";
              echo '</tr>';
            }
            
            echo '</tbody>';
            echo '</table>';
            
            oci_close($conn);
            
          }
          ?>
        </table>
      </div>




</body>

</html>