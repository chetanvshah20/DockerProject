<?php
include "header.php";
include "../backend/db.php";

$limit=5;
$page=$_GET['page']??1;
$start=($page-1)*$limit;
$search=$_GET['search']??'';

$total=$conn->prepare("
SELECT COUNT(*) FROM employee e
JOIN departments d ON e.department_id=d.id
JOIN designations g ON e.designation_id=g.id
WHERE e.emp_name LIKE ?
");
$total->execute(["%$search%"]);
$pages=ceil($total->fetchColumn()/$limit);

$stmt=$conn->prepare("
SELECT e.*,d.department_name,g.designation_name
FROM employee e
JOIN departments d ON e.department_id=d.id
JOIN designations g ON e.designation_id=g.id
WHERE e.emp_name LIKE ?
LIMIT $start,$limit
");
$stmt->execute(["%$search%"]);
$data=$stmt->fetchAll();
?>

<h2>Employees <a class="btn" href="employee_add.php">Add</a></h2>

<form>
<input name="search" value="<?= $search ?>" placeholder="Search">
<button>Search</button>
</form>

<table>
<tr>
   <th>Name</th>
   <th>Department</th>
   <th>Designation</th>
   <th>Action</th>
</tr>
<?php foreach($data as $r){ ?>
<tr>
<td><?= $r['emp_name'] ?></td>
<td><?= $r['department_name'] ?></td>
<td><?= $r['designation_name'] ?></td>
<td>
<a href="employee_edit.php?id=<?= $r['emp_id'] ?>">Edit</a> |
<a href="employee_delete.php?id=<?= $r['emp_id'] ?>" onclick="return confirm('Delete?')">Delete</a>
</td>
</tr>
<?php } ?>
</table>

<?php for($i=1;$i<=$pages;$i++){ ?>
<a class="btn" href="?page=<?= $i ?>&search=<?= $search ?>"><?= $i ?></a>
<?php } ?>

<?php include "footer.php"; ?>
