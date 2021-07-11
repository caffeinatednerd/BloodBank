<?php

// ################## Validation Checks #########################

// if there is any error with the connection, stop script and dispay error
if( mysqli_connect_errno() ) {
    $_SESSION['reg_message'] = 'Failed to connect to MySQL: ' . mysqli_connect_error();
    redirect('failed');
}

// check if the data was submitted, isset() function will check if the data exists
if (!isset($_POST['username'], $_POST['password'], $_POST['email'], $_POST['hospital_name'])) {
    // Could not get the data that should have been sent
    $_SESSION['reg_message'] = 'Please complete the registration form!';
    redirect('failed');
}
// Make sure the submitted registration values are not empty
if (empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['hospital_name'])) {
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
// ###################################################################

?>