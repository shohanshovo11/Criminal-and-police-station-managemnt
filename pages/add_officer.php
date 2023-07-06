<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link rel="stylesheet" href="registration/userRegcss.css">
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<br><br>
<div class="container">
    <div class="card bg-light">
        <article class="card-body mx-auto" style="max-width: 400px;">
            <h4 class="card-title mt-3 text-center">Create Account</h4>
            <p class="text-center">Get started with your free account</p>
            <p>
                <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-twitter"></i>   Login via Twitter</a>
                <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>   Login via facebook</a>
            </p>
            <p class="divider-text">
                <span class="bg-light">OR</span>
            </p>
            <form action="" method="post">
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="fname" class="form-control" placeholder="First Name" type="text" value="<?php echo isset($_POST['fname']) ? $_POST['fname'] : ''; ?>">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="mname" class="form-control" placeholder="Middle name" type="text" value="<?php echo isset($_POST['mname']) ? $_POST['mname'] : ''; ?>">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                    </div>
                    <input name="lname" class="form-control" placeholder="Last name" type="text" value="<?php echo isset($_POST['lname']) ? $_POST['lname'] : ''; ?>">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="userid" class="form-control" placeholder="Userid" type="text" value="<?php echo isset($_POST['userid']) ? $_POST['userid'] : ''; ?>">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
                    </div>
                    <input name="phonenum" class="form-control" placeholder="Phone number(+880......)" type="text" value="<?php echo isset($_POST['phonenum']) ? $_POST['phonenum'] : ''; ?>">
                </div> <!-- form-group// -->

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-calendar"></i> </span>
                    </div>
                    <input type="date" name="datefield" class="form-control" placeholder="Date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : ''; ?>">
                </div>
                <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fas fa-street-view"></i> </span>
                    </div>
                    <input name="street" class="form-control" placeholder="Street" type="text" value="<?php echo isset($_POST['street']) ? $_POST['street'] : ''; ?>">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="far fa-building"></i> </span>
                    </div>
                    <input name="city" class="form-control" placeholder="City" type="text" value="<?php echo isset($_POST['city']) ? $_POST['city'] : ''; ?>">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="far fa-building"></i> </span>
                    </div>
                    <input name="district" class="form-control" placeholder="District" type="text" value="<?php echo isset($_POST['district']) ? $_POST['district'] : ''; ?>">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="postcode" class="form-control" placeholder="Post Code" type="text" value="<?php echo isset($_POST['postcode']) ? $_POST['postcode'] : ''; ?>">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
                    </div>
                    <input name="stationid" class="form-control" placeholder="Station ID" type="text" value="<?php echo isset($_POST['stationid']) ? $_POST['stationid'] : ''; ?>">
                </div>
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input name="pass1" class="form-control" placeholder="Create password" type="password" value="<?php echo isset($_POST['pass1']) ? $_POST['pass1'] : ''; ?>">
                </div> <!-- form-group// -->
                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                    </div>
                    <input class="form-control" name="pass2" placeholder="Repeat password" type="password" value="<?php echo isset($_POST['pass2']) ? $_POST['pass2'] : ''; ?>">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <button name="submit" type="submit" class="btn btn-primary btn-block"> Create Account </button>
                </div> <!-- form-group// -->
                <p class="text-center">Have an account? <a href="login/login.php">Log In</a> </p>
            </form>
        </article>
    </div> <!-- card.// -->
    <?php
    // Oracle database connection settings
    // Create a connection to the Oracle database
    $conn = oci_connect('shohan', '123', '//localhost/XE');
    // Check if the connection is successful
    if (!$conn) {
        $e = oci_error();
        trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
    }

    if (isset($_POST['submit'])) {
        // Get the form data
        $userid = $_POST['userid'];
        $password = $_POST['pass1'];
        $password2 = $_POST['pass2'];
        $userid = $_POST['userid'];
        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $phonenum = $_POST['phonenum'];
        $dob = $_POST['datefield'];
        $street = $_POST['street'];
        $city = $_POST['city'];
        $district = $_POST['district'];
        $postcode = $_POST['postcode'];
        $stationid = $_POST['stationid'];

        // Check if passwords match
        if ($password !== $password2) {
            echo "Error: Passwords do not match.";
            // Handle the error case
            return; // Exit the code execution
        }

        // Your existing code...

        $plsql = "DECLARE
        v_userid login.userid%TYPE := :userid;
        v_row_count NUMBER;
        sp_id int;
        CURSOR c_user_count IS
            SELECT COUNT(*)
            FROM login
            WHERE login.userid = v_userid;
    BEGIN
        OPEN c_user_count;
        FETCH c_user_count INTO v_row_count;
        CLOSE c_user_count;
    
        IF v_row_count > 0 THEN
            raise_application_error(-20001, 'User ID already exists.');
        ELSE
            IF LENGTH(:phonenum) = 14 AND SUBSTR(:phonenum, 1, 4) = '+880' THEN
                INSERT INTO officer (sp_id, first_name, middle_name, last_name, dob, home_address, city, district, post_code) 
                VALUES (incrementseq.nextval, :fname, :mname, :lname, TO_DATE(:dob, 'YYYY-MM-DD'), :street, :city, :district, :postcode)
                RETURNING sp_id INTO sp_id;
                COMMIT;
    
                INSERT INTO login VALUES (:userid, :pass, 'O');
                INSERT INTO officeruserid VALUES (sp_id, :userid);
                INSERT INTO loginofficer VALUES (:userid, sp_id);
                INSERT INTO connected_to VALUES (sp_id, :stationid);
                INSERT INTO phone_num VALUES (sp_id, :phonenum);
                COMMIT;
            ELSE
                raise_application_error(-20001, 'Phone number must be 14 characters long and start with ''+880''.');
            END IF;
        END IF;
    END;";

        // Prepare the PL/SQL block for execution
        $stmt = oci_parse($conn, $plsql);

        // Bind the form data to the PL/SQL block variables
        oci_bind_by_name($stmt, ':userid', $userid);
        oci_bind_by_name($stmt, ':fname', $fname);
        oci_bind_by_name($stmt, ':mname', $mname);
        oci_bind_by_name($stmt, ':lname', $lname);
        oci_bind_by_name($stmt, ':phonenum', $phonenum);
        oci_bind_by_name($stmt, ':dob', $dob);
        oci_bind_by_name($stmt, ':street', $street);
        oci_bind_by_name($stmt, ':city', $city);
        oci_bind_by_name($stmt, ':district', $district);
        oci_bind_by_name($stmt, ':postcode', $postcode);
        oci_bind_by_name($stmt, ':stationid', $stationid);
        oci_bind_by_name($stmt, ':pass', $password);

        // Execute the PL/SQL block
        $result = oci_execute($stmt);

        // Check if the execution was successful
        if ($result) {
            echo "Data inserted successfully!";
            // Redirect or display a success message
        } else {
            $error = oci_error($stmt);
            echo "Error: " . $error['message'];
            // Handle the error case
        }

        // Clean up statement
        oci_free_statement($stmt);

        //

        oci_close($conn);
    }
    ?>


</div>
<!--container end.//-->
</article>
<br><br>