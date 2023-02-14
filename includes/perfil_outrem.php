<?php

require 'conexao.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$sql = "SELECT * FROM user WHERE id_user = ".$id;

$usuarios = $conexao->query($sql);
$usuario = $usuarios->fetch();

$sql2 = "SELECT COUNT(*) FROM troca WHERE id_user1 = ".$id." OR id_user2 = ".$id;

$trocas = $conexao->query($sql2);

$trocas = $trocas->fetch();

// mostrar informaões do usuário selecionado para fazer troca
echo '<div class="fundo">';
echo '<h1>Perfil</h1>';
echo '<div class="informacoes">';
    echo '<div class="imghehe"><img src="imagens/perfil.png" alt=""></div>';

    echo '<div>';
    echo '<h2>'.$usuario['nome_completo'].'</h2>';
    echo '<h3> user: '.$usuario['login'].'</h3>';
    echo '<p> trocas já feitas pelo usuário: '.$trocas['COUNT(*)'].'</p>';
    echo '</div>';  


echo '</div>';

?>