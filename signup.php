<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <style>
    .error {
      text-weight: bold;
      color: red;
    }
    </style>
</head>
<body>
    <h1>Create User</h1>
    <div><?php if (isset($_GET['error'])) {
              echo '<p class="error">' . $_GET['error'] . '</p>';
            }

            ?></div>
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