<?php
// Establish MySQL connection
$conn = mysqli_connect("localhost", "root", "password", "school_management");

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve data from the students table
$sql = "SELECT * FROM students";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            padding: 20px;
        }
    

        h2 {
            color: #333;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <h2>View Students</h2>
    <?php
    // Display the data in a table
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Roll Number</th><th>Class</th><th>Section</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['name'] . "</td>";
            echo "<td>" . $row['roll_number'] . "</td>";
            echo "<td>" . $row['class'] . "</td>";
            echo "<td>" . $row['section'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No students found.";
    }
    ?>

</body>
</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
