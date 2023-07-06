<?php
session_start();
$username = $_SESSION['username'];
// echo $username;
?>
<?php
// Oracle database connection details

// Retrieve form data
$expenditure_type = $_POST['expenditure_type'];
$expenditure_date = $_POST['expenditure_date'];
$expenditure_amount = $_POST['expenditure_amount'];

// Create a connection to the Oracle database
$conn = oci_connect('shohan', '123', '//localhost/XE');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Prepare the insert statement
$stid = oci_parse($conn, "INSERT INTO expenditure (STATION_ID, E_TYPE, E_DATE, E_AMOUNT) VALUES ((select station_id 
from officer o join officeruserid ofc
on o.sp_id=ofc.sp_id
join connected_to c
on c.sp_id=o.sp_id where user_id=:usr), :expenditure_type, TO_DATE(:expenditure_date, 'YYYY-MM-DD'), :expenditure_amount)");

oci_bind_by_name($stid, ':expenditure_type', $expenditure_type);
oci_bind_by_name($stid, ':expenditure_date', $expenditure_date);
oci_bind_by_name($stid, ':expenditure_amount', $expenditure_amount);
oci_bind_by_name($stid, ':usr', $username);

// Execute the insert statement
$result = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);

if (!$result) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

oci_free_statement($stid);
oci_close($conn);

echo "Data inserted successfully!";
