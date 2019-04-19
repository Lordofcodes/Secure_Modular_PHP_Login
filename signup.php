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
  <h1>Create User</h1>
  <?php if (isset($_GET['error'])) {
              echo '<div class="alert alert-danger" role="alert">' . $_GET['error'] . '</div>';
      }
              if (isset($_GET['success'])) {
                echo '<div class="alert alert-success" role="alert">' . $_GET['success'] . '</div>';
            }

            ?>
  <form action="includes/signup.inc.php" method='POST'>
    Username:
    <input type="text" name="username" value="<?php echo isset($_GET["username"]) ? $_GET["username"] : ''; ?>">
    Email:
    <input type="text" name="email" value="<?php echo isset($_GET["email"]) ? $_GET["email"] : ''; ?>">
    Password:
    <input type="password" name="password">
    <button type='Submit' name='create'>Sign Up</button>
  </form>

</body>

</html>