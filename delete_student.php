<?php 
session_start();
include 'header.php';
include 'navbar.php';
include 'database.php';

$id = $_GET['id'];

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    $stmt = $conn->prepare("DELETE FROM students WHERE id=?");
    $stmt->bind_param("i", $id);
    if ($stmt->execute()) {
        header("Location: student_list.php");
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }
} else {
    header("Location: login.php");
    exit();
}
?>
