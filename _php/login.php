<?php
session_start();
include('../_php/conexao.php');

if (empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location: ../index.php');
    exit();
}

$usuario = $_POST['email'];
$senha = $_POST['senha'];

$stmt = $conexao->prepare("SELECT usuario_id, usuario, senha FROM usuario WHERE usuario = ?");
$stmt->bind_param("s", $usuario);

$stmt->execute();
$stmt->bind_result($usuario_id, $usuario, $senha_hash);

if ($stmt->fetch() && password_verify($senha, $senha_hash)) {
    $_SESSION['email'] = $usuario;
    header('Location: ../_pages/painel.php');
    include('logs.php');
    $username = $_SESSION['email']; // Assumindo que o email do usuário seja o nome de usuário
    logMessage("Login bem-sucedido", "INFO", $username);
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    include('logs.php');
    $username = $_POST['email']; // Ou qualquer outra maneira de obter o nome de usuário
    logMessage("Tentativa de login falhou", "ERRO", $username);
    header('Location: ..//index.php');
    exit();
}

?>