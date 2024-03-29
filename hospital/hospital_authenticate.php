<?php

session_start();

// // Connect to Database
// include '../common/connect_local_db.php';

// Connect to remote database
include '../common/connect_remote_db.php';

// if there is any error with the connection, stop script and dispay error
if( mysqli_connect_errno() ) {
    $_SESSION['log_message'] = 'Failed to connect to MySQL: ' . mysqli_connect_error();
    redirect('failed');
}

function redirect($code) {
    $_SESSION['status'] = $code;
    $_SESSION['code'] = 'log';
    header('Location: hospital_login.php');
    exit;
}

// check if data from login form was submitted, isset() will check if data exists
if( !isset($_POST['username'], $_POST['password'] )) {
    $_SESSION['log_message'] = 'Please fill both the username and password fields!';
    redirect('failed');
}

// prepare a statment for getting id and password for current user from db
if($stmt = $con->prepare('SELECT id, password, email, hospital_name FROM hospital_accounts WHERE username = ?')) {

    $stmt->bind_param('s', $_POST['username']);
    // execute query
    $stmt->execute();
    // store result to check if account exists in database
    $stmt->store_result();

    // check if there are any entries in db for above query
    if($stmt->num_rows > 0) {
        // bind the result to variables
        $stmt->bind_result($id, $password, $email, $hospital_name);
        $stmt->fetch();
        // Account exists, now we verify the password.
        if(password_verify($_POST['password'], $password)) {
            // Verification success
            // Create sessions, so we know the user is logged in, they basically act like cookies but remember the data on the server

            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['role'] = 'hospital';
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['id'] = $id;
            $_SESSION['hospital_name'] = $hospital_name;

            // Redirect to hospital_home
            header('Location: hospital_home.php');
        } 
        else {
            // Incorrect password
            $_SESSION['log_message'] = 'Incorrect password!';
            redirect('failed');
        }   
    } else {
        // Incorrect username
        $_SESSION['log_message'] = 'Username not present!';
        redirect('failed');
    }

    $stmt->close();
}

?>