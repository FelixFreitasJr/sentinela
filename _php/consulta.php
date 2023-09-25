<?php
// Conexão com o banco de dados (substitua com suas informações de conexão)
$host = '127.0.0.1';
$usuario = 'root';
$senha = '';
$banco = 'cadastro';

$conexao = new mysqli($host, $usuario, $senha, $banco);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

// Verifique se o CPF foi fornecido e está em um formato válido
if (isset($_POST['cpf']) && preg_match('/^\d{3}\.\d{3}\.\d{3}\-\d{2}$/', $_POST['cpf'])) {
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
    } else {
        echo "Nenhum resultado encontrado para o CPF: $cpf";
    }
} else {
    echo "CPF inválido ou não fornecido.";
}

// Feche a conexão com o banco de dados
$conexao->close();
?>