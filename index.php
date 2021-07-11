<?php 

if(isset($_POST['hospital'])) {
    header('Location: hospital/hospital_login.php');
}
else if(isset($_POST['receiver'])) {
    header('Location: receiver/receiver_login.php');
}
else if(isset($_POST['blood_samples'])) {
    header('Location: available_blood_samples.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blood Bank App</title>
    <link rel="shortcut icon" href="public/images/blood-drop.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link href="css/login.css" rel="stylesheet" type="text/css">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <link href="css/footer.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div id="login_form" class="login">
        <h1 style="font-size: 30px; color: #DC143C;" class="centralize"><i class="fas fa-plus fa-1x"></i> Blood Bank Application</h1>
        <!-- <div class="sig">
            <span id='sig-left'>by Prabhu Singh</span> 
            <span id='sig-right'>for <img id="logo" src="public/images/internshala_logo.svg" alt="Internshala Logo"></span>
        </div> -->

        <div class="container">
            <div class="centralize" id="log">Login as</div>
            <form method="post">
                <div class="container py-4 centralize">
                    <div class="row align-items-md-stretch">
                      <div class="col-md-6">
                        <button type="submit" name="hospital" class="btn-top btn btn-outline-success btn-huge">Hospital</button>
                      </div>
                      <div class="col-md-6">
                        <button type="submit" name="receiver" class="btn-top btn btn-outline-danger btn-huge">Receiver</button>
                      </div>
                    </div>

                    <p class="or"> or </p>

                    <div class="row align-items-md-stretch">
                      <div class="col-md-12">
                        <button type="submit" name="blood_samples" class="btn btn-outline-dark btn-huge">Check Available Blood Samples</button>
                      </div>
                    </div>

                </div>
            </form>
        </div>

    </div>

    <footer class="text-center text-white fixed-bottom">
      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        <span class="sig">made with ❤️ by <a class="text-white" href="https://www.linkedin.com/in/caffeinatednerd" target="_blank">Prabhu Singh</a></span>
        
        <span class="for">for</span><img id="logo" src="public/images/internshala_logo.svg" alt="Internshala Logo">
      </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>