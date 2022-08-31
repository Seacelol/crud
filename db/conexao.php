<?php
//configs gerais
$servidor="localhost";
$usuario="root";
$senha="";
$banco="estudos";

//conexao
$pdo = new PDO("mysql:host=$servidor;dbname=$banco",$usuario,$senha);

//funçao para limpar entradas
function limpaPost($dado){

    $dado = trim($dado);
    $dado = stripcslashes($dado);
    $dado = htmlspecialchars($dado);
    return($dado);
}



?>