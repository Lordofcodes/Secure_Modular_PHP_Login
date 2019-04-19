<?php
session_start();
require 'data.inc.php';
require 'login_validate.inc.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (validate_login($email, $password)) {
        $conn = DB::getInstance()->getDB();
        $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if (!password_verify($password, $row['password'])) {
                header("Location: ../login.php?email=" . $email . "&error=Invalid password!");
                exit();
            } else {
                if ($row['role'] == 'admin') {
                    $_SESSION['role'] = $row['role'];
                    header("Location: ../admin_dashboard.php?username=" . $row['username']);
                } else if ($row['role'] == 'user') {
                    $_SESSION['role'] = $row['role'];
                    header("Location: ../user_dashboard.php?username=" . $row['username']."&email=".$row['email']);
                }
            }
        } else {
            header("Location: ../login.php?error=User not found!&email=" . $email);
        }
    }
} else {
    header("Location: ../login.php?error=Access denied!");
}
