<!DOCTYPE html>
<html lang="pt-br">
<?php

require 'conexao.php';

$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);

$sql = "SELECT * FROM livro,genero WHERE livro.genero = genero.id_genero AND livro.id_livro=$id";

$livro = $conexao->query($sql);

$livro = $livro->fetch();

$nome_dono = $conexao->query("SELECT login FROM user WHERE id_user = ".$livro['id_dono']);

$nome_dono = $nome_dono->fetch();

?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=$livro['titulo']?></title>
</head>
<body>

<div class="spam">
    <div class="pagina-escura">
            
        <div class="imagem-mostrada">
            <img src="./image/<?=$livro['img_path']?>" alt="">
        </div>

        <div class="livro-informacoes">
            <h1><?=$livro['titulo']?></h1>
            
            
            <p><span class="nome-verde">Autor: </span><?=$livro['autor']?></p>
            <p><span class="nome-verde">Estado: </span><?=$livro['estado']?></p>
            <p><span class="nome-verde">Genêro: </span><?=$livro['nome']?></p>
            <p><span class="nome-verde">Dono: </span><a href="./main.php?page=perfil_outrem&id=<?=$livro['id_dono']?>" class="perfil-dono-livro"><?=$nome_dono['login']?></a>
           
            <br>
            
                <?php
                // mostrar botão para o usuário fazer cadastro para poder trocar se não estiver logado
            if(!isset($_SESSION['id_user'])){
                echo '<a href="login.php">Faça login para trocar!</a>';
            }else{
                // mostrar botão para trocar se ja estiver logado
            echo '<div class="querotrocar"><a href="./main.php?page=troca&id='.$_SESSION['id_user'].'&id_livro='.$livro['id_livro'].'&id_dono='.$livro['id_dono'].'">Quero trocar!</a></div>';
            }
            ?>
        </div>
    </div>
</div>
    

</body>
</html>