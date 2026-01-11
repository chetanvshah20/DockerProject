<?php
include "header.php";
include "../backend/db.php";

$emp = $conn->query("SELECT COUNT(*) FROM employee")->fetchColumn();
$dept = $conn->query("SELECT COUNT(*) FROM departments")->fetchColumn();
$salary = $conn->query("SELECT IFNULL(SUM(net_salary),0) FROM salary_details")->fetchColumn();
?>

<h2>Dashboard</h2>

<div class="cards">
    <div class="card">Employees<br><b><?= $emp ?></b></div>
    <div class="card">Departments<br><b><?= $dept ?></b></div>
    <div class="card">Total Salary<br><b><?= $salary ?></b></div>
</div>

<canvas id="barChart"></canvas>
<canvas id="pieChart"></canvas>

<script>
new Chart(barChart,{
    type:'bar',
    data:{
        labels:['Employees','Departments'],
        datasets:[{ data:[<?= $emp ?>,<?= $dept ?>] }]
    }
});
new Chart(pieChart,{
    type:'pie',
    data:{
        labels:['Total Salary'],
        datasets:[{ data:[<?= $salary ?>] }]
    }
});
</script>

<?php include "footer.php"; ?>
