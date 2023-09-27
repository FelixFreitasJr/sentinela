<div style="display: none;">
<?php
session_start();
?>
</div>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Felix Freitas Junior">
    <meta name="description" content="Sistema de controle do almoxarifado">
    <link rel="stylesheet" href="_css/style.css">
    <title>Login</title>
</head>
<body>
<div class="principal">
<header>
<div class="header-container">
    <img src="_img/cehosp.jpeg" alt="Sua Imagem" width="100%" height="auto">
            <h1>Sistema de Login!</h1>
            <p class="login">Olá, <?php echo isset($_SESSION['email']) ? $_SESSION['email'] : 'visitante'; ?></p>
            </div>
</header>
<div style="display: none;">
    <nav class="menu">
    <?php include('_include/menu.php'); ?>
    </nav>
</div>
        <section>
            <form class="index" action="_php/login.php" method="POST">
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
        </section>
    </div>
    <script src="_js/script.js"></script>
</body>
</html>
