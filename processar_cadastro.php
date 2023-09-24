<?php
    // Conexão com o banco de dados (substitua com suas informações de conexão)
    $host = 'localhost';
    $usuario = 'seu_usuario';
    $senha = 'sua_senha';
    $banco = 'seu_banco';
    
    $conexao = new mysqli($host, $usuario, $senha, $banco);
    
    if ($conexao->connect_error) {
        die("Erro na conexão: " . $conexao->connect_error);
    }
    
    // Obtenha os dados do formulário
    $cpf = $_POST['cpf'];
    $nome = $_POST['nome'];
    $empresa = $_POST['empresa'];
    $funcao = $_POST['funcao'];
    
    // Insira os dados no banco de dados
    $sql = "INSERT INTO clientes (cpf, nome, empresa, funcao) VALUES ('$cpf', '$nome', '$empresa', '$funcao')";
    
    if ($conexao->query($sql) === TRUE) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $conexao->error;
    }
    
    // Feche a conexão com o banco de dados
    $conexao->close();
?>
