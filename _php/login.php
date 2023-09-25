<?php
session_start();
include('_php/conexao.php');

if (empty($_POST['email']) || empty($_POST['senha'])) {
    header('Location: index.php');
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
    header('Location: _pages/painel.php');
    exit();
} else {
    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php');
    exit();
}
?>
