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

    // Verifique se a consulta retornou resultados
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
