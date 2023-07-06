<?php
session_start();
$username=$_SESSION['username'];
$serial=$_GET['job_id'];
$conn=oci_connect('shohan','123','//localhost/XE');
$query='INSERT INTO can_apply values(:usr,:job_id)';
$stmt=oci_parse($conn,$query);
oci_bind_by_name($stmt,':usr',$username);
oci_bind_by_name($stmt,':job_id',$serial);
$res=oci_execute($stmt);
oci_free_statement($stmt);
oci_close($conn);
echo "Successfully Applied for the post." . "<br>";
?>