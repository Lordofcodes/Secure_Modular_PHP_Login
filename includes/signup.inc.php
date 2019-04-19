<?php
session_start();
require 'data.inc.php';
require 'signup_validate.inc.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (validate_signup($username, $email, $password)) {
        $conn = DB::getInstance()->getDB();
        $stmt = $conn->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($row = $stmt->fetch()) {
            header("Location: ../login.php?error=User already exists!");
            exit();
        } else {
            $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (:uname, :mail, :pwd)');
            $stmt->execute([
                'uname' => $_POST['username'],
                'mail' => $_POST['email'],
                'pwd' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            ]);
            header("Location: ../login.php?success=Account created successfuly, please login!");
            exit();
        }
    }
    header("Location: ../login.php?error=Something went wrong, please try later!");

} else {
    header("Location: ../login.php?error=Access denied!");
}
