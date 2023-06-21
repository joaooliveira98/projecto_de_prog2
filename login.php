<?php
session_start();

$host = 'localhost';
$username = 'root';
$password = 'password';
$dbname = 'school_management';

$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn) {
    die('Database connection error: ' . mysqli_connect_error());
}



if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    
    $query = "SELECT * FROM login WHERE username = '$username' AND password = '$password'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        
        header("Location: welcome.php");
        exit();
    } else {
        
        $error = "Username ou password errada.";
    }
}


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
