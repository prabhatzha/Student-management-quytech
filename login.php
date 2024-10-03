<?php
session_start(); 
include 'header.php';
include 'navbar.php';
include 'database.php'; 

$errorMessage = ''; // for error messages
$email = ''; // retain the entered email

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email']; 
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email); 
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Verify password with the hashed password in the database
        if (password_verify($password, $user['password'])) {
             // Setting session variables for the logged-in user
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['loggedin'] = true; 

            header("Location: student_list.php");
            exit(); 
        } else {
            $errorMessage = "<div class='alert alert-danger'>Invalid password. Please try again.</div>";
        }
    } else {
        $errorMessage = "<div class='alert alert-danger'>No account found with this email.</div>";
    }
}
?>

<div class="container">
    <?php if ($errorMessage): ?>
        <?php echo $errorMessage; ?>
    <?php endif; ?>

    <form method="POST" action="login.php">
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
    <div class="mt-3">
        <p>Don't have an account? <a href="register.php">Create an account</a></p>
    </div>
</div>

<?php include 'footer.php'; ?>
