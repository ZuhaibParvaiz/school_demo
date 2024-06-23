<?php

$connect = mysqli_connect("localhost", "root", "", "school_db");
// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
} else {
    //echo "Connected successfully";
}
