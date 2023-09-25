<?php
session_start();
include('conexao.php');

if (empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location: index.php');
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = $_POST['senha']; // Não hash a senha aqui, vamos fazer isso mais tarde

$stmt = $conexao->prepare("SELECT usuario_id, usuario, senha FROM usuario WHERE usuario = ?");
$stmt->bind_param("s", $usuario);

$stmt->execute();
$result = $stmt->get_result();

if ($result) {
    $row = $result->fetch_assoc();
    
    if (password_verify($senha, $row['senha'])) {
        $_SESSION['email'] = $usuario;
        header('Location: painel.php');
        exit();
    }
}

$_SESSION['nao_autenticado'] = true;
header('Location: index.php');
exit();
?>
