<!DOCTYPE html>
<html lang="pt-br">

<?php
require 'conexao.php';

$id = filter_input(INPUT_GET,'id',FILTER_SANITIZE_NUMBER_INT);
$id_dono = filter_input(INPUT_GET,'id_dono',FILTER_SANITIZE_NUMBER_INT);
$id_livro = filter_input(INPUT_GET,'id_livro',FILTER_SANITIZE_NUMBER_INT);

// caso o usuário tente forçar a entrada nessa página sem estar logado ele tem o acesso negado
if($id!=$_SESSION['id_user']){
    die("Acesso negado");
}

// caso o usuário tente trocar consigo msm, ele recebe um alerta
if($id_dono==$id){
    echo '<script>
    alert("Você não pode trocar com você mesmo!");
    window.location.href = "../main.php";
    </script>';
    die();
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width='device-width', initial-scale=1.0">
    <title>Troca</title>
</head>
<body>


    <form action="includes/trocadb.php" method="post" class="container-cadastro">
    <div>
        <label for="desc">
            Descrição:
        </label>
        <br>
        <input type="text" name="desc" id="desc" required>
    </div>
<br>
    <div>
        <label for="item_user1">
            Escolha um de seus livros pra oferecer na troca:
        </label>
        <br>
        <select name="item_user1" id="item_user1" required>

            <?php
                $id_user = $_SESSION['id_user'];
                $livros = $conexao->query("SELECT * FROM livro WHERE id_dono = $id_user");

                // caso o usuário não possua livros, aparecera que ele não tem livros
                if($livros->rowCount() == 0){
                    echo '<option value="">Você não tem livros cadastrados</option>';
                }else{
                    
                //looping para mostrar todos os livros do usuário: 
                foreach($livros as $livro){
                    echo '<option value="'.$livro['id_livro'].'">'.$livro['titulo'].'</option>';
                }
            }
            ?>

        </select>
    </div>

    <!-- informações do dono do livro -->
    <input type="hidden" id="id_dono" name="id_dono" value="<?=$id_dono?>"/>
    <input type="hidden" id="id_livro" name="id_livro" value="<?=$id_livro?>"/>
    
    <div>
        <input type="submit" value="Salvar">
    </div>
    </form>

</body>
</html>