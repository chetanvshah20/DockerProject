<?php
$Host = "172.31.31.77";
$Database = "payroll_db";
$UserName = "root";
$Password = "Admin@123";

try
{
   $conn = new PDO(
        "mysql:host=$Host;dbname=$Database;charset=utf8",
       $UserName,
       $Password
   );
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Connection Failed: " . $e->getMessage());
}
?>
