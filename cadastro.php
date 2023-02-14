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
    <a class="mini-logo" href="index.php"><img src="imagens/Share 2.0.png" alt=""></a>
  </nav>

  <div class="container-cadastro" >
      <form action="includes/cadastrodb.php" method="post">
        <div><p>Faça seu cadastro:</p></div>
        <div><input type="text" placeholder="Nome completo" id="nome_completo" name="nome_completo"></div>
        <div><input type="email" placeholder="Email" id="email" name="email"></div>

        <script>
        // permitir apenas números na parte do telefone
          function SomenteNumero(e){
              var tecla=(window.event)?event.keyCode:e.which;   
              if((tecla>47 && tecla<58)) return true;
              else{
                if (tecla==8 || tecla==0) return true;
            else  return false;
              }
          }

        </script>
        
        <div><input type="text" placeholder="Numero de contato" id="numero" onkeypress="return SomenteNumero(event)" name="numero" required></div>
        <div><input type="text" placeholder="Usuário" id="usuario" name="usuario" required></div>
        <div><input type="password" placeholder="Senha" id="senha" name="senha" required></div>
        <div><input type="password" placeholder="Confirmar senha" id="senha2" name="senha2" required></div>
        <div><input type="submit" value="Cadastrar"></div>
    

      </form>

      <a href="login.php">
      <div class="login">Login</div>
      </a>

    </div>

  <?php
  
  $erro = filter_input(INPUT_GET,'erro',FILTER_SANITIZE_NUMBER_INT);


  #possíveis erros de login
  if($erro == 1){
    echo "<script>alert('Email já cadastrado!')</script>";
  }else if($erro == 2){
    echo "<script>alert('Senhas não conferem!')</script>";
  }elseif($erro == 3){
    echo "<script>alert('Usúario já cadastrado realize seu login!')</script>";
  }elseif($erro == 4){
  echo "<script>alert('Usuário cadastrado com sucesso!')</script>";
}




  ?>

</body>
</html>