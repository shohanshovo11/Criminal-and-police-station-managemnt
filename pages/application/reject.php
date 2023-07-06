<?php
// Check if the P_ID parameter is present
if (isset($_GET['p_id'])) {
    // Get the P_ID value
    $p_id = $_GET['p_id'];

    // Perform the accept action based on the P_ID value
    // Replace this with your actual logic for accepting the permission

    // Example code: Update the permission status in the database
    $conn = oci_connect('shohan', '123', '//localhost/XE');
    $sql = "UPDATE PERMISSION SET P_STATUS = 'REJECTED' WHERE P_ID = :p_id";
    $stmt = oci_parse($conn, $sql);
    oci_bind_by_name($stmt, ':p_id', $p_id);
    $res = oci_execute($stmt);

    // Check if the update was successful
    if ($res) {
        echo "Permission with P_ID $p_id has been rejected.";
    } else {
        echo "Error accepting permission with P_ID $p_id.";
    }

    // Close the database connection
    oci_close($conn);
} else {
    echo "Invalid request. P_ID parameter is missing.";
}
