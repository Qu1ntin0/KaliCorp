<?php

$servername = "localhost";
$username = "root";
$password = "";   
$dbname = "dados_usuario";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idade = $conn->real_escape_string($_POST['idade']);
    $sexo = $conn->real_escape_string($_POST['Sexo']);
    $peso = $conn->real_escape_string($_POST['peso']);
    $altura = $conn->real_escape_string($_POST['altura']);

    $sql = "INSERT INTO perfil (idade, sexo, peso, altura) VALUES ('$idade', '$sexo', '$peso', '$altura')";

    if ($conn->query($sql) === TRUE) {
        header("Location: interface.php");
    } else {
        echo "Erro: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>