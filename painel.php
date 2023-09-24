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
    <script src="js/script.js"></script>
</head>
<body>
    <div class="principal">
        <header>Painel de controle</header>
        <nav>Menu</nav>
        <section>
        <h1>Data e Hora Atuais</h1>
            <p id="data-hora"></p>

            
    </section>
        <aside>conteudo relacionado</aside>
        <footer>rodape</footer>
    </div>
</body>
</html>