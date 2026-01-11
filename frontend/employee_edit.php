<?php
include "header.php";
include "../backend/db.php";

$id = $_GET['id'];

$dept = $conn->query("SELECT * FROM departments")->fetchAll();
$desg = $conn->query("SELECT * FROM designations")->fetchAll();

if (isset($_POST['update'])) {
    $stmt = $conn->prepare(
        "UPDATE employee 
         SET emp_name=?, address=?, department_id=?, designation_id=? 
         WHERE emp_id=?"
    );

    $stmt->execute([
        $_POST['name'],
        $_POST['address'],
        $_POST['department'],
        $_POST['designation'],
        $id
    ]);

    header("Location: employee_list.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM employee WHERE emp_id=?");
$stmt->execute([$id]);
$emp = $stmt->fetch();
?>

<h2>Edit Employee</h2>

<form method="post">
    <input name="name" value="<?= $emp['emp_name'] ?>" required>
    <input name="address" value="<?= $emp['address'] ?>" required>

    <select name="department" required>
        <option value="">Select Department</option>
        <?php foreach ($dept as $d) { ?>
            <option value="<?= $d['id'] ?>"
                <?= ($emp['department_id'] == $d['id']) ? 'selected' : '' ?>>
                <?= $d['department_name'] ?>
            </option>
        <?php } ?>
    </select>

    <select name="designation" required>
        <option value="">Select Designation</option>
        <?php foreach ($desg as $d) { ?>
            <option value="<?= $d['id'] ?>"
                <?= ($emp['designation_id'] == $d['id']) ? 'selected' : '' ?>>
                <?= $d['designation_name'] ?>
            </option>
        <?php } ?>
    </select>

    <button name="update">Update</button>
</form>

<?php include "footer.php"; ?>
