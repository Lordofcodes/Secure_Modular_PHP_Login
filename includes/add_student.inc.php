<?php
require 'data.inc.php';
require 'add_student.validate.inc.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("location: add_student.php?error=" . 'Unathorized acces!');
        session_destroy();
        exit();
    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $course = $_POST['courses'];
        $total_fees = $_POST['total_fees'];
        $paid_fees = $_POST['paid_fees'];
        $balance_fees  = $_POST['balance_fees'];
        
    
        if (validate_add_student($username, $email, $password,$course,$total_fees,$paid_fees,$balance_fees)) {
            $conn = DB::getInstance()->getDB();
            $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
            $stmt->bindParam(':email', $email);
            $stmt->execute();
    
            if ($row = $stmt->fetch()) {
                header("Location: ../add_student.php?error=User already exists!");
                exit();
            } else {
                $stmt = $conn->prepare('INSERT INTO student_details (username, email, course, total_fees, paid_fees, balance_fees
                ) VALUES (:uname, :mail,:course,:t_fees,:p_fees,:b_fees)');
                $stmt->execute([
                    'uname' => $_POST['username'],
                    'mail' => $_POST['email'],
                    'course'=>$_POST['courses'],
                    't_fees' => $_POST['total_fees'],
                    'p_fees' => $_POST['paid_fees'],
                    'b_fees' => $_POST['balance_fees']
                ]);

                $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (:uname, :mail, :pwd)');
                $stmt->execute([
                    'uname' => $_POST['username'],
                    'mail' => $_POST['email'],
                    'pwd' => password_hash($_POST['password'], PASSWORD_DEFAULT),
                ]);
                
                header("Location: ../add_student.php?success=Student added successfuly!");
                exit();
            }
        }



        header("Location: ../add_student.php?error=Something went wrong, please try later!");
    
    } else {
        header("Location: ../add_student.php?error=Access denied!");
    }
    