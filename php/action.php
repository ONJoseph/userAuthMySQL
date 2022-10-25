<?php
session_status() === PHP_SESSION_NONE ? session_start() : null;
include "userauth.php";
include_once "../config.php";

// check for which button is clicked and perform action
switch(true){
    case isset($_POST['register']):
        //extract the $_POST array values for name, password and email
        $fullnames = trim($_POST['fullnames']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $country = trim($_POST['country']);
        $gender = trim($_POST['gender']); 
        registerUser($fullnames, $email, $password, $gender, $country);
        break;

    case isset($_POST['login']):
        $email = trim($_POST['email']);
        $password =  trim($_POST['password']);
        loginUser($email, $password);
        break;

    case isset($_POST["reset"]):
        $email =  trim($_POST['email']);
        $password =  trim($_POST['password']);
        resetPassword($email, $password);
        break;

    case isset($_POST["delete"]):
        $id = $_POST['id'];
        deleteaccount($id);
        break;
        
    case isset($_GET["all"]):
        getusers();
        break;
}