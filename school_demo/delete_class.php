<?php

// Validate input
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $class_id = $_GET['id'];
} else {
    die("Invalid input");
}

require_once('db.php'); // Include database connection code

// Prepare the DELETE statement with a placeholder for the parameter
$sql = "DELETE FROM classes WHERE class_id = ?";
$stmt = mysqli_prepare($connect, $sql);

// Bind the parameter to the placeholder
mysqli_stmt_bind_param($stmt, 'i', $class_id);

// Execute the statement
mysqli_stmt_execute($stmt);

// Check if the deletion was successful
if (mysqli_stmt_affected_rows($stmt) > 0) {
    // header("Location: http://localhost/school_demo/manage_class.php");
} else {
    echo "Delete operation unsuccessful";
}

// Close the statement and database connection
mysqli_stmt_close($stmt);
mysqli_close($connect);
echo "<script>alert('Class deleted successfully.'); window.location.href = 'http://localhost/school_demo/manage_class.php';</script>";
exit;
