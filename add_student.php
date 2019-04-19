<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
  header("location: login.php?error=" . 'Access denied!');
  session_destroy();
  exit();
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
    <div class="col-md-6 mx-auto">
    <h2 class="h2 text-center">Add Student</h2>
    <?php if (isset($_GET['error'])) {
      echo '<div class="alert alert-danger" role="alert">' . $_GET['error'] . '</div>';
    }
    if (isset($_GET['success'])) {
      echo '<div class="alert alert-success" role="alert">' . $_GET['success'] . '</div>';
    }

    ?>
    <form action="includes/add_student.inc.php" method='POST'>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="username">Username</label>
          <input class="form-control" type="text" name="username" id="username" value="<?php echo isset($_GET["username"]) ? $_GET["username"] : ''; ?>">
        </div>
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input class="form-control" type="email" name="email" id="email" value="<?php echo isset($_GET["email"]) ? $_GET["email"] : ''; ?>">
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="password">Password</label>
          <input class="form-control" id="password" type="password" name="password">
        </div>
        <div class="form-group col-md-6">
          <label for="course">Course</label>
          <select name="courses" class="form-control" id="course">
            <option value="DCA">DCA</option>
            <option value="CCC">CCC</option>
            <option value="ADCA">ADCA</option>
            <option value="PGDCA">PGDCA</option>
            <option value="DFA">DFA</option>
          </select>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="total_fees">Total Fees</label>
          <input class="form-control" type="number" name="total_fees" id="total_fees" onkeyup="get_balance_fees()" value="<?php echo isset($_GET["total_fees"]) ? $_GET["total_fees"] : ''; ?>">
        </div>
        <div class="form-group col-md-4">
          <label for="paid_fees">Paid Fees</label>
          <input class="form-control" type="number" name="paid_fees" id="paid_fees" onkeyup="get_balance_fees()" value="<?php echo isset($_GET["paid_fees"]) ? $_GET["paid_fees"] : ''; ?>"><br><br>
        </div>
        <div class="form-group col-md-4">
          <label for="balance_fees">Balance Fees</label>
          <input class="form-control" type="number" name="balance_fees" id="balance_fees" value="<?php echo isset($_GET["balance_fees"]) ? $_GET["balance_fees"] : ''; ?>">
        </div>
      </div>
      <div class="col text-center">
      <button class="btn btn-primary"  type='Submit' name='add_student'>Add Student</button>
    </div>
      
    </form>
    </div>
  </div>

  <script>
    function get_balance_fees() {
      var total_fees = document.getElementById("total_fees").value;
      var paid_fees = document.getElementById("paid_fees").value;
      var balance_fees = document.getElementById("balance_fees");
      balance_fees.value = parseInt(total_fees) - parseInt(paid_fees);

    }
  </script>
</body>

</html>