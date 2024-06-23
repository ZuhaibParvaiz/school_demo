<?php
// Establish database connection (assuming $connect is already initialized)
require_once('db.php');

// Check if ID is provided and is numeric
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    // Sanitize the ID
    $id = intval($_GET['id']);

    // Prepare the delete statement with a prepared statement
    $sql = "DELETE FROM student WHERE id = ?";

    // Prepare statement
    $stmt = mysqli_prepare($connect, $sql);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Check if deletion was successful
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Deletion successful
        mysqli_stmt_close($stmt);
        mysqli_close($connect);
        echo "<script>alert('Student deleted successfully.'); window.location.href = 'http://localhost/school_demo/index.php';</script>";
        exit;
    } else {
        // Deletion unsuccessful
        mysqli_stmt_close($stmt);
        mysqli_close($connect);
        die("Unsuccessful deletion");
    }
} else {
    // ID not provided or not numeric
    die("Invalid ID");
}
