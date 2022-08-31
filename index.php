<?php
require('db/conexao.php');
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserindo Dados</title>
</head>
<body>
    <main>
    <h1>Inserindo Dados</h1>
        <form method="post">
            <label> Nome Completo </label>
            <input type="text" name="nome" placeholder="Digite seu nome" required>
            
            <label> E-mail </label>
            <input type="email" name="email" placeholder="Digite seu email" required>
            
            <button type="submit" name="salvar">salvar</button>
        </form>
</main>
<br>
</body>
</html>

<?php
//inserir dados no banco
if(isset($_POST['salvar']) && isset($_POST['nome']) && isset($_POST['email'])){

$nome= limpaPost($_POST['nome']);
$email= limpaPost($_POST['email']);
$data= date('d-m-Y');

//validaçao de campo vazio
if ($nome == "" || $nome == null){
    echo "<b style='color:red'>Insira um nome</b>";
    exit();
}

if ($email == "" || $email == null){
    echo "<b style='color:red'>Insira um email</b>";
    exit();
}

//validaçao de nome e email
if (!preg_match("/^[a-zA-Z-' ]*$/",$nome)) {
    echo "<b style='color:red'>Apenas insira letras e espaços</b>";
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<b style='color:red'>Formato de email inválido</b>";
    exit();
}

$sql = $pdo->prepare("INSERT INTO clientes VALUES (null, ?, ?, ?)");
$sql->execute(array($nome, $email, $data));

echo "<b style='color:green'>Cliente inserido com sucesso!</b>";

}

?>
