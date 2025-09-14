<?php
include('protect.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style2.css">
    <title>Painel</title>
</head>
<body>
    <div class="container">
        <h1>Bem-vindo ao Painel</h1>
        <p>Olá, <?php echo $_SESSION['nome']; ?>! Você está logado.</p>
        <p><a href="logout.php" class="logout-btn">Sair</a></p>
    </div>
</body>
</html>
