<?php
    if (isset($_POST['email'])) {
        include('conexao.php');
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $mysqli->query("INSERT INTO senhas (email, senha) VALUES ('$email', '$senha')");
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
    <h2>Cadastrar Senha:</h2>
    <form action="" method="post">
        <input type="email" name="email" id="">
        <input type="password" name="senha" id="">
        <button type="submit">Cadastrar Usuário</button>
    </form>
</body>
</html>