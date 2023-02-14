<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Share</title>
</head>
<body class="body-cadastro">

  <nav class="nav-bar-cadastro">
    <a class="mini-logo" href="index.php">
      <img src="imagens/Share 2.0.png" alt="">
    </a>
  </nav>

  <form class="container-cadastro" action="includes/logindb.php" method="post">
    <div><p>Faça seu Login:</p></div>
    <div><input type="text" placeholder="Usuário" id="user" name="user" required></div>
    <div><input type="password" placeholder="Senha" id="senha" name="senha" required></div>
    <div><input type="submit" value="Login"></div>
    <a href="cadastro.php">
  <div class="login">Cadastro</div>
</a>
</form>

</body>

<?php
$erro = filter_input(INPUT_GET,'erro',FILTER_SANITIZE_NUMBER_INT);


// possiveis erros de login
if($erro == 1){
  echo "<script>alert('Usuário não encontrado!')</script>";
}else if($erro == 2){
  echo "<script>alert('Senha incorreta!')</script>";
}elseif($erro == 3){
  echo "<script>alert('Usuário logado com sucesso!')</script>";
}elseif($erro == 4){
  echo "<script>alert('Usuário cadastrado com sucesso, realize seu login!')</script>";
}


?>
</html>