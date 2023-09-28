<?php
session_start();
?>

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
            <hr>
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
        
        <footer>
            <?php include('_include/footer.php'); ?>
        </footer>

    </div><!-- div principal -->

    <script>// script index.php
        var email = document.getElementById('email');

        email.addEventListener('focus', ()=>{
            email.style.borderColor = "#02af09";
        })
        email.addEventListener('blur', ()=>{
            email.style.borderColor = "#ccc";
        })

        var senha = document.getElementById('senha');

        senha.addEventListener('focus', ()=>{
            senha.style.borderColor = "#02af09";
        })
        senha.addEventListener('blur', ()=>{
            senha.style.borderColor = "#ccc";
        })
    </script>
</body>
</html>
