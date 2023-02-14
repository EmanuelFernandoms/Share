<?php
require 'conexao.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$login = filter_input(INPUT_POST,'user',FILTER_SANITIZE_EMAIL);
$senha = filter_input(INPUT_POST,'senha');

$sql = "SELECT * FROM user WHERE login='$login'";

$usuarios = $conexao->query($sql);

// usuário não encontrado
if(!$usuarios->rowCount()){
    header("Location: ../login.php?erro=1");
    exit;
}

$usuario = $usuarios->fetch();

// verificando senha
if(password_verify($senha,$usuario['password'])){
    session_start();
    $_SESSION['id_user'] = $usuario['id_user'];
    $_SESSION['nome'] = $usuario['nome_completo'];
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['numero_telefone'] = $usuario['numero_telefone'];
    $_SESSION['login'] = $usuario['login'];

    header("Location: ../main.php");
    exit;
}else{
    header("Location: ../login.php?erro=2");
    exit;
}