<?php
include "header.php";
include "../backend/db.php";

$dept = $conn->query("SELECT * FROM departments")->fetchAll();
$desg = $conn->query("SELECT * FROM designations")->fetchAll();

if(isset($_POST['save'])){
    $conn->prepare(
        "INSERT INTO employee(emp_name,address,department_id,designation_id)
         VALUES(?,?,?,?)"
    )->execute([
        $_POST['name'],
        $_POST['address'],
        $_POST['department'],
        $_POST['designation']
    ]);
    header("Location: employee_list.php");
}
?>

<h2>Add Employee</h2>
<form method="post">
    <input name="name" placeholder="Employee Name" required>
    <input name="address" placeholder="Address" required>

    <select name="department" required>
        <option value="">Select Department</option>
        <?php foreach($dept as $d){ ?>
            <option value="<?= $d['id'] ?>"><?= $d['department_name'] ?></option>
        <?php } ?>
    </select>

    <select name="designation" required>
        <option value="">Select Designation</option>
        <?php foreach($desg as $d){ ?>
            <option value="<?= $d['id'] ?>"><?= $d['designation_name'] ?></option>
        <?php } ?>
    </select>

    <button name="save">Save</button>
</form>

<?php include "footer.php"; ?>
