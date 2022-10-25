<?php
session_status() == PHP_SESSION_NONE ? session_start() : null;

logout();

function logout(){
    /*
        Check if the existing user has a session
        if true destroy the session and redirect to login page
    */
    if(isset($_SESSION['username'])) {
        unset($_SESSION['username']);
        session_destroy();
        header("Location:../forms/login.html");
    } else {
        echo "Not logged in"; header("Location:../forms/login.html");
    }
}
