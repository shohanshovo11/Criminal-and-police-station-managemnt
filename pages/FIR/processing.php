<?php
session_start();
$username = $_SESSION['username'];
$serial = $_GET['job_id'];
$conn = oci_connect('shohan', '123', '//localhost/XE');
$query = 'UPDATE FIR SET FIR_STATUS =\'processing\' where FIR_NO=' . $serial . '';
$stmt = oci_parse($conn, $query);
$res = oci_execute($stmt);
oci_free_statement($stmt);
oci_close($conn);
echo "<h2>COMPLETED</h2>" . "<br>";
