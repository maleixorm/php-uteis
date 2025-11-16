<?php
    if (isset($_POST['email'])) {
        include('conexao.php');
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $sql = "SELECT * FROM senhas WHERE email = '$email' LIMIT 1";
        $sql_exec = $mysqli->query($sql) or die($mysqli->error);
        
        $usuario = $sql_exec->fetch_assoc();
        $hash = $usuario['senha'];
        if(password_verify($senha, $hash)) {
            if (!isset($_SESSION)) {
                session_start();
                $_SESSION['usuario'] = $usuario['id'];
                header("Location: index.php");
            }
        } else {
            echo "Falha ao logar! Senha ou e-mail incorretos!";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>
</head>
<body>
    <h2>Login:</h2>
    <form action="" method="post">
        <div class="form-control">
            <label for="email">Email:</label>
            <input type="email" name="email" id="">
        </div>
        <div class="form-control">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="">
        </div>
        <button type="submit">Logar</button>
    </form>
</body>
</html>