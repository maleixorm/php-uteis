<?php
    include('conexao.php');

    if (isset($_GET['deletar'])) {
        $id = intval($_GET['deletar']);
        $sql = $mysqli->query("SELECT * FROM arquivos WHERE id = '$id'") or die ($mysqli->error);
        $arquivo = $sql->fetch_assoc();
        if (unlink($arquivo['path'])) {
            $delete = $mysqli->query("DELETE FROM arquivos WHERE id = '$id'") or die ($mysqli->error);
            if ($delete) {
                echo "<p>Arquivo excluído com sucesso!</p>";
            }
        } 
    }

    function enviarArquivo($error, $size, $name, $tmp_data) {
        include('conexao.php');
        if ($error) {
            die("Falha ao enviar arquivo");
        }
        if ($size > 2097152) {
            die("Arquivo maior que o limite permitido para envio! (Limite: 2MB)");
        }
        $pasta = "arquivos/";
        $nomeDoArquivo = $name;
        $novoNomeDoArquivo = uniqid();
        $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

        if ($extensao != "jpg" && $extensao != "png") {
            die("Tipo de arquivo inválido! (Permitidos: jpg ou png)");
        }

        $path = $pasta . $novoNomeDoArquivo . "." . $extensao;

        $deuCerto = move_uploaded_file($tmp_data, $path);
        
        if ($deuCerto) {
            $mysqli->query("INSERT INTO arquivos (nome, path) VALUES ('$nomeDoArquivo', '$path')") or die($mysqli->error);
            return true;
        } else {
            return false;
        }
    }

    if (isset($_FILES['arquivos'])) {
        $arquivos = $_FILES['arquivos'];
        $tudo_certo = true;
        foreach ($arquivos['name'] as $index => $arq) {
            $tudoCerto = enviarArquivo($arquivos['error'][$index], $arquivos['size'][$index], $arquivos['name'][$index], $arquivos['tmp_name'][$index]);
            if (!$tudoCerto) {
                $tudo_certo = false;
            }
        }
        if ($tudo_certo) {
            echo "<p>Todos os arquivos foram enviados com sucesso!</p>";
        } else {
            echo "<p>Falha ao enviar um ou mais arquivos</p>";
        }
    }

    $sql = $mysqli->query("SELECT * FROM arquivos") or die ($mysqli->error);
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
        <input multiple type="file" name="arquivos[]" id="">
        <button type="submit">Enviar arquivo</button>
    </form>
    <br>
    <h1>Lista de Arquivos</h1>
    <table border="1" cellpadding="10">
        <thead>
            <th>Preview</th>
            <th>Arquivo</th>
            <th>Data de Envio</th>
            <th>Deletar</th>
        </thead>
        <tbody>
            <?php 
                while ($arquivo = $sql->fetch_assoc()) {
            ?>
                <tr>
                    <td><img src="<?= $arquivo['path']; ?>" width="50"></td>
                    <td><a href="<?= $arquivo['path']; ?>" target="_blank"><?= $arquivo['nome'] ?></a></td>
                    <td><?= date("d/m/Y H:i", strtotime($arquivo['data_upload'])); ?></td>
                    <td><a href="index.php?deletar=<?= $arquivo['id']; ?>">Deletar</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    
</body>
</html>