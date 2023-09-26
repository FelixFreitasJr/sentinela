<?php
session_start();
include('../_php/verifica_login.php');

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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Novo Usuário</title>
</head>
        <header>
            <h1>Cadastro</h1>
            <p>Olá, <?php echo $_SESSION['email']; ?></p>
        </header>
        <br>
        <?php include('../_include/menu.php'); ?>
        <br>
<body>
    <h2>Cadastrar Novo Usuário</h2>
    <form action="" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required>
        <br>
        <label for="senha">Senha:</label>
        <input type="password" name="senha" required>
        <br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
