<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('../_include/head.php'); ?>
    <link rel="stylesheet" href="_css/style.css">
    <script src="_js/script.js"></script>
    <title>Login</title>
</head>
<body>
    <form action="../_php/login.php" method="POST">
        <h3>Sistema de Login!</h3>

        <input id="email" type="email" name="email" placeholder="Seu e-mail..." required autofocus/>
        <input id="senha" type="password" name="senha" placeholder="Sua senha..." required/>
        <input type="submit" name="acao" value="Enviar"/>
        <?php
        if(isset($_SESSION['nao_autenticado'])):
        ?>
        <div class="notification is-danger">
            <br><p><strong>ERRO: E-mail ou senha inválidos.</strong></p>
        </div>
        <?php
        endif;
        unset($_SESSION['nao_autenticado']);
        ?>
    </form>
</body>
</html>