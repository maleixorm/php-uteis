<?php
    include('conexao.php');


    if (isset($_FILES['arquivo'])) {
        $arquivo = $_FILES['arquivo'];
        if ($arquivo['error']) {
            die("Falha ao enviar arquivo");
        }
        if ($arquivo['size'] > 2097152) {
            die("Arquivo maior que o limite permitido para envio! (Limite: 2MB)");
        }
        $pasta = "arquivos/";
        $nomeDoArquivo = $arquivo['name'];
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

        if ($extensao != "jpg" && $extensao != "png") {
            die("Tipo de arquivo inválido! (Permitidos: jpg ou png)");
        }

        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

        $deuCerto = move_uploaded_file($arquivo['tmp_name'], $path);
        
        if ($deuCerto) {
            $mysqli->query("INSERT INTO arquivos (nome, path) VALUES ('$nomeDoArquivo', '$path')") or die($mysqli->error);
            echo "<p class='message'>Arquivo enviado com sucesso!";
        } else {
            die("Falha ao enviar arquivo");
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo</title>
</head>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="">Selecione o arquivo:</label>
        <input type="file" name="arquivo" id="">
        <button type="submit">Enviar arquivo</button>
    </form>
</body>
</html>