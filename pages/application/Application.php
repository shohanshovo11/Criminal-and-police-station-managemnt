<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Admin Dashboard</title>
    <style>
        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <br><br>
        <h2>All Applications:</h2>
        <br>
        <?php
        $conn = oci_connect('shohan', '123', '//localhost/XE');
        $sql = "SELECT O.SP_ID, FIRST_NAME || ' ' || MIDDLE_NAME || ' ' || LAST_NAME AS \"NAME\",
        TO_CHAR(START_DATE, 'DD-MM-YYYY') AS \"START DATE\", TO_CHAR(END_DATE, 'DD-MM-YYYY') AS \"END DATE\",
        P_TYPE AS \"PERMISSION TYPE\", P_STATUS AS \"PERMISSION STATUS\", P.P_ID
        FROM OFFICER O
        JOIN OFFICERUSERID OFC ON O.SP_ID = OFC.SP_ID
        JOIN NEEDS N ON O.SP_ID = N.SP_ID
        JOIN PERMISSION P ON P.P_ID = N.P_ID WHERE P_STATUS='INITIATED'";

        $stmt = oci_parse($conn, $sql);
        $res = oci_execute($stmt);

        echo '<tr>';
        echo '<div class="table-responsive">';
        echo '<table class="table table-bordered table-striped table-hover">';
        echo '<thead class="table-primary">';
        echo '<tr>';
        echo '<th scope="col" class="fw-bold">SP ID</th>';
        echo '<th scope="col" class="fw-bold">NAME</th>';
        echo '<th scope="col" class="fw-bold">START DATE</th>';
        echo '<th scope="col" class="fw-bold">END DATE</th>';
        echo '<th scope="col" class="fw-bold">PERMISSION TYPE</th>';
        echo '<th scope="col" class="fw-bold">PERMISSION STATUS</th>';
        echo '<th scope="col" class="fw-bold">ACTION</th>'; // Add a new column for action buttons
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        if ($res) {
            while ($row = oci_fetch_array($stmt, OCI_RETURN_NULLS + OCI_ASSOC)) {
                echo '<td>' . ($row['SP_ID'] !== null ? htmlentities($row['SP_ID'], ENT_QUOTES) : '&nbsp;') . '</td>';
                echo '<td>' . ($row['NAME'] !== null ? htmlentities($row['NAME'], ENT_QUOTES) : '&nbsp;') . '</td>';
                echo '<td>' . ($row['START DATE'] !== null ? htmlentities($row['START DATE'], ENT_QUOTES) : '&nbsp;') . '</td>';
                echo '<td>' . ($row['END DATE'] !== null ? htmlentities($row['END DATE'], ENT_QUOTES) : '&nbsp;') . '</td>';
                echo '<td>' . ($row['PERMISSION TYPE'] !== null ? htmlentities($row['PERMISSION TYPE'], ENT_QUOTES) : '&nbsp;') . '</td>';
                echo '<td>' . ($row['PERMISSION STATUS'] !== null ? htmlentities($row['PERMISSION STATUS'], ENT_QUOTES) : '&nbsp;') . '</td>';
                echo '<td>';
                echo '<a class="text-decoration none" href="accept.php?p_id=' . $row['P_ID'] . '"><button class="btn btn-success">Accept</button> </a>'; // Redirect to accept.php with P_ID parameter
                echo '<a class="text-decoration none" href="reject.php?p_id=' . $row['P_ID'] . '"><button class="btn btn-danger">Reject</button> </a>'; // Redirect to reject.php with P_ID parameter
                echo '</td>';
                echo '</tr>';
            }

            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            oci_close($conn);
        } else {
            echo "No Application found.<br>";
        }
        ?>



    </div>

</body>

</html>