<style>
    body {
        background-color: black;
        color:white;
        font-family: 'Material Symbols Outlined', sans-serif;
        font-size:30px;
    }

</style>
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
session_start();
require '../includes/conexao.php';
if(!isset($_SESSION['id_user'])){
    die("Acesso negado");
}

$genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_STRING);

$sql = "INSERT INTO genero(nome) VALUES ('$genero')";
$conexao->query($sql);
echo "<script>alert('Gênero cadastrado com sucesso!');</script>";
header('Location:../main.php?page=adm');
?>



