<?php
session_start();
include('../_php/verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Felix Freitas Junior">
    <meta name="description" content="Sistema de controle do almoxarifado">
    <link rel="stylesheet" href="../_css/style.css">
    <title><?php echo $pageTitle; ?></title>
</head>
<body>
    <header>
        <img src="../_img/cehosp.jpeg" alt="Sua Imagem">
        <h1><?php echo $pageTitle; ?></h1>
        <p>Olá, <?php echo $_SESSION['email']; ?></p>
    </header>
    <br>
</body>
</html>
