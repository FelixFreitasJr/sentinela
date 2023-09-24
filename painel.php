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
            <ul class="menu">
                <li><a href="">Painel de controle</a></li>
                <li><a href="">Consulta</a></li>
                <li><a href="">Cadastro</a></li>
                <li><a href="logout.php">Sair</a></li>
            </ul>          
    </nav>
        <section>
        <h1><p id="data-hora"></p></h1>
            <!-- campo para digitar o cpf -->
        <form action="consultar.php" method="post">
            <label for="cpf">CPF:</label>
            <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="Informe o CPF" required>
            <input type="submit" value="Consultar">
        </form>
            
         // Verifique se a consulta retornou resultados
    <?php
    include('consultar.php');
    if ($resultado->num_rows > 0) {
        // Exiba os resultados
        while ($row = $resultado->fetch_assoc()) {
            echo "Nome: " . $row['nome'] . "<br>";
            echo "Endereço: " . $row['endereco'] . "<br>";
            echo "Telefone: " . $row['telefone'] . "<br>";
        }
    } else {
        echo "Nenhum resultado encontrado para o CPF: $cpf";
        // Mostrar seção de cadastro
        echo '<div id="cadastro" style="display: none;">';
        echo '<h2>Cadastrar novo cliente</h2>';
        // Aqui você pode adicionar o formulário de cadastro
        // por exemplo, nome, endereço, telefone, etc.
        echo '</div>';
        echo '<button onclick="mostrarCadastro()">Cadastrar</button>';
    }

    // Feche a conexão com o banco de dados
    $conexao->close();
    ?>
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
