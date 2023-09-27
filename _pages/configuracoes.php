<div style="display: none;">
<?php
session_start();
include('../_php/verifica_login.php');
include('../_php/conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifique se o formulário foi submetido via POST

    // Valide os campos do formulário (você pode adicionar mais validações)
    $senha_atual = $_POST['senha_atual'];
    $nova_senha = $_POST['nova_senha'];

    // Recupere o ID do usuário logado
    $id_usuario = $_SESSION['id_usuario'];

    // Recupere a senha atual do usuário do banco de dados
    $sql = "SELECT senha FROM usuario WHERE usuario_id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_usuario);
    $stmt->execute();
    $stmt->bind_result($senha_armazenada);
    $stmt->fetch();
    $stmt->close();

    // Verifique se a senha atual fornecida corresponde à senha armazenada no banco de dados
    if (password_verify($senha_atual, $senha_armazenada)) {
        if (password_verify($nova_senha, $senha_armazenada)) {
            echo "A nova senha não pode ser igual à senha atual.";
        } else {
            // Criptografe a nova senha antes de atualizá-la
            $nova_senha_hash = password_hash($nova_senha, PASSWORD_BCRYPT);
    
            // Atualize a senha no banco de dados
            $atualizar_senha_sql = "UPDATE usuario SET senha = ? WHERE usuario_id = ?";
            $stmt = $conexao->prepare($atualizar_senha_sql);
            $stmt->bind_param("si", $nova_senha_hash, $id_usuario);
    
            if ($stmt->execute()) {
                echo "Senha atualizada com sucesso!";
            } else {
                echo "Erro ao atualizar a senha. Tente novamente.";
            }
            $stmt->close();
        }
    } else {
        echo "Senha atual incorreta. Tente novamente.";
    }
}
?>
</div>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <?php include('../_include/head.php'); ?>
    <link rel="stylesheet" href="../_css/style.css">
    <script src="../_js/script.js"></script>
    <title>Configurações</title>
</head>
<div class="principal">
<body>
    <header>
        <?php include('../_include/header.php'); ?>
        <h1>Configurações</h1>
        <p class="login">Olá, <?php echo $_SESSION['email']; ?></p>
    </header>
    <br>
    <nav>
    <?php include('../_include/menu.php'); ?>
    </nav>
    
    <!-- Formulário para alteração de senha -->
    <form class="form" action="" method="POST">
        <input type="password" name="senha_atual" placeholder="Senha Atual" required>
        <br>
        <input type="password" name="nova_senha" placeholder="Nova Senha" required>
        <br>
        <input type="submit" value="Alterar Senha">

        <div class="notification is-danger">
        <?php
        if (isset($mensagem_erro)) {
            echo '<p class="erro">' . $mensagem_erro . '</p>';
        }
        ?>
        </div>
    </form>
    </div>
</body>
</html>
