<?php
session_start();
include 'database.php';

if (!isset($_SESSION['loggedin']) || !$_SESSION['loggedin']) {
    header("Location: login.php");
    exit();
}

$result = $conn->query("SELECT * FROM students");

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="students_list.csv"');

//  file pointer connected to the output stream
$output = fopen('php://output', 'w');

//column headings
fputcsv($output, ['id','Name', 'Age', 'Mobile', 'Email', 'Gender', 'Address', 'Status']);

while ($row = $result->fetch_assoc()) {
    fputcsv($output, $row);
}

fclose($output);
exit();
?>
