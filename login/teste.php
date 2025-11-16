<?php 

if (!isset($_SESSION)) {
    session_start();
    $_SESSION['nomeDoUsuario'] = "Marcos Aleixo";
}