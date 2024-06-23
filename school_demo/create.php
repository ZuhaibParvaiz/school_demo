<?php
require_once('./partials/header.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('db.php'); // Include database connection code

    // Function to sanitize input data
    function sanitize($data)
    {
        return htmlspecialchars(strip_tags(trim($data)));
    }

    // Validate and sanitize POST data
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $address = sanitize($_POST['address']);
    $class_id = sanitize($_POST['class']);

    // Check if any required fields are empty
    if (empty($name) || empty($email) || empty($address) || empty($class_id) || empty($_FILES['image']['name'])) {
        echo "<script>alert('All fields are required.'); window.location.href = 'create.php';</script>";
        exit;
    }

    // Prepare current datetime
    $created_at = date('Y-m-d H:i:s');

    // Upload image
    $image = $_FILES['image']['name'];
    $ext = pathinfo($image, PATHINFO_EXTENSION);
    $allowedTypes = array("png", "jpg");
    $tempName = $_FILES['image']['tmp_name'];
    $targetPath = "uploads/" . $image;

    if (in_array($ext, $allowedTypes)) {
        if (move_uploaded_file($tempName, $targetPath)) {
            // Prepare and bind parameters
            $query = "INSERT INTO student (name, email, address, class_id, created_at, image) VALUES (?, ?, ?, ?, ?, ?)";
            $statement = mysqli_prepare($connect, $query);
            mysqli_stmt_bind_param($statement, "ssssss", $name, $email, $address, $class_id, $created_at, $image);

            // Execute the statement
            if (mysqli_stmt_execute($statement)) {
                echo "<script>alert('Student added successfully.'); window.location.href = 'http://localhost/school_demo/index.php';</script>";
                exit;
            } else {
                echo "Error: " . mysqli_error($connect);
            }
        } else {
            echo "Error uploading image.";
        }
    } else {
        echo "<script>alert('Invalid file type. Please upload a PNG or JPG file.'); window.location.href = 'http://localhost/school_demo/create.php';</script>";
    }

    // Close statement and connection

    if ($statement !== null) {
        mysqli_stmt_close($statement);
    }
    mysqli_close($connect);
}

?>

<div class="table_create">
    <form method="post" action="create.php" id="form" enctype="multipart/form-data" onsubmit="return validateForm()">
        <h1>Add Student</h1>
        <input type="text" name="name" placeholder="Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="text" name="address" placeholder="Address" required>
        <select name="class" class="select" required>
            <option value="" selected disabled> Select Class</option>
            <?php
            require_once('db.php');
            $sql = "SELECT * FROM classes";
            $result = mysqli_query($connect, $sql) or die("Query unsuccessful");
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['class_id'] . "'>" . $row['class_name'] . "</option>";
            }
            ?>
        </select>
        <input type="file" name="image" required>
        <input type="submit" value="+Add" class="add" id="insert_btn">
    </form>
    <div>
        <a class="v1" href="index.php">Go Back</a>
    </div>
</div>

<script>
    function validateForm() {
        var inputs = document.forms["form"].getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            if (inputs[i].hasAttribute("required") && inputs[i].value.trim() === "") {
                alert("Please fill in all required fields.");
                return false;
            }
        }
        var select = document.forms["form"]["class"];
        if (select.hasAttribute("required") && select.value === "") {
            alert("Please select a class.");
            return false;
        }
        return true;
    }
</script>