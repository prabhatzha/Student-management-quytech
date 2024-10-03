<?php 
session_start();
include 'header.php';
include 'navbar.php';
include 'database.php';

$errorMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $status = $_POST['status'];

    if ($conn && !$conn->connect_error) {
        $stmt = $conn->prepare("INSERT INTO students (name, age, mobile, email, gender, address, status) VALUES (?, ?, ?, ?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("sisssss", $name, $age, $mobile, $email, $gender, $address, $status);
            $stmt->execute();

            header("Location: student_list.php");
            exit();
        } else {
            $errorMessage = "<div class='alert alert-danger'>Error preparing statement: " . $conn->error . "</div>";
        }
    } else {
        $errorMessage = "<div class='alert alert-danger'>Database connection error: " . $conn->connect_error . "</div>";
    }
}
?>

<div class="container" style="margin-top: 100px;">
    <h2>Register Student</h2>
    
    <?php if ($errorMessage): ?>
        <?php echo $errorMessage; ?>
    <?php endif; ?>

    <form method="POST">
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="col-md-6">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>
            <div class="col-md-6">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="text" class="form-control" id="mobile" name="mobile" required>
            </div>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select class="form-control" id="gender" name="gender" required>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="status" class="form-label">Status</label>
                <select class="form-control" id="status" name="status" required>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Register Student</button>
    </form>
</div>

<?php include 'footer.php'; ?>
