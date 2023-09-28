<?php
session_start();
include('../_php/verifica_login.php');
?>
<?php // Conexão com o banco de dados (substitua com suas informações de conexão)
    define('HOST', '127.0.0.1');
    define('USUARIO','root');
    define('SENHA', '');
    define('BD', 'cadastro');
    
    $conexao = new mysqli(HOST, USUARIO, SENHA, BD);
    
    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o CPF foi fornecido e está em um formato válido
        if (isset($_POST['cpf'])) {
    // Obtenha o CPF fornecido pelo usuário
        $cpf = $_POST['cpf'];
    
    // Consulta SQL (substitua com sua consulta real)
        $sql = "SELECT nome, empresa, funcao FROM usuarios WHERE cpf = '$cpf'";
    
    // Execute a consulta
        $resultado = $conexao->query($sql);
    
    // Variável para armazenar os resultados
        $resultados = array();
        
    // Verifique se a consulta retornou resultados
        if ($resultado->num_rows > 0) {
            // Armazene os resultados em um array
            while ($row = $resultado->fetch_assoc()) {
                $resultados[] = $row;
            }
        } else {
            $erro = "Nenhum resultado encontrado para o CPF: $cpf";
        }
        } else {
            echo "";
        }
    }
    // Feche a conexão com o banco de dados
        $conexao->close();
    
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
            <nav>
                <hr>
                <?php include('../_include/menu.php'); ?>
            </nav>
                <br><br>
                <h1>Painel de Controle</h1>
                <p><div class="data" id="data"></div></p>
                <p><div class="relogio" id="relogio"></div></p>
                <?php include('../_include/data_hora.php'); ?>
                <p class="login">Olá, <?php echo $_SESSION['email']; ?></p><br>
        </header>
          <hr>
        <section>
            <!-- Campo para digitar o CPF -->
            <form class="form" action="" method="POST" style="margin-top: 150px;">
                <input type="text" id="cpf" name="cpf" maxlength="14" placeholder="Informe o CPF" autocomplete="cpf" required>
                <input type="submit" value="Consultar">

                <script>// Adiciona um ouvinte de evento ao campo de CPF para formatá-lo automaticamente
                    var cpfInput = document.getElementById('cpf');
                        cpfInput.addEventListener('input', function() {
                    var cpf = cpfInput.value.replace(/\D/g, ''); // Remove caracteres não numéricos

                    // Adiciona o primeiro ponto após os três primeiros dígitos
                    if (cpf.length > 3) {
                        cpf = cpf.replace(/^(\d{3})(\d{0,3})/, '$1.$2');
                        }

                    // Adiciona o segundo ponto após os próximos três dígitos
                    if (cpf.length > 6) {
                        cpf = cpf.replace(/^(\d{3})\.(\d{3})(\d{0,3})/, '$1.$2.$3');
                        }

                    // Adiciona o hífen após os últimos três dígitos
                    if (cpf.length > 9) {
                        cpf = cpf.replace(/^(\d{3})\.(\d{3})\.(\d{3})(\d{0,2})/, '$1.$2.$3-$4');
                        }

                        cpfInput.value = cpf;
                    });
                </script>

                <script>// Função para validar o CPF no lado do cliente
                    document.getElementById('cpf').addEventListener('blur', function() {
                        validarCPF(this.value);
                    });
                    
                    function validarCPF(cpf) {
                    cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos

                    if (cpf.length !== 11 || !Array.from(cpf).every(digit => digit === cpf [0])) {
                        alert("CPF inválido - Incompleto");
                    return false;
                    }
                    let sum = 0;
                    for (let i = 0; i < 9; i++) {
                        sum += parseInt(cpf.charAt(i)) * (10 - i);
                        }
                    let remainder = 11 - (sum % 11);
                    if (remainder === 10 || remainder === 11) {
                        remainder = 0;
                        }
                    if (remainder !== parseInt(cpf.charAt(9))) {
                    // Altera a cor do campo de input para vermelho
                        document.getElementById('cpf').style.borderColor = 'red';
                        return false;
                        }

                        sum = 0;
                    for (let i = 0; i < 10; i++) {
                        sum += parseInt(cpf.charAt(i)) * (11 - i);
                        }
                        remainder = 11 - (sum % 11);
                    if (remainder === 10 || remainder === 11) {
                        remainder = 0;
                        }
                    if (remainder !== parseInt(cpf.charAt(10))) {
                    // Altera a cor do campo de input para vermelho
                        document.getElementById('cpf').style.borderColor = 'red';
                        return false;
                        }

                    // Se todas as verificações passarem, restaura a cor padrão do campo de input
                    document.getElementById('cpf').style.borderColor = ''; // ou a cor padrão que desejar
                    return true;
                    }
                </script>

            </form><!-- fim do Campo para digitar o CPF -->
                
            <!-- Verifique se a consulta retornou resultados -->
            <div style="display: block;">
                <?php                 
                    // Verifique se há resultados para exibir
                    if (!empty($resultados)) {
                        echo '<h2>Resultados da Consulta</h2>';
                    // Exiba os resultados
                    foreach ($resultados as $resultado) {
                        echo "Nome: " . $resultado['nome'] . "<br>";
                        echo "Endereço: " . $resultado['empresa'] . "<br>";
                        echo "Telefone: " . $resultado['funcao'] . "<br>";
                        echo "<hr>";
                        }
                    } elseif (!empty($erro)) {
                    // Se o formulário foi enviado e não há resultados, exiba uma mensagem
                        echo $erro;
                        echo include('_app/app_cadastro.php');
                    // Mostrar o formulário de cadastro usando JavaScript
                     }
                ?>
            </div><!-- div Verifique se a consulta retornou resultados -->
        </section>

        <aside>      
            <!-- Formulário de cadastro -->
            
        </aside>

        <footer>
            <?php include('../_include/footer.php'); ?>
        </footer>

    </div><!-- div principal -->

    <script>
           
            // Função para validar o CPF no lado do cliente
            function validarCPF(cpf) {
                cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos
                
                for (let i = 0; i < 9; i++) {
                    sum += parseInt(cpf.charAt(i)) * (10 - i);
                }
                let remainder = 11 - (sum % 11);
                if (remainder === 10 || remainder === 11) {
                    remainder = 0;
                }
                if (remainder !== parseInt(cpf.charAt(9))) {
                    alert("CPF inválido - Incorreto");
                    return false;
                }
                sum = 0;
                for (let i = 0; i < 10; i++) {
                    sum += parseInt(cpf.charAt(i)) * (11 - i);
                }
                remainder = 11 - (sum % 11);
                if (remainder === 10 || remainder === 11) {
                    remainder = 0;
                }
                if (remainder !== parseInt(cpf.charAt(10))) {
                    alert("CPF inválido");
                    return false;
                }
                return true;
            }
    </script>
</body>
</html>