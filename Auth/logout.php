<?php
    session_start();
    $url = "../index.php";
    if (session_destroy()) {
        header("location:$url");
    }

