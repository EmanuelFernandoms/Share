<?php

// não permitir usuários não logados cadastrarem livros
if(!isset($_SESSION['id_user'])){
    die("Acesso negado");
}

?>

<form action="includes/livro_cadastardb.php" method="post" enctype="multipart/form-data" class="container-cadastro">

    <h1>Cadastrar livro</h1>

    <div>
        <input type="text" placeholder="Titulo:" name="titulo" id="titulo_original" required>
    </div>

    <div>
        <input type="text" placeholder="Autor:" name="autor" id="autor" required>
    </div>

    

    <div>
        <label for="estado">
            Estado:
        </label>
        <br>
        <select name="estado" id="estado">
            <option value="3">Usado</option>
            <option value="2">Seminovo</option>
            <option value="1">Novo</option>
        </select>
    </div>

    <?php
    require 'conexao.php';
    ?>

    <div>
        <label for="genero">
            Genero:
        </label>
        <br>
        <select name="genero" id="genero">
            <?php
                // mostrar possiveis generos para o livro:
                $generos = $conexao->query('SELECT * FROM genero ORDER BY nome');
                foreach($generos as $g){
                    echo '<option value="'.$g['id_genero'].'">';
                    echo $g["nome"];
                    echo "</option>";
                }
            ?>
        </select>
    </div>

    <div>
        <label for="ffile" class="label-legal">
            Imagem do livro:
            <input type="file" name="choosefile" id="ffile" value="" accept="image/*" required/>
            <br>
            <span id="img"></span>
        </label>

        <script>
            // mostrar o nome da imagem que o usuário colocou para ele:
            let input = document.getElementById("ffile");
            let imageName = document.getElementById("img")

            input.addEventListener("change", ()=>{
                let inputImage = document.querySelector("input[type=file]").files[0];

                imageName.innerText = inputImage.name;
            })
        </script>
      
    </div>

    <div>
        <input type="submit" value="Salvar" class="salvar">
    </div>

    

</form>

<?php