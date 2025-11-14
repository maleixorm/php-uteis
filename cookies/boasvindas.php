<?php 
    if(isset($_COOKIE['nome'])) {
        echo "<p>Bem-vindo, " . $_COOKIE['nome'] . "!</p>";
    }
?>