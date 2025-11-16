<?php
    include('conexao.php');
    if (!isset($_SESSION)) {
        session_start();
    }

    if (!isset($_SESSION['usuario'])) {
        die("Você não está logado. <a href='login.php'>Clique aqui</a> para logar.");
    }

    if (isset($_POST['email'])) {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        $mysqli->query("INSERT INTO senhas (nome, email, senha) VALUES ('$nome', '$email', '$senha')");
    }

    $id = $_SESSION['usuario'];
    $sql = $mysqli->query("SELECT * FROM senhas WHERE id = '$id'") or die($mysqli->error);
    $usuario = $sql->fetch_assoc();
 ?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Login</title>
</head>
<body>
    <h1>Bem-vindo, <?= $usuario['nome']; ?></h1>
    <h2>Cadastro de Usuários:</h2>
    <form action="" method="post">
        <div class="form-control">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="">
        </div>
        <div class="form-control">
            <label for="email">Email:</label>
            <input type="email" name="email" id="">
        </div>
        <div class="form-control">
            <label for="senha">Senha</label>
            <input type="password" name="senha" id="">
        </div>
        <button type="submit">Cadastrar Usuário</button>
    </form>
    <p><a href="logout.php">Sair</a></p>
</body>
</html>