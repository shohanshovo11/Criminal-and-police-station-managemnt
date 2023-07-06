<?php
$data1 = filter_input(INPUT_POST, 'data1');
echo $data1;
if (!empty($data1)){
    $host = "localhost";
    $dbdata1 = "root";
    $dbpassword = "";
    $dbname = "phpmyadmin";
// Create connection
    $conn = new mysqli ($host, $dbdata1, $dbpassword, $dbname);
  

    if (mysqli_connect_error()){
        die('Connect Error ('. mysqli_connect_errno() .') '
        . mysqli_connect_error());
    }
    else{
        $sql = "INSERT INTO vugichugi (input)
        values ('$data1')";
        if ($conn->query($sql)){
        echo "New record is inserted sucessfully";
        }
        else{
            echo "Error: ". $sql ."
            ". $conn->error;
        }
        $conn->close();
    }
}
else{
echo "data1 should not be empty";
die();
}
?>