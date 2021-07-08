<?php

session_start();

if(!isset($_SESSION['message'])) {
    $message = '';
} else {
    $message = $_SESSION['message'];
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home Page</title>
    <link rel="shortcut icon" href="../public/images/blood-drop.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="../css/hospital_page.css">
</head>
<body onload="hideLoadingDiv()" class="loggedin" style="margin: 0 auto;">
    <nav class="navtop">
        <div>
            <h1><a href="hospital_home.php" style="padding: 0 0;">Blood Bank App</a></h1>
            <a href="hospital_profile.php"><i class="fas fa-user-circle"></i>Profile</a>
            <a href="../logout.php"><i class="fas fa-sign-out-alt"></i>Logout</a>
        </div>
    </nav>

    <div class="content">
        <!-- <h2>Add Blood Information</h2> -->


    <div class="container">
        <h2 class="centralize">Add Blood Sample Information</h2>
        <form action="validate_add_blood_info.php" method="post">
            <div class="container py-4 centralize">
                <div class="row align-items-md-stretch">
                  <div class="col-md-6 mt-3">
                    <select class="form-select" aria-label="Default select example" name="blood_group" required>
                      <option value="" disabled selected>Blood Group</option>
                      <option value="A+">A+</option>
                      <option value="A-">A-</option>
                      <option value="AB+">AB+</option>
                      <option value="AB-">AB-</option>
                      <option value="B+">B+</option>
                      <option value="B-">B-</option>
                      <option value="O+">O+</option>
                      <option value="O-">O-</option>
                    </select>
                  </div>
                  <div class="col-md-6 mt-3">
                    <input name="blood_litres" type="number" step="0.1" min=0 class="form-control" placeholder="Litres of Blood Available" required>
                  </div>
                </div>
                <div class="top mt-4">
                    <button type="submit" class="btn btn-dark btn-block btn-sm">Submit</button>
                </div>
            </div>
        </form>

        <div class="centralize" id="message"><?= $message ?></div>
        
    </div>

    </div>

    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous">      
    </script>

    <script>
        function hideLoadingDiv() {
          setTimeout(function(){
            document.getElementById('message').classList.add('hidden');
          }, 5000)
        }
    </script>

</body>
</html>