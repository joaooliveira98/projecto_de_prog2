<?php

$conn = mysqli_connect("localhost", "root", "password", "school_management");


if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if (isset($_POST['id'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM students WHERE id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "error";
}


mysqli_close($conn);
?>
