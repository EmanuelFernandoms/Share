<?php

require 'conexao.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$troca = $conexao->query("SELECT * FROM troca WHERE id_troca = $id");
$troca = $troca->fetch();


// caso o usuário que esteja aceitando a troca não seja quem recebeu a troca o acesso é negado
if($troca['id_user2']!=$_SESSION['id_user']){
    die("Acesso negado");
}

// troca de estado da troca de "pendente" para "em andamento":
$sql = "UPDATE troca SET status = 'Andamento' WHERE id_troca = $id";
$conexao->query($sql);
?>

<script>
    alert("Troca aceita com sucesso!");
    window.location.href = "main.php?page=perfil";
</script>