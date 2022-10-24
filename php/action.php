<?php
include "userauth.php";
include_once "../config.php";


switch(true){
    case isset($_POST['register']):
        //extract the $_POST array values for name, password and email
            $fullnames = $_POST['fullnames'];
            $email = //
            $password = //
            $country = //
            $gender = //   
        registerUser($fullnames, $email, $password, $gender, $country);
        break;

    case isset($_POST['login']):
            $email = //
            $password = //
        loginUser($email, $password);
        break;
    case isset($_POST["reset"]):
            $email = //
            $password = //
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