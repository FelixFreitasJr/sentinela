<?php // Conexão com o banco de dados (substitua com suas informações de conexão)
define('HOST', '127.0.0.1');
define('USUARIO','root');
define('SENHA', '');
define('BD', 'cadastro');

$conexao = new mysqli(HOST, USUARIO, SENHA, BD);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}

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
        header('Location: ../_pages/painel.php');
        exit;
        
    }
    } else {
        echo "";
    }

// Feche a conexão com o banco de dados
    $conexao->close();

?>