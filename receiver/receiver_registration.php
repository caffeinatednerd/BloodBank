<?php

// define db connection parameters
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'blood_bank';

// connect to db
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// if there is any error with the connection, stop script and dispay error
if( mysqli_connect_errno() ) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// check if the data was submitted, isset() function will check if the data exists
if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['blood_group'])) {
    // Could not get the data that should have been sent
    exit('Please complete the registration form!');
}
// Make sure the submitted registration values are not empty
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['blood_group'])) {
    // One or more values are empty
    exit('Please complete the registration form');
}

// check if email is valid
if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    exit('Email is not valid!');
}
// check if username is valid
if (preg_match('/^[a-zA-Z0-9]+$/', $_POST['username']) == 0) {
    exit('Username is not valid!');
}
// check if password is valid
if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 5) {
    exit('Password must be between 5 and 20 characters long!');
}

// check if the account with that username exists
if ($stmt = $con->prepare('SELECT id, password, email, blood_group FROM receiver_accounts WHERE username = ?')) {
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();
    // store the result so to check if the account exists in the database
    if ($stmt->num_rows > 0) {
        // Username already exists
        echo 'Username exists, please choose another!';
    } else {
        // Insert new account
        // Username doesnt exists, insert new account
        if ($stmt = $con->prepare('INSERT INTO receiver_accounts (username, password, email, blood_group) VALUES (?, ?, ?, ?)')) {
            // hash the password and use password_verify when a user logs in
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('ssss', $_POST['username'], $password, $_POST['email'], $_POST['blood_group']);
            $stmt->execute();
            echo 'Receiver registered successfully!';
            echo '<br>';
            echo '<a href="receiver_login.php">Login</a>';
        } else {
            // Something is wrong with the sql statement, check to make sure accounts table exists with all 4 fields
            echo 'Could not prepare statement!';
        }
    }

    $stmt->close();
} else {
    // Something is wrong with the sql statement, check to make sure accounts table exists with all 4 fields
    echo 'Could not prepare statement!';
}

$con->close();

?>