<?php
require 'includes/data.inc.php';
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
        header("location: login.php?error=" . 'Access denied!');
        session_destroy();
        exit();
    }
$conn = DB::getInstance()->getDB();
$stmt = $conn->prepare('SELECT * FROM student_details');
$stmt->execute();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
  <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
    <div class="container">
        <div class="text-center">
            <h2>Admin Dashboard</h2>
        </div>
        <?= '<h3> Welcome ' . ucwords($_GET['username']). '!</h3>'; ?>
        <form action="login.php" method='POST'>
        <a href="add_student.php" class="btn btn-primary" target="_blank">Add Student</a>
            <button type='submit' class="btn btn-warning" name='logout'> Logout</button>
        </form>
       
        <h4>Students Summary</h4>
        <table class="table table-striped">
            <thead>
                <tr class="thead-dark">
                    <th scope="col"> Roll No </td>
                    <th scope="col"> Username </td>
                    <th scope="col"> Email </td>
                    <th scope="col">Course </td>
                    <th scope="col"> Total Fees </td>
                    <th scope="col"> Paid Fees </td>
                    <th scope="col">Balance Fees</th>
                    <th scope="col">Edit</th>
                    <th scope="col">Delete</th>         
                </tr>
            </thead>
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<tr>';
                echo '<td scope="row">' . $row['id'] . '</td>';
                echo '<td>' . $row['username'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['course'] . '</td>';
                echo '<td>' . $row['total_fees'] . '</td>';
                echo '<td>' . $row['paid_fees'] . '</td>';
                echo '<td>' . $row['balance_fees'] . '</td>';
                echo "<td> <form action='#' method='POST'>";
                echo "<button type='submit' value='Edit' class= 'btn btn-info' name='edit'>Edit</td>";
                echo "<td> <form action='add_student.php' method='POST'>";
                echo "<button type='submit' value='delete' class='btn btn-danger' name='delete'>Delete</td>";
                echo '</tr>';
            }
            ?>
    </div>

</body>

</html>

<?php

