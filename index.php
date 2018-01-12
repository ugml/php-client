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
        die(header("Location: login.php"));
    } else {
        die(header("Location: game.php"));
    }

