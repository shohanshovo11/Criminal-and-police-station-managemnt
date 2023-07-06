<?php
session_start();
$username = $_SESSION['username'];
// echo $username;
?>
<!DOCTYPE html>
<html>

<head>
    <title>Expenditure Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2>Post Job</h2>
        <form action="insert_job.php" method="post">
            <div class="form-group">
                <label for="expenditure_type">Description</label>
                <input type="text-area" class="form-control" name="description" required>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>