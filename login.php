<?php
session_start();
include('conexao.php');

if(empty($_POST['email']) || empty($_POST['senha'])){
    header('Location: index.php');
    exit();
}

$usuario = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$query = "select usuario_id, usuario from usuario where usuario = '{$usuario}' and senha = md5('{$senha}')";

$result = mysqli_query($conexao,$query);

if($result){
    $row = mysqli_num_rows($result);
    echo "Número de linhas retornadas: " . $row;
} else {
    echo "Erro na consulta: " . mysqli_error($conexao);
}

if($row ==1){

    $_SESSION['email'] = $usuario;
    header('Location: painel.php');
    exit();

} else {

    $_SESSION['nao_autenticado'] = true;
    header('Location: index.php');
    exit();
}
?>