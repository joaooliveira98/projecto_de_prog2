<?php
// Establish database connection
$host = 'localhost';
$username = 'root';
$password = 'password';
$dbname = 'school_management';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('Database connection error: ' . mysqli_connect_error());
}

// Process login form submission
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validate user credentials
    $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        // Login successful
        // Redirect to the desired page
        header("Location: welcome.php");
        exit(); // Make sure to exit the script after redirecting
    } else {
        // Login failed
        $error = "Invalid username or password.";
    }
}

// Close database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <div class="container">
        <form method="POST" action="login.php" class="login-form">
            <h2>Login</h2>
            <?php if (isset($error)) { ?>
                <div class="error-message"><?php echo $error; ?></div>
            <?php } ?>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" name="login">Login</button>
        </form>
    </div>
</body>
</html>
