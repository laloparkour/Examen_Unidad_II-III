<?php  

    session_start();

    if (isset($_SESSION['email'])) {
        header('Location: app/inicio.php');
    } else {
        header('Location: app/login.php');
    }
