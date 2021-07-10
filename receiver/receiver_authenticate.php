<?php

// start session
session_start();

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

// check if data from login form was submitted, isset() will check if data exists
if( !isset($_POST['username'], $_POST['password'] )) {
    // could not get the data that should have been sent
    exit('Please fill both the username and password fields!');
}

// prepare a statment for getting id and password for current user from db
if($stmt = $con->prepare('SELECT id, password, email, blood_group, receiver_name FROM receiver_accounts WHERE username = ?')) {

    $stmt->bind_param('s', $_POST['username']);
    // execute query
    $stmt->execute();
    // store result to check if account exists in database
    $stmt->store_result();

    // check if there are any entries in db for above query
    if($stmt->num_rows > 0) {
        // bind the result to variables
        $stmt->bind_result($id, $password, $email, $blood_group, $receiver_name);
        $stmt->fetch();
        // Account exists, now we verify the password.
        if(password_verify($_POST['password'], $password)) {
            // Verification success
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server

            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['role'] = 'receiver';
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['receiver_name'] = $receiver_name;

            // Redirect to hospital_home
            header('Location: receiver_home.php');
        } 
        else {
            // Incorrect password
            echo 'Incorrect password!';
        }   
    } else {
        // Incorrect username
        echo 'Incorrect username!';
    }

    $stmt->close();
}

?>