<?php
session_start();
include('../_php/verifica_login.php');
?>
<!DOCTYPE html>
<html lang="pt_br">
<head>
    <?php include('../_include/head.php'); ?>
    <link rel="stylesheet" href="../_css/style.css">
    <title>Painel de Controle</title>
</head>
<body>
    <div class="principal">
    <header>
    <?php include('../_include/header.php'); ?>
    <h1>Painel de Controle</h1>
    <p>Olá, <?php echo $_SESSION['email']; ?></p>
    </header>
    <br>
    <nav>
    <?php include('../_include/menu.php'); ?>
    </nav>
    <br>
        <section>
            <h1><p id="data-hora"></p></h1>
            <!-- Campo para digitar o CPF -->
            <form action="../_php/consultar.php" method="post">
                <label for="cpf">CPF:</label>
                <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="Informe o CPF" required>
                <input type="submit" value="Consultar">
            </form>
            
            <!-- Verifique se a consulta retornou resultados -->
            <?php      
                // Inclua o arquivo de consulta
                include('../_php/consultar.php');
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
                    // Mostrar o formulário de cadastro usando JavaScript
                    echo '<script>
                            document.getElementById("cadastro").style.display = "block";
                        </script>';
                }
            ?>

            
            <!-- Formulário de cadastro -->
            <div id="cadastro">
            <h2>Cadastro novo</h2>
                <form method="post" action="../_php/processar_cadastro.php">
                    <input type="hidden" name="cpf" value="<?php echo $cpf; ?>">
                    Nome: <input type="text" name="nome" required><br>
                    Empresa: <input type="text" name="empresa" required><br>
                    Função: <input type="text" name="funcao" required><br>
                    <input type="submit" value="Cadastrar">
                </form>
                <script>
                    // Função para validar o CPF quando o formulário de consulta é enviado
                    document.querySelector('form').addEventListener('submit', function (event) {
                        const cpfInput = document.getElementById('cpf');
                        if (!validarCPF(cpfInput.value)) {
                            event.preventDefault(); // Impede o envio do formulário se o CPF for inválido
                        }
                    });
                </script>
            </div>
        </section>
        <!--
        <aside>
            informar a justificativa e a quantidade quando disponível<br>
            botão para salvar os dados informados<br>
            validação do cadastro no banco de dados
        </aside>
        
        <footer>
            rodapé<br>
            informações sobre programador e direitos autorais.
        </footer>
                -->
    </div>
    
    <script src="../_js/script.js"></script>
</body>
</html>