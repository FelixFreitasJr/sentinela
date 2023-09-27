<div style="display: none;">
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
    $nivel = isset($_POST['nivel']) ? $_POST['nivel'] : 2; // Nível padrão 2 (Operacional)

    if (empty($email) || empty($senha)) {
        $erro = "Por favor, preencha todos os campos.";
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
            $erro = "Este email já está em uso. Escolha outro.";
        } else {
            // Criptografe a senha antes de armazená-la no banco de dados
            $senha_hash = password_hash($senha, PASSWORD_BCRYPT);

            // Insira o novo usuário no banco de dados
            $inserir_usuario = "INSERT INTO usuario (usuario, senha, nivel) VALUES (?, ?, ?)";
            $stmt = $conexao->prepare($inserir_usuario);
            $stmt->bind_param("ssi", $email, $senha_hash, $nivel);

            if ($stmt->execute()) {
                $mensagem = "Usuário cadastrado com sucesso!";
            } else {
                $erro = "Erro ao cadastrar o usuário. Tente novamente.";
            }
            $stmt->close();
        }
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
    <title>Cadastro de Usuário</title>
</head>
<div class="principal">
    <header>
        <?php include('../_include/header.php'); ?>
        <h1>Cadastro de Usuário</h1>
        <h2 class="relogio"><p id="data-hora"></p></h2>
        <p class="login">Olá, <?php echo $_SESSION['email']; ?></p>
    </header>
<br>
    <nav>
        <?php include('../_include/menu.php'); ?>
    </nav>
<br>
<body>
    
    <form class="form"  action="" method="POST" style="margin-top: 15px;">
        <input type="email" name="email" placeholder="E-mail" required>
        <br>
        <input type="password" name="senha" placeholder="Senha" required>
        <br>
        
        <label for="nivel">Operacional</label>
        <div class="toggle-switch">
            <input type="checkbox" id="nivel" name="nivel" value="1">
            <label for="nivel"></label>
        </div>
        <label for="nivel">Administrativo</label>
        <br><br>
        <input type="submit" value="Cadastrar">
        
        <div class="notification is-danger">
        <?php
            if (isset($erro)) {
                echo $erro;
            } elseif (isset($mensagem)) {
                echo $mensagem;
            }
            ?>
        </div>
    </form>
    <footer>
        <?php include('../_include/footer.php'); ?>
</footer>
</div>

<script src="../_js/script.js"></script>
</body>
</html>
