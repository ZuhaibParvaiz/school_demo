<?php
ob_start();
require_once('db.php');

if (isset($_POST['Update'])) {
    $id = $_POST['id'];

    // Sanitize input data
    $name = mysqli_real_escape_string($connect, $_POST['name']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $class_id = isset($_POST['class_id']) ? (int)$_POST['class_id'] : 0;
    $address = mysqli_real_escape_string($connect, $_POST['address']);
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0; // Assuming id is passed via POST

    // Handle image upload
    $image = $_FILES['image']['name'];
    $allowedTypes = array("jpeg", "png", "jpg");
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $tempName = $_FILES['image']['tmp_name'];
    $targetPath = "uploads/" . $image;

    $updateImage = "";
    if (!empty($image) && in_array($ext, $allowedTypes)) {
        if (move_uploaded_file($tempName, $targetPath)) {
            $updateImage = ", image='$image'";
        } else {
            echo "Error uploading the file.";
            exit;
        }
    }

    // SQL update query
    $sql = "UPDATE student SET 
            name = '$name', 
            email = '$email', 
            class_id = $class_id, 
            address = '$address'
            $updateImage
            WHERE id = $id";

    if (mysqli_query($connect, $sql)) {
        // Redirect to student list or wherever appropriate after successful update
        header("Location: http://localhost/school_demo/index.php");
        exit;
    } else {
        echo "Error updating record: " . mysqli_error($connect);
    }

    mysqli_close($connect);
}
