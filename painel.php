<?php
session_start();
include('verifica_login.php');
?>


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
    <div class="principal">
        <header><h1>Painel de controle</h1>
        <p>Olá, <?php print_r($_SESSION['email']);?></p>
        
        </header>
        <nav>
            <ul>
                <li>painel de controle</li>
                <li>consulta</li>
                <li>cadastro</li>
                <li> <a href="logout.php">Sair</a></li>
            </ul>          
    </nav>
        <section>
        <h1><p id="data-hora"></p></h1>
        
        <p>campo para digitar o cpf<br>
            retorno dos dados informados pelo cpf<br>
            se nao encontrado, abrir formulario para cadastro novo, usando o cpf informado<br>
            botao para salvar apos o prencimento do cadastro
        </p>
            

            
    </section>
<aside>
    informar a justificativa e a quantidade quando disponivel<br>
    botao para salvar os dados informados<br>
    validação do cadastro no banco de dados
</aside>
        <footer>rodape<br>
            informaçoes sobre programador e direitos autorais.
        </footer>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
