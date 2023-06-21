<?php
session_start();

$conn = mysqli_connect("localhost", "root", "password", "school_management");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $genero = $_POST['genero'];
    $idade = $_POST['idade'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $updateSql = "UPDATE students SET nome='$nome', genero='$genero', idade='$idade', email='$email', telefone='$telefone' WHERE id='$id'";
    if (mysqli_query($conn, $updateSql)) {
        echo "success";
    } else {
        echo "error";
    }
    exit;
}

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

        .delete-button,
        .edit-button {
            background-color: #f44336;
            color: #fff;
            border: none;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .delete-button:hover,
        .edit-button:hover {
            background-color: #d32f2f;
        }

        .save-button,
        .cancel-button {
            background-color: #4CAF50;
            color: #fff;
            border: none;
            padding: 8px 12px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .save-button:hover,
        .cancel-button:hover {
            background-color: #45a049;
        }

        .edit-input {
            width: 100%;
            padding: 6px 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .buttons {
  display: flex;
  justify-content: left;
  margin-top: 20px;
}

.buttons button {
  background-color: #4CAF50;
  color: #fff; 
  border: none; 
  padding: 10px 20px; 
  font-size: 16px;
  cursor: pointer; 
  border-radius: 4px; 
  margin: 0 10px; 
}

.buttons button:hover {
  background-color: #45a049; 
}
  
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".delete-button").click(function () {
                var id = $(this).data("id");
                if (confirm("Deseja deletar este estudante?")) {
                    $.ajax({
                        url: "delete.php",
                        type: "POST",
                        data: { id: id },
                        success: function (data) {
                            if (data === "success") {
                                $("#row-" + id).remove();
                            } else {
                                alert("Falha ao deletar estudante.");
                            }
                        },
                        error: function () {
                            alert("Erro na solicitação.");
                        }
                    });
                }
            });

            $(document).on("click", ".edit-button", function() {
    var editButton = $(this);
    var id = editButton.data("id");

    var nome = $("#nome-" + id).text();
    var genero = $("#genero-" + id).text();
    var idade = $("#idade-" + id).text();
    var email = $("#email-" + id).text();
    var telefone = $("#telefone-" + id).text();

    $("#nome-" + id).html("<input type='text' id='edit-nome-" + id + "' value='" + nome + "'>");
    $("#genero-" + id).html("<input type='text' id='edit-genero-" + id + "' value='" + genero + "'>");
    $("#idade-" + id).html("<input type='text' id='edit-idade-" + id + "' value='" + idade + "'>");
    $("#email-" + id).html("<input type='text' id='edit-email-" + id + "' value='" + email + "'>");
    $("#telefone-" + id).html("<input type='text' id='edit-telefone-" + id + "' value='" + telefone + "'>");

    var saveButton = $("<button class='save-button' data-id='" + id + "'>Save</button>");
    var cancelButton = $("<button class='cancel-button' data-id='" + id + "'>Cancel</button>");
    editButton.parent().html(saveButton);
    editButton.parent().append(cancelButton);
});

$(document).on("click", ".save-button", function() {
    var saveButton = $(this);
    var id = saveButton.data("id");

    var nome = $("#edit-nome-" + id).val();
    var genero = $("#edit-genero-" + id).val();
    var idade = $("#edit-idade-" + id).val();
    var email = $("#edit-email-" + id).val();
    var telefone = $("#edit-telefone-" + id).val();

    $.ajax({
        url: "update_student.php",
        type: "POST",
        data: { id: id, nome: nome, genero: genero, idade: idade, email: email, telefone: telefone },
        success: function(data) {
            if (data === "success") {
                $("#nome-" + id).text(nome);
                $("#genero-" + id).text(genero);
                $("#idade-" + id).text(idade);
                $("#email-" + id).text(email);
                $("#telefone-" + id).text(telefone);

                var editButton = $("<button class='edit-button' data-id='" + id + "'>Edit</button>");
                var deleteButton = $("<button class='delete-button' data-id='" + id + "'>Delete</button>");
                saveButton.parent().html(editButton);
                saveButton.parent().append(deleteButton);
            } else {
                alert("Falha ao editar estudante.");
            }
        },
        error: function() {
            alert("Erro na solicitação.");
        }
    });
});

$(document).on("click", ".cancel-button", function() {
    var cancelButton = $(this);
    var id = cancelButton.data("id");

    var nome = $("#edit-nome-" + id).attr("value");
    var genero = $("#edit-genero-" + id).attr("value");
    var idade = $("#edit-idade-" + id).attr("value");
    var email = $("#edit-email-" + id).attr("value");
    var telefone = $("#edit-telefone-" + id).attr("value");

    $("#nome-" + id).text(nome);
    $("#genero-" + id).text(genero);
    $("#idade-" + id).text(idade);
    $("#email-" + id).text(email);
    $("#telefone-" + id).text(telefone);

    var editButton = $("<button class='edit-button' data-id='" + id + "'>Edit</button>");
    var deleteButton = $("<button class='delete-button' data-id='" + id + "'>Delete</button>");
    cancelButton.parent().html(editButton);
    cancelButton.parent().append(deleteButton);
});

        });
    </script>
</head>
<body>
    <h2>View Students</h2>
    <?php
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Nome</th><th>Gênero</th><th>Idade</th><th>Email</th><th>Telefone</th><th>Edit</th><th>Delete</th></tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr id='row-" . $row['id'] . "'>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td id='nome-" . $row['id'] . "'>" . $row['nome'] . "</td>";
            echo "<td id='genero-" . $row['id'] . "'>" . $row['genero'] . "</td>";
            echo "<td id='idade-" . $row['id'] . "'>" . $row['idade'] . "</td>";
            echo "<td id='email-" . $row['id'] . "'>" . $row['email'] . "</td>";
            echo "<td id='telefone-" . $row['id'] . "'>" . $row['telefone'] . "</td>";
            echo "<td><button class='edit-button' id='edit-button-" . $row['id'] . "' data-id='" . $row['id'] . "'>Edit</button></td>";
            echo "<td><button class='delete-button' id='delete-button-" . $row['id'] . "' data-id='" . $row['id'] . "'>Delete</button></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Não encontrado qualquer registro!!";
    }
    ?>
    <div class="buttons">
        <button onclick="if (confirm('Deseja adicionar estudante?')) location.href='add_student.html';">Adicionar Estudante</button>
        <button onclick="location.href='welcome.php';">Pagina Inicial</button>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>
