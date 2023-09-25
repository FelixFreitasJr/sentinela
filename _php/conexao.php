<?php
define('HOST', '127.0.0.1');
define('USUARIO','root');
define('SENHA', '');
define('BD', 'login');

$conexao = new mysqli(HOST, USUARIO, SENHA, BD);

if ($conexao->connect_error) {
    die("Erro na conexão: " . $conexao->connect_error);
}
?>