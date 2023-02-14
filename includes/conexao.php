<?php

// conexão com o banco de dados:

try {
$user_bd = 'root';
$senha_bd = '';
$bd = 'share';
$conexao = new \PDO('mysql:host=localhost; dbname='.$bd, $user_bd, $senha_bd);

} catch (\PDOExeptiom $e) {
file_put_contents("log.txt", $e->getMassage(), FILE_APPEND | LOCK_EX );
echo '<div>Erro</div>';
}
