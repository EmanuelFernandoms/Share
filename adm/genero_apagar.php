<?php

session_start();

if(!isset($_SESSION['id_user'])){
    die("Acesso negado");
} elseif ($_SESSION['id_user'] != 1) {
    die("Acesso negadoo");
}

require './includes/conexao.php';

$cod = filter_input(INPUT_GET,"id_gen",FILTER_SANITIZE_NUMBER_INT);

$sql = "DELETE FROM genero WHERE id_genero=$cod";

$conexao->query($sql);

header('Location: ../main.php?page=adm');