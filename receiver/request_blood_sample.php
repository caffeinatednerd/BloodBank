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

if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
    $url = "https://";   
}
else  {
     $url = "http://";   
}
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];   

// Append the requested resource location to the URL
$url .= $_SERVER['REQUEST_URI'];    

$url_components = parse_url($url);
parse_str($url_components['query'], $params);

if ($stmt = $con->prepare('INSERT INTO blood_requests (receiver_id, hospital_id, blood_group) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE blood_group = VALUES(blood_group)')) {
    
    $stmt->bind_param('iis', $_SESSION['id'], $params['hospital_id'], $params['blood_group']);
    $stmt->execute();
    $stmt->close();

    $_SESSION['message'] = 'Request For Blood Sample Successful!';
    header('Location: /available_blood_samples.php');
    exit;
} else {
    // Something is wrong with the sql statement, check to make sure accounts table exists with all 4 fields
    echo 'Could not prepare statement!';
}

$con->close();

?>