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

    <style>
        .error {
            text-weight: bold;
            color: red;
        }
        .success {
      text-weight: bold;
      color: green;
    }
    </style>
</head>

<body>
    <h1>Create User</h1>
    <<div><?php if (isset($_GET['error'])) {
              echo '<p class="error">' . $_GET['error'] . '</p>';
      }
              if (isset($_GET['success'])) {
                echo '<p class="success">' . $_GET['success'] . '</p>';
            }

            ?></div>
    <form action="includes/add_student.inc.php" method='POST'>
        Username:
        <input type="text" name="username" value="<?php echo isset($_GET["username"]) ? $_GET["username"] : ''; ?>">
        Email:
        <input type="text" name="email" value="<?php echo isset($_GET["email"]) ? $_GET["email"] : ''; ?>">
        Password:
        <input type="password" name="password">
        Course:
        <select name = 'courses'>
            <option value="DCA">DCA</option>
            <option value="CCC">CCC</option>
            <option value="ADCA">ADCA</option>
            <option value="PGDCA">PGDCA</option>
            <option value="DFA">DFA</option>
        </select>
        Total Fees:
        <input type="number" name="total_fees" id="total_fees" onkeyup="get_balance_fees()" value="<?php echo isset($_GET["total_fees"]) ? $_GET["total_fees"] : ''; ?>" >
        Paid Fees:
        <input type="number" name="paid_fees" id="paid_fees" onkeyup="get_balance_fees()" value="<?php echo isset($_GET["paid_fees"]) ? $_GET["paid_fees"] : ''; ?>"><br><br>
        Balance Fees:
        <input type="number" name="balance_fees" id="balance_fees" value="<?php echo isset($_GET["balance_fees"]) ? $_GET["balance_fees"] : ''; ?>" >
     
        <button type='Submit' name='add_student'>Add Student</button>
    </form>

    <script>   
    function get_balance_fees(){
      var total_fees = document.getElementById("total_fees").value;
      var paid_fees  = document.getElementById("paid_fees").value;
      var balance_fees = document.getElementById("balance_fees");
      balance_fees.value = parseInt(total_fees) - parseInt(paid_fees);
      
    } 
    </script>
</body>

</html>