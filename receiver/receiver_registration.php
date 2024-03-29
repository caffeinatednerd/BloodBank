<?php

session_start();

// // Connect to Database
// include '../common/connect_local_db.php';

// Connect to remote database
include '../common/connect_remote_db.php';

function redirect($code) {
    $_SESSION['status'] = $code;
    $_SESSION['code'] = 'reg';
    header('Location: receiver_login.php');
    exit;
}

// if there is any error with the connection, stop script and dispay error
if( mysqli_connect_errno() ) {
    $_SESSION['reg_message'] = 'Failed to connect to MySQL: ' . mysqli_connect_error();
    redirect('failed');
}

// check if the data was submitted, isset() function will check if the data exists
if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['blood_group'], $_POST['receiver_name'])) {
    // Could not get the data that should have been sent
    $_SESSION['reg_message'] = 'Please complete the registration form!';
    redirect('failed');
}
// Make sure the submitted registration values are not empty
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['blood_group']) || empty($_POST['receiver_name'])) {
    // One or more values are empty
    $_SESSION['reg_message'] = 'Please complete the registration form';
    redirect('failed');
}

// check if email is valid
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    $_SESSION['reg_message'] = 'Email is not valid!';
    redirect('failed');
}
// check if username is valid
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    $_SESSION['reg_message'] = 'Username is not valid!';
    redirect('failed');
}
// check if password is valid
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    $_SESSION['reg_message'] = 'Password must be between 5 and 20 characters long!';
    redirect('failed');
}

// check if the account with that username exists
if ($stmt = $con->prepare('SELECT id, password, email, blood_group, receiver_name FROM receiver_accounts WHERE username = ?')) {
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
        if ($stmt = $con->prepare('INSERT INTO receiver_accounts (username, password, email, blood_group, receiver_name) VALUES (?, ?, ?, ?, ?)')) {
            // hash the password and use password_verify when a user logs in
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('sssss', $_POST['username'], $password, $_POST['email'], $_POST['blood_group'], $_POST['receiver_name']);
            $stmt->execute();
            
            $_SESSION['reg_message'] = 'Receiver registered successfully!';
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