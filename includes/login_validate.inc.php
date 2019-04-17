<?php
function validate($email,$password){

    if(!isset($email) || trim($email) == ''){
        header("Location: ../login.php?error=Email required!");
        exit();
    }
    else if(!isset($password) || trim($password) == ''){
        header("Location: ../login.php?email=".$email."&error=Password required!");
        exit();
    }  
    else{
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../login.php?error= Pleaes enter valid email!");
            exit();
        }
        else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,50}$/', $password)) {
            header("Location: ../login.php?email=".$email."&error=Your password doesn't meet the rquiredments!");
            exit();
        }
        return true;
    } 
}
