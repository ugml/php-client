<?php

    // start the session
    // and load the userID
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    $userID = $_SESSION['userID'];

    // if there is no userID stored,
    // redirect to the login-page
    if (!$userID) {
        header("Location: login.php");
        die();
    } else {
        header("Location: game.php");
        die();
    }

