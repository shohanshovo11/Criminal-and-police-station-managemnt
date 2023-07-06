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

  <form class="hello row g-3 mx-auto" method="POST">
    <div class="container mx-auto">
      <div class="col-md-6 mx-auto">
        <p>FIR Type</p>
        <div>
          <select class="form-select" aria-label="Default select example" name="selectOption">
            <option selected>Select Option</option>
            <option value="MURDER">Murder</option>
            <option value="ROBBERY">Robbery</option>
            <option value="THEIFT">Theft</option>
            <option value="CORRUPTION">Corruption</option>
            <option value="OTHERS">Others</option>
          </select>
          <br>
          <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">FIR Description</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="textarea"></textarea>
          </div>
          <br>
          <div class="col-md-12">
            <label for="inputCity" class="form-label">Suspect's Name</label>
            <input type="text" class="form-control" id="inputCity" name="accname">
          </div>
          <br>
          <div class="col-md-12">
            <label for="inputCity" class="form-label">Suspect's NID</label>
            <input type="text" class="form-control" id="inputCity" name="accnid">
          </div>
          <br>
          <div class="col-md-12">
            <label for="inputCity" class="form-label">Place</label>
            <input type="text" class="form-control" id="inputCity" name="place">
          </div>
          <br><br>
          <div class="col-12">
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
          </div>
        </div>
  </form>

  <?php
  if (isset($_POST['submit'])) {
    $selectOption = $_POST["selectOption"];
    $textarea = $_POST["textarea"];
    $accname = $_POST["accname"];
    $accnid = $_POST["accnid"];
    $place = $_POST["place"];
    if ($selectOption != null && $textarea != null && $place != null) {
      // echo "$selectOption $textarea $accname $accnid $place<br>";
      $conn = oci_connect('shohan', '123', '//localhost/XE');
      //query to fetch data
      $query = "INSERT INTO FIR VALUES (incrementseqfir.nextval, :fir_desc, :fir_type, 'initial', :accused_name, :accused_nid, :place) RETURNING FIR_NO INTO :out1";
      $out1 = "";
      $stid = oci_parse($conn, $query);
      oci_bind_by_name($stid, ":fir_desc", $textarea);
      oci_bind_by_name($stid, ":fir_type", $selectOption);
      oci_bind_by_name($stid, ":accused_name", $accname);
      oci_bind_by_name($stid, ":accused_nid", $accnid);
      oci_bind_by_name($stid, ":place", $place);
      oci_bind_by_name($stid, ":out1", $out1, 255);
      oci_execute($stid);
      // echo "<br>$out1";
      $query2 = "UPDATE CAN_MAKE SET USER_ID=:usr where fir_no=:fir";
      $stid2 = oci_parse($conn, $query2);
      oci_bind_by_name($stid2, ":usr", $username);
      oci_bind_by_name($stid2, ":fir", $out1);
      oci_execute($stid2);
      $law_id;
      if ($selectOption == "MURDER") {
        $law_id = 1;
      } else if ($selectOption == "ROBBERY") {
        $law_id = 2;
      } else if ($selectOption == "THEIFT") {
        $law_id = 3;
      } else if ($selectOption == "CORRUPTION") {
        $law_id = 4;
      } else if ($selectOption == "OTHERS") {
        $law_id = 5;
      }
      $crime_type = $selectOption;
      // echo "$crime_type $law_id<br>";
      $query3 = "INSERT INTO CRIME VALUES(incrementSeqCrime.nextval, '$law_id', '$crime_type')";
      $stmt3 = oci_parse($conn, $query3);
      oci_execute($stmt3);
      oci_free_statement($stid);
      oci_close($conn);
      echo "<br><h3>Successful</h3>" . "<br><br><br>";
    } else {
      echo "<br><h3>Insert all values.</h3><br><br><br>";
    }
  }
  ?>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>