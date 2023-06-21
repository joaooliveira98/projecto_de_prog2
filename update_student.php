<?php
session_start();

$conn = mysqli_connect("localhost", "root", "password", "school_management");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_POST['id'];
$nome = $_POST['nome'];
$genero = $_POST['genero'];
$idade = $_POST['idade'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];

$sql = "UPDATE students SET nome='$nome', genero='$genero', idade='$idade', email='$email', telefone='$telefone' WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    echo "success";
} else {
    echo "error";
}

mysqli_close($conn);
?>
