<?php
    // Conexão com o banco de dados (substitua com suas informações de conexão)
    define('HOST', '127.0.0.1');
    define('USUARIO','root');
    define('SENHA', '');
    define('BD', 'cadastro');
    
    $conexao = new mysqli(HOST, USUARIO, SENHA, BD);
    
    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }
    
    // Obtenha os dados do formulário
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $empresa = $_POST['empresa'];
    $funcao = $_POST['funcao'];
    
    // Insira os dados no banco de dados
    $sql = "INSERT INTO  usuarios (`codigo`, `cpf`, `nome`, `empresa`, `funcao`) VALUES ('$cpf', '$nome', '$empresa', '$funcao')";
    
    if ($conexao->query($sql) === TRUE) {
        $mensagem = "Cadastro realizado com sucesso!";
    } else {
        $erro2 = "Erro ao cadastrar: " . $conexao->error;
    }
    
    // Feche a conexão com o banco de dados
    $conexao->close();
?>

<div id="cadastro" style="display:block; margin-top: 115px;">
                <h2>Cadastro novo</h2>
                <form method="post" action="">
                    <input type="hidden" name="cpf" value="<?php echo $cpf; ?>">
                    <input type="text" name="nome" placeholder="Nome" autocomplete="Nome" required><br>
                    <input type="text" name="empresa" placeholder="Empresa" autocomplete="Empresa" required><br>
                    <input type="text" name="funcao" placeholder="Função" autocomplete="Função" required><br>
                    <input type="submit" value="Cadastrar">

                

                </form>
                <script>
                    // Função para validar o CPF quando o formulário de consulta é enviado
                    document.querySelector('form').addEventListener('submit', function (event) {
                    const cpfInput = document.getElementById('cpf');
                    if (!validarCPF(cpfInput.value)) {
                    event.preventDefault(); }// Impede o envio do formulário se o CPF for inválido
                    });
                </script>
            </div><!-- div formulario de cadastro Formulário de cadastro -->