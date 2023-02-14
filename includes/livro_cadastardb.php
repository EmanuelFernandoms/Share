<?php

session_start();

if(!isset($_SESSION['id_user'])){
    die("Acesso negado");
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once "conexao.php";

$titulo = filter_input(INPUT_POST, 'titulo', FILTER_SANITIZE_SPECIAL_CHARS);
$estado = filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS);
$autor = filter_input(INPUT_POST, 'autor', FILTER_SANITIZE_SPECIAL_CHARS);
$genero = filter_input(INPUT_POST, 'genero', FILTER_SANITIZE_SPECIAL_CHARS);


// colocando os possiveis estados do livro
switch ($estado) {
    case '3':
        $estado = 'Usado';
        break;
    case '2':
        $estado = 'Seminovo';
        break;
    case '1':
        $estado = 'Novo';
        break;
    default:
        $estado = 'Novo';
        break;
}

$filename = $_FILES["choosefile"]["name"];
$tempname = $_FILES["choosefile"]["tmp_name"];  
$size = $_FILES["choosefile"]["size"];
$type = $_FILES["choosefile"]["type"];

// não permitir imagens muito pesadas
if ($_FILES["choosefile"]["size"] > 8388608) { 
    echo '<script>alert("Imagem muito grande!");window.location.href="../main.php?page=livro_cadastrar";</script>';
}
else{
    // movendo a imagem para o arquivo de imagens
    $folder = "../image/".$filename;   

    move_uploaded_file($tempname, $folder);

    // mostrar o usuário da sessão atual como dono do livro:
    $id = $_SESSION['id_user'];
    $sql = "INSERT INTO livro (id_dono,titulo, estado, autor, genero, img_path) VALUES ('$id','$titulo','$estado','$autor','$genero','$filename')";

    $conexao->query($sql);

    echo '<script>alert("Livro cadastrado com sucesso!");window.location.href = "../main.php";</script>';
}