<?php

session_start();

$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'blood_bank';

$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if( mysqli_connect_errno() ) {
    // If there is any error with the connection, stop script and dispay error
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}


if(isset($_SESSION['loggedin'])) {
    if($_SESSION['role'] == 'hospital') {
        $request_link = '#';
        $home_link = 'hospital/hospital_home.php';
        $profile_link = 'hospital/hospital_profile.php';
    } 
    else if($_SESSION['role'] == 'receiver') {
        // $request_link = 'receiver/request_blood_sample.php';
        $home_link = 'receiver/receiver_home.php';
        $profile_link = 'receiver/receiver_profile.php';

        // get receiver's blood group
        $stmt = $con->prepare('SELECT blood_group FROM receiver_accounts WHERE id = ?');
        $stmt->bind_param('i', $_SESSION['id']);
        $stmt->execute();
        $stmt->bind_result($receiver_blood_group);
        $stmt->fetch();
        $stmt->close();
    }

    $profile_display = '';

} else {
    $is_disabled = '';
    $btn_color = 'btn-outline-dark';
    $request_link = 'receiver/receiver_login.php';
    $profile_display = "display: none;";

    $home_link = '/blood_bank/index.php';
    $profile_link = '';
}


// +++++++++++++++++++++++++
// $sql = 'SELECT hospital_id, blood_group, blood_litres FROM blood_banks';
// $result = $con->query($sql);

// if($result->num_rows > 0) {
//     $serial = 1;
//     while($row=$result->fetch_assoc()) {
//         print_r($row);
//     }
// }
// +++++++++++++++++++++++++

$sql = 'SELECT hospital_id, blood_group, blood_litres FROM blood_banks';
$result = $con->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link rel="shortcut icon" href="public/images/blood-drop.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/hospital_page.css">
</head>
<body class="loggedin" style="margin: 0 auto;">
    <nav class="navtop">
        <div>
            <h1><a href="<?= $home_link ?>" style="padding: 0 0;">Blood Bank App</a></h1>
            <a href="<?= $profile_link ?>" style="<?= $profile_display ?>"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="logout.php" style="<?= $profile_display ?>"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>

    <?php 
        if($result->num_rows > 0) {
            $serial = 1;
    ?>

    <div class="content">
        <h2>Blood Samples Available</h2>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Hospital Name</th>
                    <th scope="col">Blood Group</th>
                    <th scope="col">Blood Litres Available</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>


            <?php 
                while($row = $result->fetch_assoc()) {
                    $hospital_id = $row['hospital_id'];
                    $blood_group = $row['blood_group'];
                    $blood_litres = $row['blood_litres'];

                    if($stmt = $con->prepare('SELECT hospital_name FROM hospital_accounts WHERE id = ?')) {

                        $stmt->bind_param('i', $hospital_id);
                        // execute query
                        $stmt->execute();
                        // store result to check if account exists in database
                        $stmt->store_result();

                        if($stmt->num_rows > 0) {
                            $stmt->bind_result($hospital_name);
                            $stmt->fetch();

                            if(isset($_SESSION['loggedin'])) {
                                if($_SESSION['role'] == 'hospital' or ($_SESSION['role'] == 'receiver' and $receiver_blood_group != $blood_group)) {
                                    $is_disabled = 'disabled';
                                    $btn_color = 'btn-outline-secondary';
                                }
                                else {
                                    $is_disabled = '';
                                    $btn_color = 'btn-outline-dark';
                                }

                                if($_SESSION['role'] == 'receiver') {
                                    $request_link = "receiver/request_blood_sample.php?hospital_id=" . $hospital_id . "&" . "blood_group=" . "$blood_group";
                                }
                            }

                            echo "<tr><td>" . $serial . "</td><td>" . $hospital_name . "</td><td>" . $blood_group . "</td><td>" . $blood_litres . "</td><td>" . "<a href='$request_link' class='btn <?= $btn_color ?> <?= $is_disabled ?>'>Request Sample</a>" . "</td></tr>";

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
                    <h2>Blood samples will be available soon!</h2>
                </div> 
            
      <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html> 