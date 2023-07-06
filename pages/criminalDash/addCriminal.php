<!DOCTYPE html>
<html>

<head>
    <title>Criminal Information Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <h2 class="mt-4">Criminal Information Form</h2>
        <form action="insert.php" method="post">
            <div class="form-group">
                <label for="nid">NID:</label>
                <input type="text" class="form-control" name="nid" required>
            </div>

            <div class="form-group">
                <label for="first_name">First Name:</label>
                <input type="text" class="form-control" name="first_name" required>
            </div>

            <div class="form-group">
                <label for="middle_name">Middle Name:</label>
                <input type="text" class="form-control" name="middle_name">
            </div>

            <div class="form-group">
                <label for="last_name">Last Name:</label>
                <input type="text" class="form-control" name="last_name" required>
            </div>

            <div class="form-group">
                <label for="street">Street:</label>
                <input type="text" class="form-control" name="street" required>
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" class="form-control" name="city" required>
            </div>

            <div class="form-group">
                <label for="district">District:</label>
                <input type="text" class="form-control" name="district" required>
            </div>

            <div class="form-group">
                <label for="post_code">Post Code:</label>
                <input type="text" class="form-control" name="post_code" required>
            </div>

            <div class="form-group">
                <label for="father_name">Father's Name:</label>
                <input type="text" class="form-control" name="father_name" required>
            </div>

            <div class="form-group">
                <label for="mother_name">Mother's Name:</label>
                <input type="text" class="form-control" name="mother_name" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <br><br>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>