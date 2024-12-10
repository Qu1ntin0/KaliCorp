<?php
if (!isset($_SESSION)) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style3.css">
        <title>Acesso Restrito</title>
    </head>
    <body>
        <div class="container">
            <h1>Acesso Restrito</h1>
            <p>Você não pode acessar esta página porque não está logado.</p>
            <p><a href="index.php" class="login-btn">Clique aqui para logar</a></p>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>
