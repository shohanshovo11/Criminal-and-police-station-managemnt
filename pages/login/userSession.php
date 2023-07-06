<?
    // Start the session
    session_start();

    // After verifying the user's credentials and before redirecting to the next page
    // Edit the session variable with the updated value
    $_SESSION['username'] = 'new_username'; // Assign the new value to the 'username' session variable

    // Redirect to the next page
    header('Location: ../../index.php');
    exit;
?>