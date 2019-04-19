<?php
function validate_signup($username,$email,$password){

    if(!isset($username) || trim($username) == ''){
        header("Location: ../signup.php?email=".$email."&error=Username required!");
        exit();
    }
    else if(!isset($email) || trim($email) == ''){
        header("Location: ../signup.php?username=".$username."&error=Email required!");
        exit();
    }
    else if(!isset($password) || trim($password) == ''){
        header("Location: ../signup.php?username=".$username."&email=".$email."&error=Password required!");
        exit();
    }  
    else{
        if (!preg_match('/^[a-z\d_]{2,20}$/i', $username)){
         header("Location: ../signup.php?email=".$email."&error= Please enter valid username!");
        exit();
         }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../signup.php?username=".$username."&error=Pleaes enter valid email!");
            exit();
        }
        else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,50}$/', $password)) {
            header("Location: ../signup.php?username=".$username."&email=".$email."&error=Your password doesn't meet the rquiredments!");
            exit();
        }
        return true;
    } 
}
