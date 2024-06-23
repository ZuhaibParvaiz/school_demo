<?php
require_once('./partials/header.php');
?>
<div class="table_create1">
    <h2>Student Profile</h2>
    <div class="student_profile">

        <?php
        // Include the database connection
        require_once('db.php');

        // Check if ID parameter is set and is a valid integer
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            // Prepare the SQL statement with a placeholder for the student ID
            $sql = "SELECT * FROM student 
                    JOIN classes ON student.class_id = classes.class_id 
                    WHERE student.id = ?";

            // Initialize a prepared statement
            $stmt = mysqli_prepare($connect, $sql);

            // Bind the parameter (student ID) to the prepared statement as a string
            mysqli_stmt_bind_param($stmt, "i", $_GET['id']);

            // Execute the statement
            mysqli_stmt_execute($stmt);

            // Get the result set
            $result = mysqli_stmt_get_result($stmt);

            // Check if a student was found
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
        ?>
                <img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Student Image" style="width:130px;height:130px;">
                <h3>Student Name : <span><?php echo htmlspecialchars($row['name']) ?></span></h3>
                <h3>Email : <span><?php echo htmlspecialchars($row['email']) ?></span></h3>
                <h3>Address : <span><?php echo htmlspecialchars($row['address']) ?></span></h3>
                <h3>Class Name : <span><?php echo htmlspecialchars($row['class_name']) ?></span></h3>
                <h3>Creation Date : <span><?php echo htmlspecialchars($row['created_at']) ?></span></h3>
        <?php
            } else {
                echo "<h2>No student found with ID: {$_GET['id']}</h2>";
            }

            // Close the prepared statement
            mysqli_stmt_close($stmt);
        } else {
            echo "<h2>Invalid student ID</h2>";
        }

        // Close the database connection
        mysqli_close($connect);
        ?>
    </div>
    <div>
        <a class="v1" href="index.php">Go Back</a>
        <a class="e1" href='update_student.php?id=<?php echo htmlspecialchars($row['id']); ?>'>Edit</a>
        <?php if (isset($row['id'])) : ?>
            <a class="d1" href='delete_student.php?id=<?php echo htmlspecialchars($row['id']); ?>'>Delete</a>
        <?php endif; ?>
    </div>
</div>