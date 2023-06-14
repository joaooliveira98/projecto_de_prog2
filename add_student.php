<?php
// Establish MySQL connection
$conn = mysqli_connect("localhost", "root", "password", "school_management");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Process form data
$name = $_POST['name'];
$roll_number = $_POST['roll_number'];
$class = $_POST['class'];
$section = $_POST['section'];

// Insert data into the students table
$sql = "INSERT INTO students (name, roll_number, class, section) VALUES ('$name', '$roll_number', '$class', '$section')";

if (mysqli_query($conn, $sql)) {
    echo "Student added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
// Close the database connection
mysqli_close($conn);
?>
