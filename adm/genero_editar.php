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

require './includes/conexao.php';

$id = filter_input(INPUT_GET,"id_gen",FILTER_SANITIZE_NUMBER_INT);

$sql = "SELECT * FROM genero WHERE id_genero=$id";

$generos = $conexao->query($sql);
$genero = $generos->fetch();

if(!$genero){
    header('Location: main.php?page=cadastro_genero');
}

?>

<form action="adm/genero_editar_db.php" method="post" enctype="multipart/form-data" class="container-cadastro">

    <h1>Editar genero</h1>

    <div>
        <?php
        echo '<input type="text" placeholder="'.$genero['nome'].'" name="genero" id="genero" required>'
        ?>
        <input type="hidden" name="cod_genero" value="<?=$id?>">
    </div>
    <div>
        <input type="submit" value="Salvar">
    </div>
</form>
