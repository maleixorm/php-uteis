<?php
    if (isset($_POST['nome'])) {
        $vencimento = time() + (30 * 86400);
        setcookie("nome", $_POST['nome'], $vencimento);
        header("Location: boasvindas.php");
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="" method="post">
        <p>Qual é o seu nome?</p>
        <input type="text" name="nome" id="">
        <button type="submit">Salvar</button>
    </form>
</body>
</html>