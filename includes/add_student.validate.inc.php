<?php

function validate_add_student($username,$email,$password,$course,$total_fees,$paid_fees,$balance_fees){

    
    if(!isset($username) || trim($username) == ''){
        header("Location: ../add_student.php?email=".$email."&error=Username required!");
        exit();
    }
    else if(!isset($email) || trim($email) == ''){
        header("Location: ../add_student.php?username=".$username."&error=Email required!");
        exit();
    }
    else if(!isset($password) || trim($password) == ''){
        header("Location: ../add_student.php?username=".$username."&email=".$email."&error=Password required!");
        exit();
    }  
    else{
        if (!preg_match('/^[a-z\d_]{2,20}$/i', $username)){
         header("Location: ../add_student.php?email=".$email."&error= Please enter valid username!");
        exit();
         }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: ../add_student.php?username=".$username."&error=Pleaes enter valid email!");
            exit();
        }
        else if(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,50}$/', $password)) {
            header("Location: ../add_student.php?username=".$username."&email=".$email."&error=Your password doesn't meet the rquiredments!");
            exit();
        }
    } 
        // //course validation 
        // if(!isset($course) || trim($course) == ''){
        //     header("Location: ../add_student.php?email=".$email."&error= Course required!");
        //     exit();
        // }

        //$total_fees validation

        if(!isset($total_fees) || trim($total_fees) == ''){
            header("Location: ../add_student.php?username=".$username."&email=".$email."&error= Total Fees required!");
            exit();
        }else{
            if($total_fees > 100000){
                header("Location: ../add_student.php?username=".$username."&email=".$email."&error= Invalid Fotal Fees!");
                exit();
            }
        }

        //$paid_fees validation

        if(!isset($paid_fees) || trim($paid_fees) == ''){
            header("Location: ../add_student.php?username=".$username."&email=".$email."&total_fees=".$total_fees."&error= Paid Fees required!");
            exit();
        }else{
            if($paid_fees > $total_fees){
                header("Location: ../add_student.php?username=".$username."&email=".$email."&total_fees=".$total_fees."&error=Paid Fees can not be more than  Total Fees!");
                exit();
            }
        }
        
        //$balance_fees validation 
        
        if(!isset($balance_fees) || trim($balance_fees) == ''){
            header("Location: ../add_student.php?username=".$username."&email=".$email."&total_fees=".$total_fees."paid_fees=".$paid_fees."&error=Balance Fees required!");
            exit();
        }else{
            if($balance_fees  != ($total_fees-$paid_fees)){
                header("Location: ../add_student.php?username=".$username."&email=".$email."&total_fees=".$total_fees."paid_fees=".$paid_fees."&error= Invalid Balance Fees!");
                exit();
            }
        }
        return true;


    }

   

