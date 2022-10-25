<?php

require_once "../config.php";

//register users
function registerUser($fullnames, $email, $password, $gender, $country){
    //create a connection variable using the db function in config.php
    $conn = db();
   //check if user with this email already exist in the database
   $checkUserQuery = "SELECT email FROM students WHERE email = '$email'";
   $checkUser = $conn->query($checkUserQuery);

   if($checkUser){

       if($checkUser->num_rows == 0){

        $addUserQuery = "INSERT INTO students(full_names, country, email, gender, password) VALUES('$fullnames', '$country', '$email', '$gender', '$password')";
        $addUser = $conn->query($addUserQuery);

            if($addUser){
                echo "<script> alert('User registered successfully!') </script>";
                echo '<meta http-equiv="refresh" content="2;url=../forms/login.html"/>';
            } else {
                echo "<script> alert('Error. User not registered!') </script>";
                echo '<meta http-equiv="refresh" content="2;url=../forms/register.html"/>';
            }

       } else {
            echo "<script> alert('User already registered!')</script>";
            echo '<meta http-equiv="refresh" content="2;url=../forms/login.html"/>';
       }
   }
}


//login users
function loginUser($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();

    echo "<h1 style='color: red'> LOG ME IN (IMPLEMENT ME) </h1>";
    //open connection to the database and check if username exist in the database
    //if it does, check if the password is the same with what is given
    //if true then set user session for the user and redirect to the dasbboard
    $getUserQuery = "SELECT * FROM students WHERE email = '$email'";
    $getUser = $conn->query($getUserQuery);

    if($getUser){
        if($getUser->num_rows > 0){
            $user = $getUser->fetch_assoc();
            $db_email = $user['email'];
            $db_password = $user['password'];

            if($email == $db_email && $password == $db_password){
                $_SESSION['username'] = $email;
                echo "<script> alert('Login successful!')</script>";
                echo '<meta http-equiv="refresh" content="2;url=../dashboard.php"/>';
            }else {
                echo "<script> alert('Invalid credentials supplied!')</script>";
                echo '<meta http-equiv="refresh" content="2;url=../forms/login.html"/>';
            }
        } else {
            echo "<script> alert('User does not exist. Please register!')</script>";
            echo '<meta http-equiv="refresh" content="2;url=../forms/register.html"/>';
        }
    }
}


function resetPassword($email, $password){
    //create a connection variable using the db function in config.php
    $conn = db();
    echo "<h1 style='color: red'>RESET YOUR PASSWORD (IMPLEMENT ME)</h1>";
    //open connection to the database and check if username exist in the database
    //if it does, replace the password with $password given
    $getUserQuery = "SELECT email FROM students WHERE email = '$email'";
    $getUser = $conn->query($getUserQuery);
    
    if($getUser){
        if($getUser->num_rows > 0){
           $resetPasswordQuery = "UPDATE students SET password = '$password' WHERE email = '$email'";
           $resetPassword = $conn->query($resetPasswordQuery);
            if($resetPassword){                                
                echo "<script> alert('Password reset successful!')</script>";
                echo '<meta http-equiv="refresh" content="2;url=../forms/login.html"/>';
            }else {
                echo "<script> alert('Error! Password not reset')</script>";
                echo '<meta http-equiv="refresh" content="2;url=../forms/resetpassword.html"/>';
            }
        } else {
            echo "<script> alert('User does not exist!')</script>";
            echo '<meta http-equiv="refresh" content="2;url=../forms/register.html"/>';
        }
    }
}

function getusers(){
    $conn = db();
    $sql = "SELECT * FROM Students";
    $result = mysqli_query($conn, $sql);
    echo"<html>
    <head></head>
    <body>
    <center><h1><u> ZURI PHP STUDENTS </u> </h1> 
    <table border='1' style='width: 700px; background-color: magenta; border-style: none'; >
    <tr style='height: 40px'><th>ID</th><th>Full Names</th> <th>Email</th> <th>Gender</th> <th>Country</th> <th>Action</th></tr>";
    if(mysqli_num_rows($result) > 0){
        while($data = mysqli_fetch_assoc($result)){
            //show data
            echo "<tr style='height: 30px'>".
                "<td style='width: 50px; background: blue'>" . $data['id'] . "</td>
                <td style='width: 150px'>" . $data['full_names'] .
                "</td> <td style='width: 150px'>" . $data['email'] .
                "</td> <td style='width: 150px'>" . $data['gender'] . 
                "</td> <td style='width: 150px'>" . $data['country'] . 
                "</td>
                <form action='action.php' method='post'>
                <input type='hidden' name='id'" .
                 "value=" . $data['id'] . ">".
                "<td style='width: 150px'> <button type='submit', name='delete'> DELETE </button>".
                "</tr>";
        }
        echo "</table></table>
        <button type='button' onclick='window.history.back();'>Go back</button>
        </center></body></html>";
    }
    //return users from the database
    //loop through the users and display them on a table
}

 function deleteaccount($id){
     $conn = db();
     //delete user with the given id from the database
     $sql = "DELETE FROM Students WHERE `id` = $id";
     $result = mysqli_query($conn, $sql);
     if($result){
        echo "<script> alert('User deleted succesfuly!')</script>";
        echo '<meta http-equiv="refresh" content="2;url=../dashboard.php"/>';
     } else {
        echo "<script> alert('Error deleting user!')</script>";
     }
 }
