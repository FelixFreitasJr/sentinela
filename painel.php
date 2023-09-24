<?php
session_start();
include('verifica_login.php');
?>
<h2>Olá, <?php print_r($_SESSION['email']);?></h2>
<h2><a href="logout.php">Sair</a></h2>

<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <meta name="author" content="Felix Freitas Junior">
    <meta name="description" content="Sistema de controle do almoxarifado">
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    
</body>
</html>