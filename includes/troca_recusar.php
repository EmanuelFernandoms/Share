<?php

require 'conexao.php';
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

$troca = $conexao->query("SELECT * FROM troca WHERE id_troca = $id");
$troca = $troca->fetch();


// caso o usuário que esteja recusando a troca não seja quem recebeu ela, o acesso é negado
if($troca['id_user2']!=$_SESSION['id_user']){
    die("Acesso negado");
}


// mudança no estado da troca de "pendente" para "recusada":
$sql = "UPDATE troca SET status = 'Recusada' WHERE id_troca = $id";
$conexao->query($sql);
?>

<script>
    alert("Troca recusada com sucesso!");
    window.location.href = "main.php?page=perfil";
</script>