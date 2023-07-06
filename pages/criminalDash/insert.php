<!-- <?php
        session_start();
        $username = $_SESSION['username'];
        // echo $username;

        ?> -->



<?php
// Oracle database connection details
// Retrieve form data
$nid = $_POST['nid'];
$first_name = $_POST['first_name'];
$middle_name = $_POST['middle_name'];
$last_name = $_POST['last_name'];
$street = $_POST['street'];
$city = $_POST['city'];
$district = $_POST['district'];
$post_code = $_POST['post_code'];
$father_name = $_POST['father_name'];
$mother_name = $_POST['mother_name'];

// Create a connection to the Oracle database
$conn = oci_connect('shohan', '123', '//localhost/XE');


if (!$conn) {
    $e = oci_error();
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}

// Prepare the insert statement
$stid = oci_parse($conn, "INSERT INTO criminal (NID, FIRST_NAME, MIDDLE_NAME, LAST_NAME, STREET, CITY, DISTRICT, POST_CODE, FATHER, MOTHER) VALUES (:nid, :first_name, :middle_name, :last_name, :street, :city, :district, :post_code, :father_name, :mother_name)");

oci_bind_by_name($stid, ':nid', $nid);
oci_bind_by_name($stid, ':first_name', $first_name);
oci_bind_by_name($stid, ':middle_name', $middle_name);
oci_bind_by_name($stid, ':last_name', $last_name);
oci_bind_by_name($stid, ':street', $street);
oci_bind_by_name($stid, ':city', $city);
oci_bind_by_name($stid, ':district', $district);
oci_bind_by_name($stid, ':post_code', $post_code);
oci_bind_by_name($stid, ':father_name', $father_name);
oci_bind_by_name($stid, ':mother_name', $mother_name);

// Execute the insert statement
$result = oci_execute($stid, OCI_COMMIT_ON_SUCCESS);

if (!$result) {
    $e = oci_error($stid);
    trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
}
$query = "INSERT INTO handles values((select sp_id
from officer natural join officeruserid where user_id=:usr),:nid)";
$stid2 = oci_parse($conn, $query);
oci_bind_by_name($stid2, ':nid', $nid);
oci_bind_by_name($stid2, ':usr', $username);
$result = oci_execute($stid2, OCI_COMMIT_ON_SUCCESS);
oci_free_statement($stid2);
oci_close($conn);

echo "Data inserted successfully!";
