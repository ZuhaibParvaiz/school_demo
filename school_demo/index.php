<?php
require_once('./partials/header.php');

?>
<div class="table_create1">
    <div style="display: flex; gap: 40px">
        <a href="create.php"> <input class="add" type="submit" value="+ Add Student"></a>
        <a href="manage_class.php"> <input class="add" type="submit" value="Manage Classes"></a>
    </div>
    <h2>Students</h2>
    <div class="student_table">
        <?php
        require_once('db.php');

        // SQL query to fetch student data with class name
        $sql = "SELECT * FROM student 
                JOIN classes ON student.class_id = classes.class_id";

        // Execute the query
        $result = mysqli_query($connect, $sql) or die("Query unsuccessful");

        // Check if there are any records found
        if (mysqli_num_rows($result) > 0) {
        ?>
            <table class="stu">
                <thead class="student_detail">
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Creation Date</th>
                        <th>Class Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetching data and displaying in table rows
                    while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <td><img src="uploads/<?php echo htmlspecialchars($row['image']); ?>" alt="Student Image" style="width:50px;height:50px;"></td>
                            <td><?php echo htmlspecialchars($row['name']) ?></td>
                            <td><?php echo htmlspecialchars($row['email']) ?></td>
                            <td><?php echo htmlspecialchars($row['created_at']) ?></td>
                            <td><?php echo htmlspecialchars($row['class_name']) ?></td>
                            <td>
                                <a class="v1" href='veiw_student.php?id=<?php echo htmlspecialchars($row['id']); ?>'>View</a>
                                <a class="e1" href='update_student.php?id=<?php echo htmlspecialchars($row['id']); ?>'>Edit</a>
                                <a class="d1" href='delete_student.php?id=<?php echo htmlspecialchars($row['id']); ?>'>Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else {
            echo "<h2>No records found</h2>";
        }

        // Close the database connection
        mysqli_close($connect);
        ?>
    </div>
</div>