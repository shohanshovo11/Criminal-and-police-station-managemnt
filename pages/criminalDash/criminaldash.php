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


    <div class="container-fluid full-height">
        <div class="row align-items-center justify-content-center full-height">
            <div class="col-md-6">
                <form action="" method="post">
                    <div class="form-group1 mb-5">
                        <h1>
                            <div class="text-center justify-content-center"><label for="inputField" class="mb-2">Dashboard</label></div>
                        </h1>
                        <br>
                        <h2><a class="nav-link active btn btn-primary" aria-current="page" href="../criminalDash/Criminalnid/criminalNID.php">Search Criminal</a></h2>
                        <br>
                        <br>
                        <h2><a class="nav-link active btn btn-primary" aria-current="page" href="../criminalDash/CriminalDistrict/CriminalDistrict.php">All District's Statistics</a></h2>
                        <br>
                        <br>
                        <h2><a class="nav-link active btn btn-primary" aria-current="page" href="../criminalDash/officerdistrictcriminallist/officerdistrictcriminallist.php">Serving District's Criminals</a></h2>
                        <br>
                        <br>
                        <h2><a class="nav-link active btn btn-primary" aria-current="page" href="./addCriminal.php">Add Criminal Details</a></h2>
                    </div>
                </form>

            </div>




</body>

</html>