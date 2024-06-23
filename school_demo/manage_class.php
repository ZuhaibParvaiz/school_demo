<?php
require_once('./partials/header.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('db.php'); // Include database connection code

    // Validate class_name
    $class_name = trim($_POST['class_name']);
    if (empty($class_name)) {
        die("Error: Class name cannot be empty.");
    }

    // Prepare current datetime
    $created_at = date('Y-m-d H:i:s');

    // Prepare and bind parameters
    $query = "INSERT INTO classes (class_name, created_at) VALUES (?, ?)";
    $statement = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($statement, "ss", $class_name, $created_at);

    // Execute the statement
    if (mysqli_stmt_execute($statement)) {
        echo "Data added successfully";
    } else {
        echo "Error: " . mysqli_error($connect);
    }

    // Close statement
    mysqli_stmt_close($statement);
    mysqli_close($connect);

    // Redirect after successful insertion
    echo "<script>alert('Class added successfully.'); window.location.href = 'http://localhost/school_demo/manage_class.php';</script>";
    exit;
}
?>

<div class="table_create" style="padding: 30px;">
    <h2>Class Details</h2>
    <div class="">
        <?php
        require_once('db.php');
        $sql = "SELECT * FROM classes";
        $result = mysqli_query($connect, $sql) or die("query unsuccessful");
        if (mysqli_num_rows($result) > 0) {

        ?>
            <table class="class_detail">
                <div class="">
                    <thead class="">
                        <th>Class ID</th>
                        <th>Class Name</th>
                        <th>Creation Date</th>

                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = mysqli_fetch_assoc($result)) {


                        ?>
                            <tr>
                                <td><?php echo $row['class_id'] ?></td>
                                <td><?php echo $row['class_name'] ?></td>
                                <td><?php echo $row['created_at'] ?></td>

                                <td>

                                    <a class="e1" href='update_class.php?id=<?php echo htmlspecialchars($row['class_id']); ?>'>Edit</a>
                                    <a class="d1" href='delete_class.php?id=<?php echo htmlspecialchars($row['class_id']); ?>'>Delete</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </div>
            </table>
    </div>
</div>

<?php } else {
            echo "<h2> No record found </h2>";
        }
        mysqli_close($connect);
?>
<form method="post" action="manage_class.php" id="add_class" onsubmit="return validateForm()">
    <div id="add_class1">
        <span>Add class</span>
        <input type="text" name="class_name" id="class_name" style="width: 400px;" placeholder="Name" required>
        <input type="submit" value="+Add" id="insert_btn">
    </div>
</form>

<script>
    function validateForm() {
        var className = document.getElementById('class_name').value.trim();
        if (className === '') {
            alert('Please enter a class name.');
            return false;
        }
        return true;
    }
</script>

<div style="display: flex; flex-direction: row; justify-content: center; align-items: center; ">
    <a class="v1" href="index.php">HOME</a>
</div>