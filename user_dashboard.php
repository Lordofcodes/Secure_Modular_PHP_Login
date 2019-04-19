<?php
require 'includes/data.inc.php';
session_start();
if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'user')
{
    header("location: login.php?error=" . 'Access denied!');
    session_destroy();
    exit();
}else{
$conn = DB::getInstance()->getDB();
$stmt = $conn->prepare('SELECT * FROM student_details WHERE email = :email');
$stmt->execute(['email'=> $_GET['email']]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <?= '<h1> Welcome '.$_GET['username'].'!</h1>';?>
    <form action="login.php" method = 'POST'>
    <button type = 'submi' name='logout'> Logout</button>
    <?php
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    ?>
    <table>
        <tr>
            <th> Roll No.</th>
            <th> Username</th>
            <th> Email</th>
            <th> Course</th>
            <th> Total Fees</th>
            <th> Paid Fees </th>
            <th> Balanced Fees</th>
        </tr>
        <tr>
            <td><?= $row['id'] ?></td>
            <td><?= $row['username'] ?></td>
            <td><?= $row['email'] ?></td>
            <td><?= $row['course'] ?></td>
            <td><?= $row['total_fees'] ?></td>
            <td><?= $row['paid_fees'] ?></td>
            <td><?= $row['balance_fees'] ?></td>
        </tr>
</table>
    </form>
</body>
</html>