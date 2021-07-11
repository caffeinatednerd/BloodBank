<?php

session_start();

// Redirect to homepage if not logged in
include '../common/redirect_to_homepage.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blood Bank App</title>
    <link rel="shortcut icon" href="../public/images/blood-drop.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/hospital_page.css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
</head>
<body class="loggedin" style="margin: 0 auto;">
    <nav class="navtop">
        <div>
            <h1><a href="hospital_home.php" style="padding: 0 0;">Blood Bank App</a></h1>
            <a href="hospital_profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>

    <div class="content">
        <h2>Home Page</h2>
        <p>Welcome <?= $_SESSION['hospital_name'] ?>!</p>


    <div class="container">
        <div class="container py-4 centralize">
            <div class="row align-items-md-stretch">
              <div class="col-md-4">
                <a href="add_blood_info.php" class="btn btn-outline-success btn-lg btn-huge">Add Blood Info</a>
              </div>
              <div class="col-md-4">
                <a href="../available_blood_samples.php" class="btn btn-outline-danger btn-lg btn-huge">Available Blood Samples</a>
              </div>
              <div class="col-md-4">
                <a href="view_requests.php" class="btn btn-outline-primary btn-lg btn-huge">View Requests</a>
              </div>
            </div>
        </div>
    </div>
    </div>


    <?php include('../common/footer_dark.php'); ?>
</body>
</html>