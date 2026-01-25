<?php
session_start();
include "backend/db.php";

if (isset($_POST['login'])) {
    $stmt = $conn->prepare("SELECT * FROM user WHERE username=? AND password=?");
    $stmt->execute([$_POST['username'], $_POST['password']]);

    if ($stmt->rowCount() == 1) {
        $_SESSION['user'] = $_POST['username'];
        header("Location: frontend/dashboard.php");
        exit;
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Payroll Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="login-body">
<div class="login-box">
    <h2>Payroll Login</h2>
    <form method="post">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button name="login">Login</button>
        <p style="color:red"><?= $error ?? '' ?></p>
    </form>
</div>
</body>
</html>
