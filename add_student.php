<?php
session_start();

$conn = mysqli_connect("localhost", "root", "password", "school_management");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$nome = $_POST['nome'];
$genero = $_POST['genero'];
$idade = $_POST['idade'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    
    $queryEmail = "SELECT * FROM students WHERE email = '$email'";
    $resultEmail = mysqli_query($conn, $queryEmail);

    if (mysqli_num_rows($resultEmail) > 0) {
        
        echo "O e-mail já está cadastrado.";
        echo "<script>window.history.back();</script>";
        exit(); 
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        echo "O e-mail fornecido não é válido.";
        echo "<script>window.history.back();</script>";
        exit(); 
    }

    
    $queryTelefone = "SELECT * FROM students WHERE telefone = '$telefone'";
    $resultTelefone = mysqli_query($conn, $queryTelefone);

    if (mysqli_num_rows($resultTelefone) > 0) {
       
        echo "O número de telefone já está cadastrado.";
        echo "<script>window.history.back();</script>";
        exit(); 
    } elseif (!preg_match("/^9\d{8}$/", $telefone)) {
        
        echo "O número de telefone fornecido não é válido.";
        echo "<script>window.history.back();</script>";
        exit(); 
    } else {
        $sql = "INSERT INTO students (nome, genero, idade, email, telefone) VALUES ('$nome', '$genero', '$idade', '$email', '$telefone')";

        if (mysqli_query($conn, $sql)) {
            echo "Estudante adicionado com sucesso!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}

mysqli_close($conn);
?>

<html>
<head>
    <title>Ver Estudantes</title>
    <style>
        .buttons {
            text-align: center;
            margin-top: 20px;
        }

        .buttons button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            border-radius: 5px;
        }

        .buttons button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="buttons">
    <button onclick="if (confirm('Deseja adicionar estudante?')) { location.href='add_student.html'; } else { location.href='view_student.php'; }">Adicionar Estudante</button>
</div>
</body>
</html>