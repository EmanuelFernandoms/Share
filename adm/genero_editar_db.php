<?php

session_start();

if(!isset($_SESSION['id_user'])){
    die("Acesso negado");
} elseif ($_SESSION['id_user'] != 1) {
    die("Acesso negadoo");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require '../includes/conexao.php';

$genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS);
$id = filter_input(INPUT_POST, 'cod_genero', FILTER_SANITIZE_NUMBER_INT);
$sql = "UPDATE genero SET nome='$genero' WHERE id_genero=$id";

$conexao->query($sql);

echo "<script>alert('Gênero editado com sucesso!');</script>";

header('Location:../main.php?page=adm');