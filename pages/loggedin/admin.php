<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Admin Dashboard</title>
    <style>
        .dashboard-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="dashboard-container">
        <h1>Admin Dashboard</h1><br>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-lg btn-block" onclick="addOfficer()">Add Officer</button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-lg btn-block" onclick="postJob()">Post Job</button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button class="btn btn-primary btn-lg btn-block text-light "><a class="text-decoration-none text-light" href="../application/Application.php">Application</a></button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-md-12">
                    <button class="btn btn-danger btn-lg btn-block text-light "><a class="text-decoration-none text-light" href="../../index.php">Logout</a></button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function addOfficer() {
            window.location.href = "../add_officer.php";
        }

        function postJob() {
            window.location.href = "../post_job.php";
        }
    </script>
</body>

</html>