<?php
session_start();

if(!isset($_SESSION['id_user'])){
    die("Acesso negado");
}

require 'conexao.php';
$desc = filter_input(INPUT_POST, 'desc', FILTER_SANITIZE_STRING);
$id_user = $_SESSION['id_user'];
$item_user1 = filter_input(INPUT_POST, 'item_user1', FILTER_SANITIZE_NUMBER_INT);
$id_dono = filter_input(INPUT_POST, 'id_dono', FILTER_SANITIZE_NUMBER_INT);
$item_dono = filter_input(INPUT_POST, 'id_livro', FILTER_SANITIZE_NUMBER_INT);
$status = "Pendente";

// criação da troca no banco de dados com os IDs dos usuários e dos livros:
$sql = "INSERT INTO troca (id_user1, id_item_user1, id_user2, id_item_user2, descricao, status) VALUES ('$id_user','$item_user1','$id_dono','$item_dono','$desc','$status')";

$conexao->query($sql);

?>

<script>
    alert("Solicitação de troca enviada!");
    window.location.href = "../main.php";
</script>