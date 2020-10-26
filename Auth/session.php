<?php
    session_start();
    $url = "../Auth/login.php";
    if ($_SESSION['session']) {
        $_SESSION['session'];
    }else {
        header("location:$url");
    }

