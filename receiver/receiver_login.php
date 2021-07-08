<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Receiver Login</title>
    <link rel="shortcut icon" href="../public/images/blood-drop.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="../css/login.css" rel="stylesheet" type="text/css">
    <link href="../css/receiver_login.css" rel="stylesheet" type="text/css">
    <script
      src="https://code.jquery.com/jquery-3.6.0.min.js"
      integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
      crossorigin="anonymous">      
    </script>
</head>
<body>
    <div id="login_form" class="login">
        <h1>Receiver Login</h1>
        <form action="receiver_authenticate.php" method="post">
            <label for="username">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>

            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>

            <input type="submit" value="Login">
        </form>

        <br>

        <div class="login_div" align="center">
            <a id="login_toggle">Create New Account</a>
        </div>
    </div>

    <div id="register_form" class="register">
        <h1>Receiver Registration</h1>
        <form action="receiver_registration.php" method="post" autocomplete="off">
            <label for="receiver_name">
                <i class="fas fa-user"></i>
            </label>
            <input type="text" name="receiver_name" placeholder="Name" id="receiver_name" required>
            <label for="username">
                <i class="fas fa-at"></i>
            </label>
            <input type="text" name="username" placeholder="Username" id="username" required>
            <label for="password">
                <i class="fas fa-lock"></i>
            </label>
            <input type="password" name="password" placeholder="Password" id="password" required>
            <label for="email">
                <i class="fas fa-envelope"></i>
            </label>
            <input type="email" name="email" placeholder="Email" id="email" required>

            <label for="blood_group">
                <i class="fas fa-burn"></i>
            </label>
            <select name="blood_group" required>
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
            
            <input type="submit" value="Register">
        </form>
        <br>
        <div class="register_div" align="center">
            <a id="register_toggle">Already a user? Login</a>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#login_toggle').click(function(){
                $('#login_form').toggle();
                $('#register_form').toggle();
            });

            $('#register_toggle').click(function(){
                $('#register_form').toggle();
                $('#login_form').toggle();
            });
        });
    </script>
</body>
</html>