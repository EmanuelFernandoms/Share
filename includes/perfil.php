<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION['id_user'])){
    die("Acesso negado");
}

require 'conexao.php';

// variáveis para o usuário
$sql = "SELECT * FROM user WHERE id_user = ".$_SESSION['id_user'];
$usuarios = $conexao->query($sql);
$usuario = $usuarios->fetch();

// variáveis de contas que o usuário irá fazer troca
$sql2 = "SELECT COUNT(*) FROM troca WHERE id_user1 = ".$_SESSION['id_user']." OR id_user2 = ".$_SESSION['id_user'];
$trocas = $conexao->query($sql2);
$trocas_count = $trocas->fetch();

// perfil do usuário com suas informações:
echo '<br>';
echo '<div class="fundo-perfil">';
echo '<h1>Meu Perfil:</h1>';
echo '<div class="informacoes-usuario">';

echo '<div class="profile">';
echo '<div class="img-perfil"><img src="imagens/perfil.png" alt="">';
echo '<div class="logout"><a href="main.php?page=logout"><p>Desconectar-se</p></a></div>';
echo '</div>';


echo '<div class="info-perfil">';
echo '<h2>'.$usuario['nome_completo'].'</h2>';
echo '<h3>Seu usuário: '.$usuario['login'].'</h3>';
echo '<p>'.$usuario['email'].'</p>';
echo '<p>'.$usuario['numero_telefone'].'</p>';
echo '</div>';
echo '</div>';

echo '<div class="trocas-finalizadas"><p>Trocas finalizadas: '.$usuario['reputacao'].'</p></div>';


echo '</div>';

// parte da aba que irão aparecer as trocas pendentes ou para aceitar:


// trocas pendentes:
$nots = $conexao->query("SELECT * FROM troca WHERE id_user1 = ".$_SESSION['id_user']." OR id_user2 = ".$_SESSION['id_user']);
    echo '<h1>Trocas Pendentes:</h1>';
    echo '<div class="trocas-pendentes">';

// looping para mostrar todas as trocas que o usuário tem pendente:
foreach($nots as $n){

    // dados dos itens de troca:
    $id_troca = $n['id_troca'];
    $id_user1 = $n['id_user1'];
    $id_user2 = $n['id_user2'];
    $id_item_user1 = $n['id_item_user1'];
    $id_item_user2 = $n['id_item_user2'];
    $descricao = $n['descricao'];
    $status = $n['status'];

    // dados dos usuários:
    $nome_user1 = $conexao->query("SELECT nome_completo FROM user WHERE id_user = ".$id_user1)->fetch();;
    $nome_user2 = $conexao->query("SELECT nome_completo FROM user WHERE id_user = ".$id_user2)->fetch();;
    $nome_item_user1 = $conexao->query("SELECT titulo FROM livro WHERE id_livro = ".$id_item_user1)->fetch();
    $nome_item_user2 = $conexao->query("SELECT titulo FROM livro WHERE id_livro = ".$id_item_user2)->fetch();
    $login2 = $conexao->query("SELECT login FROM user WHERE id_user = ".$id_user2)->fetch();
    $login1 = $conexao->query("SELECT login FROM user WHERE id_user = ".$id_user1)->fetch();

    // telas que aparecerão para os usuários caso eles tenham enviado ou recebido uma troca de livros:
    if($status == 'Pendente'){
    
        // tela que aparecerá para o usuário que recebeu a troca:
        echo '<div class="troca-pendente">';
        if($id_user2==$_SESSION['id_user']){
        
            echo '<h1>Troca pendente com '.$nome_user1['nome_completo'].':</h1>';

            echo '<h2><span class="nome-verde">Usuario: </span><a href="./main.php?page=perfil_outrem&id='.$id_user1.'" class="link">'.$login1['login'].'</a></h2>';
            echo '<h2><span class="nome-verde">Item pedido: </span><a href="main.php?page=livro&id='.$id_item_user2.'" class="link">'.$nome_item_user2['titulo'].' </a></h2>';
            echo '<h2><span class="nome-verde">Item oferecido: </span><a href="main.php?page=livro&id='.$id_item_user1.'" class="link">'.$nome_item_user1['titulo'].' </a></h2>';
            echo '<h2><span class="nome-verde">Descrição: </span>'.$descricao.'</h2>';
            echo '<h2><span class="nome-verde">Status: </span>'.$status.'</h2>';

            echo '<div class="troca">';
            echo '<a href="main.php?page=troca_aceitar&id='.$id_troca.'">Aceitar troca</a>';
            echo '<a href="main.php?page=troca_recusar&id='.$id_troca.'">Recusar troca</a>';
            echo '</div>';
        }else{
            // tela que aparecerá para o usuário que enviou a troca:
            echo '<h1>Troca pendente com <a href="../main.php?page=perfil_outrem&id='.$id_user2.'">'.$nome_user2['nome_completo'].'</a></h1>';

            echo '<h2><span class="nome-verde">Usuario: </span><a href="./main.php?page=perfil_outrem&id='.$id_user2.'" class="link">'.$login1['login'].'</a></h2>';
            echo '<h2><span class="nome-verde">Item pedido: </span><a href="main.php?page=livro&id='.$id_item_user1.'" class="link">'.$nome_item_user1['titulo'].' </a></h2>';
            echo '<h2><span class="nome-verde">Item oferecido: </span><a href="main.php?page=livro&id='.$id_item_user2.'" class="link">'.$nome_item_user2['titulo'].' </a></h2>';
            echo '<h2><span class="nome-verde">Descrição: </span>'.$descricao.'</h2>';
            echo '<h2><span class="nome-verde">Status: </span>'.$status.'</h2>';
        }
        echo '</div>';
    }
}


echo '</div>';
echo '<h1>Trocas em Andamento:</h1>';
echo '<div class="trocas-andamento">';
$nots = $conexao->query("SELECT * FROM troca WHERE id_user1 = ".$_SESSION['id_user']." OR id_user2 = ".$_SESSION['id_user']);



// looping para mostrar as trocas que o usuário tem em andamento:
foreach($nots as $n){
    // variáveis remententes a troca e os itens:
    $id_troca = $n['id_troca'];
    $id_user1 = $n['id_user1'];
    $id_user2 = $n['id_user2'];
    $id_item_user1 = $n['id_item_user1'];
    $id_item_user2 = $n['id_item_user2'];
    $descricao = $n['descricao'];
    $status = $n['status'];

    // variáveis remetentes aos usuários:
    $nome_user1 = $conexao->query("SELECT nome_completo FROM user WHERE id_user = ".$id_user1)->fetch();;
    $nome_user2 = $conexao->query("SELECT nome_completo FROM user WHERE id_user = ".$id_user2)->fetch();;
    $nome_item_user1 = $conexao->query("SELECT titulo FROM livro WHERE id_livro = ".$id_item_user1)->fetch();
    $nome_item_user2 = $conexao->query("SELECT titulo FROM livro WHERE id_livro = ".$id_item_user2)->fetch();
    $login = $conexao->query("SELECT login FROM user WHERE id_user = ".$id_user2)->fetch();
    $login2 = $conexao->query("SELECT login FROM user WHERE id_user = ".$id_user1)->fetch();
    
    
    // telas que aparecerão para os usuários caso eles possuam uma troca em andamento:
    if($status == 'Andamento'){
        
        // tela do usário que aparecerá para o usuário que enviou a troca:
        echo '<div class="troca-andamento">';
        if($id_user1==$_SESSION['id_user']){
            echo '<h1>Troca em andamento com '.$nome_user2['nome_completo'].':</h1>';
        
            echo '<h2><span class="nome-verde">Usuario: </span><a href="./main.php?page=perfil_outrem&id='.$id_user1.'" class="link">'.$login1['login'].'</a></h2>';
            echo '<h2><span class="nome-verde">Item pedido: </span><a href="main.php?page=livro&id='.$id_item_user2.'" class="link">'.$nome_item_user2['titulo'].' </a></h2>';
            echo '<h2><span class="nome-verde">Item oferecido: </span><a href="main.php?page=livro&id='.$id_item_user1.'" class="link">'.$nome_item_user1['titulo'].' </a></h2>';
            echo '<h2><span class="nome-verde">Descrição: </span>'.$descricao.'</h2>';
            echo '<h2><span class="nome-verde">Status: </span>'.$status.'</h2>';
            echo '<h2> Entre com contato com o outro usuário realizar a troca.</h2>';
            $sql = "SELECT numero_telefone FROM user WHERE id_user = ".$id_user2;
            $telefone = $conexao->query($sql);
            $telefone = $telefone->fetch();
            // API do whatsapp para os usuários conseguirem entrar em contato:
            echo '<h2>Telefone: <a href="https://api.whatsapp.com/send?phone=55' . $telefone['numero_telefone'] . '&text=Ol%C3%A1,%20aqui%20%C3%A9%20o(a)%20' . $login2['login'] . '%20do%20Share,%20entrei%20em%20contato%20por%20conta%20da%20nossa%20troca,%20como%20vamos%20realiza-l%C3%A1?">'.$telefone['numero_telefone'].'</a></h2>';
        
            echo '<div class="troca">';
            echo '<a href="main.php?page=troca_finalizar&id='.$id_troca.'">Finalizar troca</a>';
            echo '</div>';
            // tela que aparecerá para o usuário que recebeu a troca:
        }else{
            echo '<h1>Troca em andamento com '.$nome_user1['nome_completo'].':</h1>';
    
            echo '<h2><span class="nome-verde">Usuario: </span><a href="./main.php?page=perfil_outrem&id='.$id_user2.'" class="link">'.$login2['login'].'</a></h2>';
            echo '<h2><span class="nome-verde">Item pedido: </span><a href="main.php?page=livro&id='.$id_item_user1.'" class="link">'.$nome_item_user1['titulo'].' </a></h2>';
            echo '<h2><span class="nome-verde">Item oferecido: </span><a href="main.php?page=livro&id='.$id_item_user2.'" class="link">'.$nome_item_user2['titulo'].' </a></h2>';
            echo '<h2><span class="nome-verde">Descrição: </span>'.$descricao.'</h2>';
            echo '<h2><span class="nome-verde">Status: </span>'.$status.'</h2>';
            echo '<h2> Entre com contato com o outro usuário realizar a troca.</h2>';
            $sql = "SELECT numero_telefone FROM user WHERE id_user = ".$id_user1;
            $telefone = $conexao->query($sql);
            $telefone = $telefone->fetch();
            // API do whatsapp para os usuários conseguirem entrar em contato:
            echo '<h2><span class="nome-verde">Telefone: </span><a href="https://api.whatsapp.com/send?phone=55'.$telefone['numero_telefone'].'&text=Ol%C3%A1,%20aqui%20%C3%A9%20o(a)%20'.$login['login'].'%20do%20Share,%20entrei%20em%20contato%20por%20conta%20da%20nossa%20troca,%20como%20vamos%20realiza-l%C3%A1?">'.$telefone['numero_telefone'].'</a></h2>';
        
            echo '<div class="troca">';
            echo '<a href="main.php?page=troca_finalizar&id='.$id_troca.'">Finalizar troca</a>';
            echo '</div>';
        }
   
        

    }
    }
  



?>