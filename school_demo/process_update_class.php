<?php
ob_start();
require_once('db.php');

if (isset($_POST['Update1'])) {
    // Sanitize input data
    $class_id = isset($_POST['class_id']) ? (int)$_POST['class_id'] : 0; // Assuming id is passed via POST
    $class_name = mysqli_real_escape_string($connect, $_POST['class_name']);

    // SQL update query
    $sql = "UPDATE classes SET class_name = '$class_name' WHERE class_id = $class_id";

    if (mysqli_query($connect, $sql)) {
        // Redirect to student list or wherever appropriate after successful update
        header("Location: http://localhost/school_demo/manage_class.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($connect);
    }

    mysqli_close($connect);
}
