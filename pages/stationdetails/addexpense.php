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
        <h2>Expenditure Form</h2>
        <form action="insertExpense.php" method="post">
            <div class="form-group">
                <label for="expenditure_type">Expenditure Type:</label>
                <input type="text" class="form-control" name="expenditure_type" required>
            </div>

            <div class="form-group">
                <label for="expenditure_date">Expenditure Date:</label>
                <input type="date" class="form-control" name="expenditure_date" required>
            </div>

            <div class="form-group">
                <label for="expenditure_amount">Expenditure Amount:</label>
                <input type="number" class="form-control" name="expenditure_amount" step="0.01" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>