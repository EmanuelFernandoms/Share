<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <title>Share</title>
</head>
<body>

    <h1 class="titulo-principal">Livros:</h1>

    <form action="" class="searchbar">
    <input class="search" type="search" name="pesquisa" id="pesquisa" placeholder="Estou procurando por...">
    <button class="btnsearch" type="submit" id="btnsearch">
    </button>
    <label for="btnsearch" class="botao-pesquisar">
        <span class="material-symbols-outlined">
        search
        </span>
    </label>
    </form>

<?php
    require "conexao.php";

    // dividir livros mostrados por páginas de 12 livros cada
    $num_per_page=12;

    if(isset($_GET["n"]))
    {
        $n_page=$_GET["n"];
    }
    else
    {
        $n_page=1;
    }

    $start_from=($n_page-1)*12;


    // pesquisar o livro q o usuário digitou no banco de dados:
    $p = filter_input(INPUT_GET, 'pesquisa', FILTER_SANITIZE_SPECIAL_CHARS);

   
    echo '<div class="fundo_lista_livrosaaa">';
    if($p){
        $sql ="SELECT * FROM livro WHERE titulo LIKE '%$p%'";
        $rs_result = $conexao->query($sql);
    }else{
        $sql="select * from livro limit $start_from,$num_per_page";
        $rs_result=$conexao->query($sql);
    }
?>

<html>

<body>
    <?php 
    // loop para mostrar os livros em sequencia
    echo '<div class="fundo_lista_livros">';
        while($rows=$rs_result->fetch()){
        
        echo '<div class="livro_inicio">';
            echo '<a href="main.php?page=livro&id='.$rows['id_livro'].'">';
            echo '<div class="livro-img">';
                echo '<img src="./image/'.$rows['img_path'].'" alt="not_found">';
            echo '</div>';
            echo '<h3>'.$rows['titulo'].'</h3>';
            echo '<p>Mais Informações<i class="bi bi-arrow-right"></i></p>';
            echo '</a>';
        echo '</div>';

        }
    echo '</div>';
    ?>
<br>
    <div class="numeros">
        <?php
        // divisão dos números das páginas
        $sql="select * from livro";
        $rs_result=$conexao->query($sql);
        $total_records=$rs_result->rowCount();
        $total_pages=ceil($total_records/$num_per_page);
        for($i=1;$i<=$total_pages;$i++)
        {
            if($i==$n_page){
                // o número da página que você está, é tratado diferente dos demais
                echo "<a href='main.php?n=".$i."' class='pagina-atual'>".$i."</a>" ;
                
            }else{
                echo "<a href='main.php?n=".$i."'>".$i."</a>" ;
            }
        
        }
        ?>
    </div>
    <br>
    <br>

</body>    
</html>
