<?php
session_start();
include('../_php/verifica_login.php');
$pageTitle = "Cadastro";
// Inclua o arquivo de conexão com o banco de dados
include('../_php/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o formulário foi submetido via POST

    // Valide os campos do formulário (você pode adicionar mais validações)
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    if (empty($email) || empty($senha)) {
        echo "Por favor, preencha todos os campos.";
    } else {
        // Verifique se o email já existe no banco de dados
        $verificar_email = "SELECT COUNT(*) FROM usuario WHERE usuario = ?";
        $stmt = $conexao->prepare($verificar_email);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->bind_result($quantidade);
        $stmt->fetch();
        $stmt->close();

        if ($quantidade > 0) {
            echo "Este email já está em uso. Escolha outro.";
        } else {
            // Criptografe a senha antes de armazená-la no banco de dados
            $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

            // Insira o novo usuário no banco de dados
            $inserir_usuario = "INSERT INTO usuario (usuario, senha) VALUES (?, ?)";
            $stmt = $conexao->prepare($inserir_usuario);
            $stmt->bind_param("ss", $email, $senha_hash);

            if ($stmt->execute()) {
                echo "Usuário cadastrado com sucesso!";
            } else {
                echo "Erro ao cadastrar o usuário. Tente novamente.";
            }
            $stmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('../_include/head.php'); ?>
    <link rel="stylesheet" href="../_css/index_style.css">
    <title>Cadastro de Usuário</title>
</head>
    <header>
    <?php include('../_include/header.php'); ?>
    </header>
    <br>
    <nav>
    <?php include('../_include/menu.php'); ?>
    </nav>
    <br>
<body>
    
    <form action="" method="POST">
    <h3>Cadastrar Novo Usuário</h3>
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>
        <br>
        <input type="submit" value="Cadastrar">
        
        <div class="notification is-danger">
        <?php
        if (isset($erro)) {
            echo $erro;
        }
        ?>
    </div>
    </form>
</body>
</html>
