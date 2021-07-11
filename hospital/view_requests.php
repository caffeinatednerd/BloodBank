<?php

session_start();

// Redirect to homepage if not logged in
include '../common/redirect_to_homepage.php';

// Connect to Database
// include '../common/connect_local_db.php';

// Connect to remote database
include '../common/connect_remote_db.php';


if( mysqli_connect_errno() ) {
    // If there is any error with the connection, stop script and dispay error
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

if($_SESSION['role'] != 'hospital') {
    header('Location: /blood_bank/index.php');
    exit;
}

$sql = "SELECT receiver_id, blood_group FROM blood_requests where hospital_id = {$_SESSION['id']}";

$result = $con->query($sql);
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
    <link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap5.min.css" rel="stylesheet" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/hospital_page.css">
    <link href="../css/footer.css" rel="stylesheet" type="text/css">
</head>
<body class="loggedin" style="margin: 0 auto; padding-bottom: 32px;">
    <nav class="navtop">
        <div>
            <h1><a href="hospital_home.php" style="padding: 0 0;">Blood Bank App</a></h1>
            <a href="hospital_profile.php" style="<?= $profile_display ?>"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="../logout.php" style="<?= $profile_display ?>"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>

    <?php 
        if($result->num_rows > 0) {
            $serial = 1;
    ?>
    <div class="content">
        <h2>Blood Sample Requests</h2>
        
        <table id="req_table" class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Name</th>
                    <th scope="col">Blood Group Required</th>
                    <th scope="col">Email</th>
                </tr>
            </thead>
            <tbody>


            <?php 
                while($row = $result->fetch_assoc()) {
                    $receiver_id = $row['receiver_id'];

                    if($stmt = $con->prepare('SELECT receiver_name, email, username, blood_group FROM receiver_accounts WHERE id = ?')) {

                        $stmt->bind_param('i', $receiver_id);
                        // execute query
                        $stmt->execute();
                        // store result to check if account exists in database
                        $stmt->store_result();

                        if($stmt->num_rows > 0) {
                            $stmt->bind_result($receiver_name, $receiver_email, $receiver_username, $blood_group);
                            $stmt->fetch();

                            echo "<tr><td>" . $serial . "</td><td>" . $receiver_username . "</td><td>" . $receiver_name . "</td><td>" . $blood_group . "</td><td>" . $receiver_email . "</td></tr>";

                        } else {
                            echo "0 results";
                        }

                        $stmt->close();
                        $serial += 1;
                    }
                }

                $con->close();

            } // close if statement
            else { ?>
                
                <div class="content centralize">
                    <h2>No Requests Present</h2>
                </div> 

            <?php 

            } 

            ?>
  
            </tbody>
        </table>
    </div>

    <?php include('../common/footer_dark.php'); ?>

    <?php include('../common/data_table_cdn.php'); ?>

    <script>
        $(document).ready(function() {
            $('#req_table').DataTable();
        } );
    </script>

</body>
</html> 