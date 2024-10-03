<?php 
include 'header.php';
include 'navbar.php';
include 'database.php';

$errorMessage = ''; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['cnfpass'];

    // Validate password confirmation
    if ($password !== $confirmPassword) {
        $errorMessage = "<div class='alert alert-danger'>Passwords do not match!</div>";
    } else {
        if ($conn && !$conn->connect_error) {
            $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            if ($stmt) {
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $stmt->bind_param("sss", $name, $email, $hashedPassword);
                $stmt->execute();

                // Redirect after 5 seconds
                echo "<div class='alert alert-success'>Registration successful! You will be redirected to login in <span id='countdown'>5</span> seconds.</div>";
                echo "<script>
                    let countdown = 5;
                    let countdownElement = document.getElementById('countdown');
                    let interval = setInterval(() => {
                        countdown--;
                        countdownElement.textContent = countdown;
                        if (countdown === 0) {
                            clearInterval(interval);
                            window.location.href = 'login.php'; // Redirect to login page
                        }
                    }, 1000); // Update every 1 second
                </script>";

                // No need to continue script after displaying the message and countdown
                exit();
            } else {
                $errorMessage = "<div class='alert alert-danger'>Error preparing statement: " . $conn->error . "</div>";
            }
        } else {
            $errorMessage = "<div class='alert alert-danger'>Database connection error: " . $conn->connect_error . "</div>";
        }
    }
}
?>

<div class="container">
    <?php if ($errorMessage): ?>
        <?php echo $errorMessage; ?>
    <?php endif; ?>

    <form method="POST"> 
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="cnfpass" class="form-label">Confirm Password</label>
            <input type="password" class="form-control" id="cnfpass" name="cnfpass" required>
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
    </form>
    <div class="mt-3">
    <p>Already have an account? <a href="login.php">Login here</a></p>
</div>

</div>

<?php include 'footer.php'; ?>
