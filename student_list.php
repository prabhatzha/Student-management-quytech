<?php 
session_start();
include 'header.php';
include 'navbar.php';
include 'database.php';
//print_r($_SESSION);die;
$result = $conn->query("SELECT * FROM students");
?>

<div class="container" style="margin-top: 100px;">
    <h2>Student List</h2>
    
    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
        <a href="student_register.php" class="btn btn-primary mb-3">Add Student</a>
        <a href="export_students.php" class="btn btn-secondary mb-3">Export as CSV</a> 
    <?php endif; ?>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Age</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Address</th>
                <th>Status</th>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                    <th>Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['mobile']; ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo $row['gender']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']): ?>
                        <td>
                            <a href="edit_student.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                            <a href="delete_student.php?id=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
