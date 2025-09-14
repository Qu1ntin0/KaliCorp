<?php
include('conexao.php');

$erro = ""; 

if(isset($_POST['email']) || isset($_POST['senha'])) {

    if(strlen($_POST['email']) == 0) {
        $erro = "Preencha seu e-mail";
    } else if(strlen($_POST['senha']) == 0) {
        $erro = "Preencha sua senha";
    } else {

        $email = $mysqli->real_escape_string($_POST['email']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: infos.php");

        } else {
            $erro = "Falha ao logar! E-mail ou senha incorretos";
        }

    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css'
rel='stylesheet'> 
    <link rel="stylesheet" href="style1.css">
    <title>Login</title>
</head>
<body>
<h1></h1>
    
    <form action="" method="POST">
        <p>
            <label>
            <i class="bx bx-envelope"></i> E-mail
            <input type="text" name="email">
            </label>
        </p>
        <p>
            <label>
            <i class="bx bxs-lock-alt"></i> Senha
            <input type="password" name="senha">
            </label>
        </p>
        <p>
            <button type="submit">Entrar</button>
        </p>
    </form>

    <?php if(!empty($erro)): ?>
        <p class="error-message">
            <?php echo $erro; ?>
        </p>
    <?php endif; ?>

</body>
</html>