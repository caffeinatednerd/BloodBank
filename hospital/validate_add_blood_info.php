<?php

session_start();

// Redirect to homepage if not logged in
include '../common/redirect_to_homepage.php';

// // Connect to Database
// include '../common/connect_local_db.php';

// Connect to remote database
include '../common/connect_remote_db.php';

if( mysqli_connect_errno() ) {
    // If there is any error with the connection, stop script and dispay error
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// check if data from login form was submitted, isset() will check if data exists
if( !isset($_POST['blood_group'], $_POST['blood_litres'] )) {
    // could not get the data that should have been sent
    exit('Please fill both the blood_group and blood_litres fields!');
}


if ($stmt = $con->prepare('INSERT INTO blood_banks (hospital_id, blood_group, blood_litres) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE blood_litres = VALUES(blood_litres)')) {
    
    $stmt->bind_param('isd', $_SESSION['id'], $_POST['blood_group'], $_POST['blood_litres']);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = "Sample information added/updated successfully!";
    header('Location: add_blood_info.php');
    exit;
} else {
    // Something is wrong with the sql statement, check to make sure accounts table exists with all 4 fields
    echo 'Could not prepare statement!';
}

$con->close();

?>