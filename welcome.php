<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        /* style.css */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            display: grid;
            place-items: center;
            height: 100vh;
        }

        .content {
            max-width: 600px;
            background-color: #fff;
            border-radius: 5px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 20px;
        }

        h3 {
            color: #666;
            margin-bottom: 10px;
        }

        .buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 30px;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        button:active {
            background-color: #3e8e41;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript">
        function confirmAddStudent() {
            return confirm("Deseja adicionar estudante?");
        }
        function logout() {
          
            $.ajax({
                url: "logout.php",
                type: "POST",
                success: function(data) {
                    if (data === "success") {
                        
                        location.href = "login.php";
                    } else {
                        alert("Failed to logout.");
                    }
                },
                error: function() {
                    alert("Request failed.");
                }
            });
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="content">
            <h2>Bem vindo</h2>
            <h3>Escolha entre:</h3>
            <div class="buttons">
                <button onclick="if (confirmAddStudent()) location.href='add_student.html';">Adicionar estudantes</button>
                <button onclick="location.href='view_student.php';">Ver estudantes</button>
                <button onclick="logout();">Logout</button>
            </div>
        </div>
    </div>
</body>
</html>
