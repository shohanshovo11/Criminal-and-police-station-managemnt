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

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 50%;
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
    <br><br>
    <form class="hello row g-3 mx-auto" method="POST">
        <div class="container mx-auto">
            <div class="col-md-6 mx-auto">
                <p>Permission Type</p>
                <div>
                    <select class="form-select" aria-label="Default select example" name="selectOption">
                        <option selected>Select Option</option>
                        <option value="SICK LEAVE">Sick</option>
                        <option value="EMERGENCY LEAVE">Emergency</option>
                        <option value="CASUAL LEAVE">Casual Leave</option>
                        <option value="MATERNITY LEAVE">Maternity Leave</option>
                        <option value="OTHERS">Others</option>
                    </select>
                </div>
                <br>

                <p>Start Date</p>
                <div>
                    <input type="date" class="form-control" name="startDate">
                </div>
                <br>

                <p>End Date</p>
                <div>
                    <input type="date" class="form-control" name="endDate">
                </div>
                <br>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </div>
        </div>
    </form>
    <div class="container">
        <?php
        if (isset($_POST['submit'])) {
            $selectOption = $_POST["selectOption"];
            $startdate = $_POST["startDate"];
            $enddate = $_POST["endDate"];

            // Check if start date and end date are valid
            if ($selectOption != null && $startdate != null && $enddate != null) {
                $currentDate = date("Y-m-d");
                if ($startdate <= $currentDate || $enddate <= $currentDate) {
                    echo "<br><h3>Error: Start date and end date cannot be less than or equal to the current date.</h3><br><br><br>";
                } else {
                    $conn = oci_connect('shohan', '123', '//localhost/XE');

                    // Create PL/SQL block with exception handling
                    $query = "
                DECLARE
                    out1 NUMBER;
                BEGIN
                    -- Check if start date and end date are valid
                    IF TO_DATE(:startdate, 'YYYY-MM-DD') <= TRUNC(SYSDATE) OR TO_DATE(:enddate, 'YYYY-MM-DD') <= TRUNC(SYSDATE) THEN
                        raise_application_error(-20001, 'Error: Start date and end date cannot be less than or equal to the current date.');
                    ELSE
                        INSERT INTO PERMISSION (P_ID, START_DATE, END_DATE, P_TYPE, P_STATUS)
                        VALUES (incrementSeqPermission.nextval, TO_DATE(:startdate, 'YYYY-MM-DD'), TO_DATE(:enddate, 'YYYY-MM-DD'), :selectOption, 'INITIATED')
                        RETURNING P_ID INTO out1;
                        
                        INSERT INTO NEEDS (SP_ID, P_ID)
                        SELECT SP_ID, out1 FROM OFFICER NATURAL JOIN OFFICERUSERID WHERE USER_ID = :username;
                        
                        :outVar := out1;
                    END IF;
                EXCEPTION
                    WHEN OTHERS THEN
                        raise_application_error(-20001, 'Error: An error occurred while processing the request.');
                END;
            ";

                    $stid = oci_parse($conn, $query);
                    oci_bind_by_name($stid, ":startdate", $startdate);
                    oci_bind_by_name($stid, ":enddate", $enddate);
                    oci_bind_by_name($stid, ":selectOption", $selectOption);
                    oci_bind_by_name($stid, ":outVar", $outVar, 255, OCI_B_INT);
                    oci_bind_by_name($stid, ":username", $username);
                    oci_execute($stid);

                    echo "<br><h3>Successful. Generated P_ID: $outVar</h3>" . "<br><br><br>";
                }
            } else {
                echo "<br><h3>Insert all values.</h3><br><br><br>";
            }
        }
        ?>

    </div>



    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>