<?php
session_start();
$username = $_SESSION['username'];
// echo $username;
?>
<?php
// Oracle database connection details

// Retrieve form data
$desc = $_POST['description'];

// Create a connection to the Oracle database
$conn = oci_connect('shohan', '123', '//localhost/XE');

if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Prepare the insert statement
$stid = oci_parse($conn, "INSERT INTO jobs VALUES (incrementSeqJob.nextval, 'V', :description)");

oci_bind_by_name($stid, ':description', $desc);
// Execute the insert statement
$result = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);

if (!$result) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

oci_free_statement($stid);
oci_close($conn);

echo "Data inserted successfully!";
