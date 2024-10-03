<?php 
session_start();
include 'header.php';
include 'navbar.php';
include 'database.php';

$id = $_GET['id'];
$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE students SET name=?, age=?, mobile=?, email=?, gender=?, address=?, status=? WHERE id=?");
    $stmt->bind_param("sisssssi", $name, $age, $mobile, $email, $gender, $address, $status, $id);
    if ($stmt->execute()) {
        header("Location: student_list.php");
        exit();
    } else {
        $errorMessage = "Error updating record: " . $stmt->error;
    }
}

$result = $conn->query("SELECT * FROM students WHERE id = $id");
$currentStudent = $result->fetch_assoc();
?>

<div class="container" style="margin-top: 100px;">
    <h2>Edit Student</h2>
    
    <?php if ($errorMessage): ?>
        <div class="alert alert-danger"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $currentStudent['name']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $currentStudent['email']; ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo $currentStudent['age']; ?>" required>
            </div>
            <div class="col-md-6">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile" value="<?php echo $currentStudent['mobile']; ?>" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo $currentStudent['address']; ?>" required>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male" <?php echo $currentStudent['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $currentStudent['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Active" <?php echo $currentStudent['status'] == 'Active' ? 'selected' : ''; ?>>Active</option>
                    <option value="Inactive" <?php echo $currentStudent['status'] == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Student</button>
    </form>
</div>

<?php include 'footer.php'; ?>
