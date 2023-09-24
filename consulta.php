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

    // Obtenha o CPF fornecido pelo usuário
    $cpf = $_POST['cpf'];

    // Consulta SQL (substitua com sua consulta real)
    $sql = "SELECT nome, endereco, telefone FROM clientes WHERE cpf = '$cpf'";

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
    }
    
    // Feche a conexão com o banco de dados
    $conexao->close();
?>
