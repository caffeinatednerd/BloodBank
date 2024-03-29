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

// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT email FROM hospital_accounts WHERE id = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($email);
$stmt->fetch();
$stmt->close();

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Blood Bank App</title>
        <link rel="shortcut icon" href="../public/images/blood-drop.png" type="image/x-icon">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <link href="../css/hospital_page.css" rel="stylesheet" type="text/css">
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
            <h2>Profile Page</h2>
            <div>
                <p>Your account details are below:</p>
                <table>
                    <tr>
                        <td>Hospital Name:</td>
                        <td><?=$_SESSION['hospital_name']?></td>
                    </tr>
                    <tr>
                        <td>Username:</td>
                        <td><?= $_SESSION['username'] ?></td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td><?=$email?></td>
                    </tr>
                </table>
            </div>
        </div>

        <?php include('../common/footer_dark.php'); ?>
    </body>
</html>
