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
    <link href="css/estilo.css" rel="stylesheet">
</head>
<body>
<h1>Inserindo Dados</h1>

<!-- formulario para inserir dados -->
<form id="form_salva" method="post">
    <input type="text" name="CPF" placeholder="Digite seu CPF" required>
    <input type="text" name="nome" placeholder="Digite seu nome" required>
    <input type="text" name="sobrenome" placeholder="Digite seu sobrenome" required>
    <input type="text" name="telefone" placeholder="Digite seu telefone" required>
    <input type="email" name="email" placeholder="Digite seu email" required>
    <input type="text" name="banco" placeholder="Digite seu banco" required>
    <input type="text" name="cep" placeholder="Digite seu cep" required>
    <input type="text" name="endereco" placeholder="Digite seu endereço" required>
    <input type="text" name="cidade" placeholder="Digite sua cidade" required>
    <input type="text" name="logradouro" placeholder="Digite seu logradouro" required>
            
    <button type="submit" name="salvar">salvar</button>
</form>

<!-- formulario para atualizar dados -->
<form class="oculto" id="form_atualiza" method="post">
    <input type="text" id="CPF_editado" name="CPF_editado" placeholder="Editar CPF" required>
    <input type="text" id="nome_editado" name="nome_editado" placeholder="Editar nome" required>
    <input type="text" id="sobremome_editado" name="sobrenome_editado" placeholder="Editar sobrenome" required>
    <input type="text" id="telefone_editado" name="telefone_editado" placeholder="Editar telefone" required>
    <input type="email" id="email_editado" name="email_editado" placeholder="Editar email" required>
    <input type="text" id="banco_editado" name="banco_editado" placeholder="Editar banco" required>
    <input type="text" id="cep_editado" name="cep_editado" placeholder="Editar cep" required>
    <input type="text" id="endereco_editado" name="endereco_editado" placeholder="Editar endereço" required>
    <input type="text" id="cidade_editado" name="cidade_editado" placeholder="Editar cidade" required>
    <input type="text" id="logradouro_editado" name="logradouro_editado" placeholder="Editar logradouro" required>
    
    <button type="submit" name="atualizar">Atualizar</button>
    <button type="button" id="cancelar" name="cancelar">Cancelar</button>
</form> 

<!-- formulario para deletar dados -->
<form class="oculto" id="form_deleta" method="post">
    <input type="hidden" id="CPF_deleta" name="CPF_deleta" placeholder="Editar CPF" required>
    <input type="hidden" id="nome_deleta" name="nome_deleta" placeholder="Editar nome" required>
    <input type="hidden" id="sobrenome_deleta" name="sobrenome_deleta" placeholder="Editar sobrenome" required>
    <input type="hidden" id="telefone_deleta" name="telefone_deleta" placeholder="Editar telefone" required>
    <input type="hidden" id="email_deleta" name="email_deleta" placeholder="Editar email" required>  
    <input type="hidden" id="banco_deleta" name="banco_deleta" placeholder="Editar banco" required>
    <input type="hidden" id="cep_deleta" name="cep_deleta" placeholder="Editar cep" required>
    <input type="hidden" id="endereco_deleta" name="endereco_deleta" placeholder="Editar endereço" required>
    <input type="hidden" id="cidade_deleta" name="cidade_deleta" placeholder="Editar cidade" required>
    <input type="hidden" id="logradouro_deleta" name="logradouro_deleta" placeholder="Editar logradouro" required>

    <b>Tem certeza que quer deletar cliente <span id="tbmClientes"></span>?</b>

    <button type="submit" name="deletar">Confirmar</button>
    <button type="button" id="cancelar_delete" name="cancelar_delete">Cancelar</button>
</form> 

<br>

<?php
//inserir dados no banco
if(
    isset($_POST['salvar']) && 
    isset($_POST['CPF']) &&
    isset($_POST['nome']) && 
    isset($_POST['sobrenome']) && 
    isset($_POST['nome']) &&
    isset($_POST['email']) &&
    isset($_POST['banco']) &&
    isset($_POST['cep']) &&
    isset($_POST['endereco']) &&
    isset($_POST['cidade']) &&
    isset($_POST['logradouro'])
){

$CPF= limpaPost($_POST['CPF']);
$nome= limpaPost($_POST['nome']);
$sobrenome= limpaPost($_POST['sobrenome']);
$telefone= limpaPost($_POST['telefone']);
$email= limpaPost($_POST['email']);
$banco= limpaPost($_POST['banco']);
$cep= limpaPost($_POST['cep']);
$endereco= limpaPost($_POST['endereco']);
$cidade= limpaPost($_POST['cidade']);
$logradouro= limpaPost($_POST['logradouro']);


//validaçao de campo vazio
if ($CPF == "" || $CPF == null){
    echo "<b style='color:red'>Insira um cpf</b>";
    exit();
}

if ($nome == "" || $nome == null){
    echo "<b style='color:red'>Insira um nome</b>";
    exit();
}

if ($sobrenome == "" || $sobrenome == null){
    echo "<b style='color:red'>Insira um sobrenome</b>";
    exit();
}

if ($telefone == "" || $telefone == null){
    echo "<b style='color:red'>Insira um telefone</b>";
    exit();
}

if ($email == "" || $email == null){
    echo "<b style='color:red'>Insira um email</b>";
    exit();
}

if ($banco == "" || $banco == null){
    echo "<b style='color:red'>Insira um banco</b>";
    exit();
}

if ($cep == "" || $cep == null){
    echo "<b style='color:red'>Insira um cep</b>";
    exit();
}

if ($endereco == "" || $endereco == null){
    echo "<b style='color:red'>Insira um endereço</b>";
    exit();
}

if ($cidade == "" || $cidade == null){
    echo "<b style='color:red'>Insira um cidade</b>";
    exit();
}

if ($logradouro == "" || $logradouro == null){
    echo "<b style='color:red'>Insira um logradouro</b>";
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

$sql = $pdo->prepare("INSERT INTO tblClientes VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
$sql->execute(array($CPF, $nome, $sobrenome, $telefone, $email, $banco, $cep, $endereco, $cidade, $logradouro));

echo "<b style='color:green'>Cliente inserido com sucesso!</b>";

}

//atualizaçao de dados
if(
    isset($_POST['atualizar']) && 
    isset($_POST['CPF_editado']) && 
    isset($_POST['nome_editado']) &&
    isset($_POST['sobrenome_editado']) && 
    isset($_POST['telefone_editado']) &&  
    isset($_POST['email_editado']) &&
    isset($_POST['banco_editado']) && 
    isset($_POST['cep_editado']) && 
    isset($_POST['endereco_editado']) && 
    isset($_POST['cidade_editado']) && 
    isset($_POST['logradouro_editado'])
    ){
    
    $CPF=limpaPost($_POST['CPF_editado']);
    $nome=limpaPost($_POST['nome_editado']);
    $sobrenome=limpaPost($_POST['sobrenome_editado']);
    $telefone=limpaPost($_POST['telefone_editado']);
    $email=limpaPost($_POST['email_editado']);
    $banco=limpaPost($_POST['banco_editado']);
    $cep=limpaPost($_POST['CPF_editado']);
    $endereco=limpaPost($_POST['endereco_editado']);
    $cidade=limpaPost($_POST['cidade_editado']);
    $logradouro=limpaPost($_POST['logradouro_editado']);

    //validaçao de campo vazio
    if ($CPF == "" || $CPF == null){
        echo "<b style='color:red'>Insira um CPF</b>";
        exit();
    }
    
    if ($nome == "" || $nome == null){
        echo "<b style='color:red'>Insira um nome</b>";
        exit();
    }
    
    if ($sobrenome == "" || $sobrenome == null){
        echo "<b style='color:red'>Insira um sobrenome</b>";
        exit();
    }
    
    if ($telefone == "" || $telefone == null){
        echo "<b style='color:red'>Insira um telefone</b>";
        exit();
    }
    
    if ($email == "" || $email == null){
        echo "<b style='color:red'>Insira um email</b>";
        exit();
    }
    
    if ($banco == "" || $banco == null){
        echo "<b style='color:red'>Insira um banco</b>";
        exit();
    }
    
    if ($cep == "" || $cep == null){
        echo "<b style='color:red'>Insira um cep</b>";
        exit();
    }
    
    if ($endereco == "" || $endereco == null){
        echo "<b style='color:red'>Insira um endereço</b>";
        exit();
    }
    
    if ($cidade == "" || $cidade == null){
        echo "<b style='color:red'>Insira um cidade</b>";
        exit();
    }
    
    if ($logradouro == "" || $logradouro == null){
        echo "<b style='color:red'>Insira um logradouro</b>";
        exit();
    }
    
    //validaçao de nome e email

    if (!preg_match("/^[a-zA-Z-' ]*$/",$nome)) {
        echo "<b style='color:red'>Somente permitido letras e espaços em branco para o nome</b>";
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<b style='color:red'>Formato de email inválido!</b>";
        exit();
    }

    //comando para atualizar
    $sql = $pdo->prepare("UPDATE tblClientes SET nome=?, sobrenome=?, telefone=?, email=?, banco=?, cep=?, endereco=?, cidade=?, logradouro=? WHERE cpf=?");
    $sql->execute(array($nome,$sobrenome,$telefone,$email,$banco,$cep,$endereco,$cidade,$logradouro,$CPF));

    echo "Atualizado ".$sql->rowCount()." registros!";

}

//deletar dados
if(
    isset($_POST['deletar']) && 
    isset($_POST['CPF_deleta']) && 
    isset($_POST['nome_deleta']) &&
    isset($_POST['sobrenome_deleta']) && 
    isset($_POST['telefone_deleta']) &&  
    isset($_POST['email_deleta']) &&
    isset($_POST['banco_deleta']) && 
    isset($_POST['cep_deleta']) && 
    isset($_POST['endereco_deleta']) && 
    isset($_POST['cidade_deleta']) && 
    isset($_POST['logradouro_deleta'])
    ){
    
    $CPF=limpaPost($_POST['CPF_deleta']);
    $nome=limpaPost($_POST['nome_deleta']);
    $sobrenome=limpaPost($_POST['sobrenome_deleta']);
    $telefone=limpaPost($_POST['telefone_deleta']);
    $email=limpaPost($_POST['email_deleta']); 
    $banco=limpaPost($_POST['banco_deleta']);
    $cep=limpaPost($_POST['cep_deleta']);
    $endereco=limpaPost($_POST['endereco_deleta']);
    $cidade=limpaPost($_POST['cidade_deleta']);
    $logradouro=limpaPost($_POST['logradouro_deleta']);

    //comando para deletar     
    $sql = $pdo->prepare("DELETE FROM tblClientes WHERE CPF =? AND nome=? AND sobrenome=? AND telefone=? AND email=? AND banco=? AND cep=? AND endereco=? AND cidade=? AND logradouro=?");
    $sql->execute(array($id, $CPF, $nome, $sobrenome, $telefone, $email, $banco, $cep, $endereco, $cidade, $logradouro));

    echo "Deletado com sucesso!";

}

//seleciona dados na tabela
$sql = $pdo->prepare("SELECT * FROM tblClientes");
$sql->execute();
$dados = $sql->fetchAll();


//verifica se existem dados na tabela
if(count($dados) > 0){
    //constroi a parte superior da tabela
    echo "<br><br><table>
    <tr>
        <th>CPF</th>
        <th>Nome</th>
        <th>Sobrenome</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>Banco</th>
        <th>CEP</th>
        <th>Endereço</th>
        <th>Cidade</th>
        <th>Logradouro</th>
        <th>Ações</th>
    </tr>";

    //laço de repetiçao para adiçao de linha
    foreach($dados as $chave => $valor){
        echo " <tr>
            <td>".$valor['CPF']."</td>
            <td>".$valor['Nome']."</td>
            <td>".$valor['Sobrenome']."</td>
            <td>".$valor['Telefone']."</td>
            <td>".$valor['Email']."</td>
            <td>".$valor['Banco']."</td>
            <td>".$valor['Cep']."</td>
            <td>".$valor['Endereco']."</td>
            <td>".$valor['Cidade']."</td>
            <td>".$valor['Logradouro']."</td>
            <td><a href='#' class='btn-atualizar'' data-CPF='".$valor['CPF']."' data-Nome='".$valor['Nome']."' data-Sobrenome='".$valor['Sobrenome']."' data-Telefone='".$valor['Telefone']."' data-Email='".$valor['Email']."' data-Banco='".$valor['Banco']."' data-Cep='".$valor['Cep']."' data-Endereco='".$valor['Endereco']."' data-Cidade='".$valor['Cidade']."' data-Logradouro='".$valor['Logradouro']."'>Atualizar</a> | <a href='#' class='btn-deletar'' data-CPF='".$valor['CPF']."' data-Nome='".$valor['Nome']."' data-Sobrenome='".$valor['Sobrenome']."' data-Telefone='".$valor['Telefone']."' data-Email='".$valor['Email']."' data-Banco='".$valor['Banco']."' data-Cep='".$valor['Cep']."' data-Endereco='".$valor['Endereco']."' data-Cidade='".$valor['Cidade']."' data-Logradouro='".$valor['Logradouro']."'>Deletar</a></td>
       </tr>";
    }

    //fecha tabela
    echo "</table>";
}else{
    //caso a tabela n tenha dados
    echo "<p>Nenhum cliente cadastrado</p>";
}

?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(".btn-atualizar").click(function(){
            var CPF = $(this).attr('data-CPF');
            var nome =  $(this).attr('data-nome');
            var sobrenome =  $(this).attr('data-sobrenome');
            var telefone =  $(this).attr('data-telefone');
            var email = $(this).attr('data-email');
            var banco =  $(this).attr('data-banco');
            var cep =  $(this).attr('data-cep');
            var endereco =  $(this).attr('data-endereco');
            var cidade =  $(this).attr('data-cidade');
            var logradouro =  $(this).attr('data-logradouro');

            $('#form_salva').addClass('oculto');
            $('#form_atualiza').removeClass('oculto');

            $("#CPF_editado").val(CPF);
            $("#nome_editado").val(nome);
            ("#sobrenome_editado").val(sobrenome);
            ("#telefone_editado").val(telefone);
            $("#email_editado").val(email);
            ("#banco_editado").val(banco);
            ("#cep_editado").val(cep);
            ("#endereco_editado").val(endereco);
            ("#cidade_editado").val(cidade);
            ("#logradouro_editado").val(logradouro);

        });

        $('#cancelar').click(function(){
            $('#form_salva').removeClass('oculto');
            $('#form_atualiza').addClass('oculto');
        });

        $(".btn-deletar").click(function(){
            var CPF = $(this).attr('data-CPF');
            var nome =  $(this).attr('data-nome');
            var sobrenome =  $(this).attr('data-sobrenome');
            var telefone =  $(this).attr('data-telefone');
            var email = $(this).attr('data-email');
            var banco =  $(this).attr('data-banco');
            var cep =  $(this).attr('data-cep');
            var endereco =  $(this).attr('data-endereco');
            var cidade =  $(this).attr('data-cidade');
            var logradouro =  $(this).attr('data-logradouro');

            $("#id_deleta").val(id);
            $("#CPF_deleta").val(cpf);
            $("#nome_deleta").val(nome);
            $("#sobrenome_deleta").val(sobrenome);
            $("#telefone_deleta").val(telefone);
            $("#email_deleta").val(email);
            $("#banco_deleta").val(banco);
            $("#cep_deleta").val(cep);
            $("#endereco_deleta").val(endereco);
            $("#cidade_deleta").val(cidade);
            $("#logradouro_deleta").val(logradouro);
            $("#cliente").html(nome);           

            $('#form_salva').addClass('oculto');
            $('#form_atualiza').addClass('oculto');  
            $('#form_deleta').removeClass('oculto');          

        });

        $('#cancelar').click(function(){
            $('#form_salva').removeClass('oculto');
            $('#form_atualiza').addClass('oculto');
            $('#form_deleta').addClass('oculto');
        });

        $('#cancelar_delete').click(function(){
            $('#form_salva').removeClass('oculto');
            $('#form_atualiza').addClass('oculto');
            $('#form_deleta').addClass('oculto');
        });
    </script>         

</body>
</html>