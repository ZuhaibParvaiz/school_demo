<?php
require_once('./partials/header.php');
?>
<div class="table_create1">
    <h2>Student Profile</h2>
    <?php
    require_once('db.php');

    // Check if 'id' is set in the URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch student data from database
        $sql = "SELECT * FROM student WHERE id = {$id}";
        $result = mysqli_query($connect, $sql);

        // Check if a student with the given ID exists
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
    ?>
            <div class="student_profile">
                <div class="table_create">
                    <form method="post" id="form" action="process_update_student.php" enctype="multipart/form-data">
                        <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Student Image" style="width:130px;height:130px;">
                        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">

                        <input placeholder="Name" type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>">


                        <input placeholder="Email" type="email" name="email" value="<?php echo htmlspecialchars($row['email']); ?>">


                        <input placeholder="Address" type="text" name="address" value="<?php echo htmlspecialchars($row['address']); ?>">


                        <!-- Dropdown for class selection -->
                        <select name="class_id" class="select">
                            <option value="" selected disabled>Select Class</option>
                            <?php
                            // Query to fetch classes
                            $sql_classes = "SELECT * FROM classes";
                            $result_classes = mysqli_query($connect, $sql_classes);

                            // Display options for each class
                            while ($class_row = mysqli_fetch_assoc($result_classes)) {
                                $selected = ($class_row['class_id'] == $row['class_id']) ? 'selected' : '';
                                echo "<option value='{$class_row['class_id']}' $selected>{$class_row['class_name']}</option>";
                            }
                            ?>
                        </select>


                        <input placeholder="Image" type="file" name="image">

                        <input type="submit" value="Update" name="Update" class="add" id="insert_btn">
                    </form>
                </div>
            </div>
    <?php
        } else {
            echo "No student found with ID: $id";
        }
    } else {
        echo "Student ID is not set in the URL.";
    }
    ?>
    <div style="display: flex; flex-direction: row; justify-content: center; align-items: center; ">
        <a class="v1" href="index.php">HOME</a>
    </div>
</div>