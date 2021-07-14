<?php

// If user is not logged in, redirect to login page
if (!isset($_SESSION['loggedin'])) {
    header('Location: /');
    exit;
}

?>