<?php
session_start();
$username = $_SESSION['username'];
// echo $username;
?>
<!doctype html>
<html lang="en">

<head>
    <style>
        body,
        html {
            margin: 0;
            padding: 0;
            height: 100%;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f5f5f5;
        }

        .text {
            font-size: 30px;
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .button {
            padding: 12px 24px;
            background-color: #007bff;
            color: #fff;
            font-size: 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
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



    <div class="container">
        <div class="text text-center">
            <br>
            <?php
            $conn = oci_connect('shohan', '123', '//localhost/XE');
            $query = "select count(*) \"Total Officer\"
            from policestation p
            natural join connected_to 
            join officer 
            on connected_to.sp_id=officer.sp_id
            where station_id=(
        select p.station_id from login l
        join officeruserid o
        on l.userid=o.user_id
        join officer
        on o.sp_id=officer.sp_id
        join connected_to co
        on co.sp_id=officer.sp_id
        join policeStation p
        on co.station_id=p.station_id
        where o.user_id=:usr)";


            $stmt = oci_parse($conn, $query);
            oci_bind_by_name($stmt, ":usr", $username);
            $result = oci_execute($stmt);
            if ($result) {
                if ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                    $str = $row['Total Officer'];

                    if (isset($str)) {
                        echo "<h2>Total $str Officer in your station</h2><br>";
                    }
                } else {
                    echo "No Officer<br>";
                }
            } else {
                $error = oci_error($stmt);
                echo "Error: " . $error['message'] . "<br>";
            }
            ?>
        </div>
        <div class="table">
            <!-- select o.sp_id,first_name||' '||middle_name||' '||last_name as "Name",
p_number
from officer o 
join connected_to c
on o.sp_id=c.sp_id
join phone_num
on phone_num.sp_id=o.sp_id
where c.station_id=(
select p.station_id from login l
join officeruserid o
on l.userid=o.user_id
join officer
on o.sp_id=officer.sp_id
join connected_to co
on co.sp_id=officer.sp_id
join policeStation p
on co.station_id=p.station_id
where o.user_id='tonoy'); -->

            <?php

            $conn = oci_connect('shohan', '123', '//localhost/XE');
            // Check connection
            if (!$conn) {
                echo 'Failed to connect to Oracle' . "<br>";
            }
            //else {
            //echo 'Connected successfully!' . "<br>";
            //}

            // Query the view data
            $query = "select o.sp_id \"SP ID\",first_name||' '||middle_name||' '||last_name as \"Name\",
p_number \"Phone Number\"
from officer o 
join connected_to c
on o.sp_id=c.sp_id
full join phone_num
on phone_num.sp_id=o.sp_id
where c.station_id=(
select p.station_id from login l
join officeruserid o
on l.userid=o.user_id
join officer
on o.sp_id=officer.sp_id
join connected_to co
on co.sp_id=officer.sp_id
join policeStation p
on co.station_id=p.station_id
where o.user_id=:usr)";
            $stid = oci_parse($conn, $query);
            oci_bind_by_name($stid, ':usr', $username);
            // Define the column variables
            oci_define_by_name($stid, 'SP ID', $sp_id);
            oci_define_by_name($stid, 'Name', $name);
            oci_define_by_name($stid, 'Phone Number', $phone);
            oci_execute($stid);
            // Display the result
            echo '<table class="table table-bordered table-striped table-hover">';
            echo '<thead class="table-primary">';
            echo '<tr>';
            echo '<th>SP ID</th>';
            echo '<th>NAME</th>';
            echo '<th>PHONE NUMBER</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
                echo '<tr>';
                echo '<td>' . ($sp_id !== null ? htmlentities($sp_id, ENT_QUOTES) : '&nbsp') . '</td>';
                echo '<td>' . ($name !== null ? htmlentities($name, ENT_QUOTES) : '&nbsp') . '</td>';
                echo '<td>' . ($phone !== null ? htmlentities($phone, ENT_QUOTES) : '&nbsp') . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            oci_close($conn);
            ?>
        </div>
        <br><br>
        <h2 class="text-center">Your Station's Expenditure Of This Month:</h2>
        <div class="table">
            <?php
            $conn = oci_connect('shohan', '123', '//localhost/XE');
            if (!$conn) {
                echo 'Failed to connect to Oracle' . "<br>";
            }
            // Query the view data
            $query = "select * from expenditure natural join policeStation 
            where station_id=(
            select p.station_id from login l
            join officeruserid o
            on l.userid=o.user_id
            join officer
            on o.sp_id=officer.sp_id
            join connected_to co
            on co.sp_id=officer.sp_id
            join policeStation p
            on co.station_id=p.station_id
            where o.user_id=:usr)and EXTRACT(MONTH FROM e_date)=(SELECT EXTRACT(MONTH FROM SYSDATE) FROM dual)";
            $stid = oci_parse($conn, $query);
            oci_bind_by_name($stid, ':usr', $username);
            echo "<br><br>";
            oci_execute($stid);
            // Display the result
            echo '<table class="table table-bordered table-striped table-hover">';
            echo '<thead class="table-primary">';
            echo '<tr>';
            echo '<th>EXPENDITURE DATE</th>';
            echo '<th>EXPENDITURE TYPE</th>';
            echo '<th>EXPENDITURE AMOUNT</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS + OCI_ASSOC)) {
                echo '<tr>';
                echo '<td>' . ($row['E_DATE'] !== null ? htmlentities($row['E_DATE'], ENT_QUOTES) : '&nbsp') . '</td>';
                echo '<td>' . ($row['E_TYPE'] !== null ? htmlentities($row['E_TYPE'], ENT_QUOTES) : '&nbsp') . '</td>';
                echo '<td>' . ($row['E_AMOUNT'] !== null ? htmlentities($row['E_AMOUNT'], ENT_QUOTES) : '&nbsp') . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            $query2 = "select sum(e_amount) as \"total\" from expenditure natural join policeStation 
            where station_id=(
            select p.station_id from login l
            join officeruserid o
            on l.userid=o.user_id
            join officer
            on o.sp_id=officer.sp_id
            join connected_to co
            on co.sp_id=officer.sp_id
            join policeStation p
            on co.station_id=p.station_id
            where o.user_id=:usr)and EXTRACT(MONTH FROM e_date)=(SELECT EXTRACT(MONTH FROM SYSDATE) FROM dual)";
            $stid = oci_parse($conn, $query2);
            oci_bind_by_name($stid, ':usr', $username);
            oci_execute($stid);
            $row = oci_fetch_assoc($stid);
            // Access the fetched row values
            if ($row) {
                $total = $row['total'];
            }
            echo "<h2>Total : $total</h2>";
            oci_close($conn);
            ?>
        </div>
        <h2>Add Expense</h2>
        <a href="addexpense.php" class="btn btn-primary">Add Expense</a>
        <br><br>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>