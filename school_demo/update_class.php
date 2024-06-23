<?php
require_once('./partials/header.php');
?>
<div class="table_create1">
    <h2>Class Detail</h2>
    <?php
    require_once('db.php');

    // Check if 'id' is set in the URL
    if (isset($_GET['id'])) {
        $class_id = $_GET['id']; // Assuming id is passed as 'id'

        // Fetch class data from database
        $sql = "SELECT * FROM classes WHERE class_id = {$class_id}";
        $result = mysqli_query($connect, $sql);

        // Check if a class with the given ID exists
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    ?>
            <div class="student_profile">
                <div class="table_create">
                    <form method="post" id="form" action="process_update_class.php">
                        <input type="hidden" name="class_id" value="<?php echo $row['class_id']; ?>">
                        <input placeholder="Class Name" type="text" name="class_name" value="<?php echo htmlspecialchars($row['class_name']); ?>">
                        <input type="submit" value="Update" name="Update1" class="add" id="insert_btn">
                    </form>
                </div>
            </div>
    <?php
        } else {
            echo "No class found with ID: $class_id";
        }
    } else {
        echo "Debug: Class ID (id) is not set in the URL. Current URL: " . $_SERVER['REQUEST_URI'];
    }
    ?>
</div>