<?php

session_start();

if(!isset($_SESSION['id_user'])){
    die("Acesso negado");
} elseif ($_SESSION['id_user'] != 1) {
    die("Acesso negadoo");
}

else{
    require '../includes/conexao.php';
    $sql = "DELETE FROM troca";
    $conexao->query($sql);
    $sql = "DELETE FROM livro";
    $conexao->query($sql);
    $sql = "DELETE FROM user";
    $conexao->query($sql);
    
    header('Location: ../main.php?page=adm');
}
