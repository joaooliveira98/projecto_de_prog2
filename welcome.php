<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script type="text/javascript">
        function confirmAddStudent() {
            return confirm("Are you sure you want to add a student?");
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Welcome to the Student Management System</h2>
        <div class="buttons">
            <button onclick="if (confirmAddStudent()) location.href='add_student.html';">Add Student</button>
            <button onclick="location.href='view_student.php';">View Students</button>
        </div>
    </div>
</body>
</html>
