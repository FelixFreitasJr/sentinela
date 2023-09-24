<?php
session_start();
include('verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt_br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Felix Freitas Junior">
        <meta name="description" content="Sistema de controle do almoxarifado">
        <link rel="stylesheet" href="css/estilo.css">
        <title>Painel de Controle</title>
    </head>
    
<body>
    <div class="principal">
        <header>
        <h1>Painel de controle</h1>
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
                
            <!-- Verifique se a consulta retornou resultados -->
          <?php      
            // Inclua o arquivo de consulta
        include('consultar.php');
            // Verifique se há resultados para exibir
        if (!empty($resultados)) {
            echo '<h2>Resultados da Consulta</h2>';
            // Exiba os resultados
            foreach ($resultados as $resultado) {
            echo "Nome: " . $resultado['nome'] . "<br>";
            echo "Endereço: " . $resultado['endereco'] . "<br>";
            echo "Telefone: " . $resultado['telefone'] . "<br>";
            echo "<hr>";
            }
        } elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Se o formulário foi enviado e não há resultados, exiba uma mensagem
            echo "Nenhum resultado encontrado para o CPF: $cpf";
            
            // Mostrar seção de cadastro
            echo '<div id="cadastro">';
            echo '<h2>Cadastrar novo cliente</h2>';
            
            // Pré-preencher o campo CPF com o valor informado
            echo '<form method="post" action="processar_cadastro.php">';
            echo '<input type="hidden" name="cpf" value="' . $cpf . '">';
            echo 'Nome: <input type="text" name="nome" required><br>';
            echo 'Empresa: <input type="text" name="empresa" required><br>';
            echo 'Função: <input type="text" name="funcao" required><br>';
            echo '<input type="submit" value="Cadastrar">';
            echo '</form>';
            echo '</div>';
            echo '<button onclick="mostrarCadastro()">Cadastrar</button>';
        }
            ?>
        </section>
        
        <aside>
            informar a justificativa e a quantidade quando disponivel<br>
            botao para salvar os dados informados<br>
            validação do cadastro no banco de dados
        </aside>
        <footer>
            rodape<br>
            informaçoes sobre programador e direitos autorais.
        </footer>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
