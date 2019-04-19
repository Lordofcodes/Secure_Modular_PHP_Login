<?php
require 'includes/data.inc.php';
session_start();
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'user') {
    header("location: login.php?error=" . 'Access denied!');
    session_destroy();
    exit();
} else {
    $conn = DB::getInstance()->getDB();
    $stmt = $conn->prepare('SELECT * FROM student_details WHERE email = :email');
    $stmt->execute(['email' => $_GET['email']]);
}
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

        <h2 class="h2 text-center">User Dashboard</h2>
        <?= '<h3> Welcome ' . ucwords($_GET['username']) . '!</h3>'; ?>
        <form action="login.php" method='POST'>
            <button type='submi' class="btn btn-warning" name='logout'> Logout</button>
        </form>
        <?php
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        ?>
        <table class="table table-striped">
            <thead>
                <tr class="thead-dark">
                    <th scope="col"> Roll No.</th>
                    <th scope="col"> Username</th>
                    <th scope="col"> Email</th>
                    <th scope="col"> Course</th>
                    <th scope="col"> Total Fees</th>
                    <th scope="col"> Paid Fees </th>
                    <th scope="col"> Balanced Fees</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td scope='row'><?= $row['id'] ?></td>
                    <td><?= $row['username'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['course'] ?></td>
                    <td><?= $row['total_fees'] ?></td>
                    <td><?= $row['paid_fees'] ?></td>
                    <td><?= $row['balance_fees'] ?></td>
                </tr>
            </tbody>
        </table>
        </form>
    </div>
</body>

</html>