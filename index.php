<?php 

if(isset($_POST['hospital'])) {
    header('Location: hospital/hospital_login.php');
}
else if(isset($_POST['receiver'])) {
    header('Location: receiver/receiver_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Blood Bank App</title>
    <link rel="shortcut icon" href="public/images/blood-drop.png" type="image/x-icon">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
    <h1 class="centralize">Blood Bank Application</h1>

    <div class="container">
        <h2 class="centralize">Login as</h2>
        <form method="post">
            <div class="container py-4 centralize">
                <div class="row align-items-md-stretch">
                  <div class="col-md-6">
                    <button type="submit" name="hospital" class="btn btn-outline-success btn-lg btn-huge">Hospital</button>
                  </div>
                  <div class="col-md-6">
                    <button type="submit" name="receiver" class="btn btn-outline-danger btn-lg btn-huge">Receiver</button>
                  </div>
                </div>
            </div>
        </form>
    </div>

<!-- 
    <div class="container py-4 centralize">
        <div class="row align-items-md-stretch">
          <div class="col-md-6">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
              <button class="btn btn-outline-light" type="button">Example button</button>
            </div>
          </div>
          <div class="col-md-6">
            <div class="h-100 p-5 bg-light border rounded-3">
              <button class="btn btn-outline-secondary" type="button">Example button</button>
            </div>
          </div>
        </div>
    </div> -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->
</body>
</html>