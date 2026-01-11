<?php
include "../backend/db.php";
$conn->query("DELETE FROM employee WHERE emp_id=".$_GET['id']);
header("Location: employee_list.php");
exit;
