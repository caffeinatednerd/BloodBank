<?php

session_start();
// If user is not logged in, redirect to login page

if (!isset($_SESSION['loggedin'])) {
    header('Location: /blood_bank/index.php');
    exit;
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Home Page</title>
    <link rel="shortcut icon" href="../public/images/blood-drop.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/receiver_page.css">
    <link rel="stylesheet" type="text/css" href="../css/hospital_page.css">
</head>
<body class="loggedin" style="margin: 0 auto;">
    <nav class="navtop">
        <div>
            <h1><a href="receiver_home.php" style="padding: 0 0;">Blood Bank App</a></h1>
            <a href="receiver_profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>

    <div class="content">
        <h2>Home Page</h2>
        <p>Welcome <?= $_SESSION['receiver_name'] ?>!</p>

        <div class="container">
        <div class="container py-4 centralize">
            <div class="row align-items-md-stretch">
              <div class="col-md-4">
                <a href="../available_blood_samples.php" class="btn btn-outline-dark btn-lg btn-huge">Available Blood Samples</a>
              </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>