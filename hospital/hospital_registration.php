<?php

session_start();

// // Connect to Database
// include '../common/connect_local_db.php';

// Connect to remote database
include '../common/connect_remote_db.php';

function redirect($code) {
    $_SESSION['status'] = $code;
    $_SESSION['code'] = 'reg';
    header('Location: hospital_login.php');
    exit;
}

// Validate inputs
include '../common/hospital_register_validation.php';

// check if the account with that username exists
if ($stmt = $con->prepare('SELECT id, password FROM hospital_accounts WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    // store the result so to check if the account exists in the database
    if ($stmt->num_rows > 0) {
        // Username already exists
        $_SESSION['reg_message'] = 'Username exists, please choose another!';
        redirect('failed');
    } else {
        // Insert new account
        // Username doesnt exists, insert new account
        if ($stmt = $con->prepare('INSERT INTO hospital_accounts (username, password, email, hospital_name) VALUES (?, ?, ?, ?)')) {
            // hash the password and use password_verify when a user logs in
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $_POST['hospital_name']);
            $stmt->execute();

            $_SESSION['reg_message'] = 'Hospital registered successfully!';
            redirect('success');
        } else {
            // Something is wrong with the sql statement, check to make sure accounts table exists with all 4 fields
            $_SESSION['reg_message'] = 'Could not prepare statement!';
            redirect('failed');
        }
    }

    $stmt->close();
} else {
    // Something is wrong with the sql statement, check to make sure accounts table exists with all 4 fields
    $_SESSION['reg_message'] = 'Could not prepare statement!';
    redirect('failed');
}

$con->close();

?>