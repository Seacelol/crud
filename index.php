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
    <main>
    <h1>Inserindo Dados</h1>
        <form method="post">
            <label> Nome Completo </label>
            <input type="text" name="nome" placeholder="Digite seu nome" required>

            <label> E-mail </label>
            <input type="email" name="email" placeholder="Digite seu email" required>
<h1>Inserindo Dados</h1>

<!-- formulario para inserir dados -->
<form id="form_salva" method="post">
    <input type="text" name="nome" placeholder="Digite seu nome" required>
    <input type="email" name="email" placeholder="Digite seu email" required>

            <button type="submit" name="salvar">salvar</button>
        </form>
</main>
    <button type="submit" name="salvar">salvar</button>
</form>

<!-- formulario para atualizar dados -->
<form class="oculto" id="form_atualiza" method="post">
    <input type="hidden" id="id_editado" name="id_editado" placeholder="ID" required>
    <input type="text" id="nome_editado" name="nome_editado" placeholder="Editar nome" required>
    <input type="email" id="email_editado" name="email_editado" placeholder="Editar email" required>

    <button type="submit" name="atualizar">Atualizar</button>
    <button type="button" id="cancelar" name="cancelar">Cancelar</button>
</form> 

<!-- formulario para deletar dados -->
<form class="oculto" id="form_deleta" method="post">
    <input type="hidden" id="id_deleta" name="id_deleta" placeholder="ID" required>
    <input type="hidden" id="nome_deleta" name="nome_deleta" placeholder="Editar nome" required>
    <input type="hidden" id="email_deleta" name="email_deleta" placeholder="Editar email" required>  

    <b>Tem certeza que quer deletar cliente <span id="cliente"></span>?</b>

    <button type="submit" name="deletar">Confirmar</button>
    <button type="button" id="cancelar_delete" name="cancelar_delete">Cancelar</button>
</form> 

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

    }
}

//atualizaçao de dados
if(isset($_POST['atualizar']) && isset($_POST['id_editado']) && isset($_POST['nome_editado']) && isset($_POST['email_editado'])){

    $id=limpaPost($_POST['id_editado']);
    $nome=limpaPost($_POST['nome_editado']);
    $email=limpaPost($_POST['email_editado']);

    //validaçao de campo vazio
    if ($nome=="" || $nome==null){
        echo "<b style='color:red'>Nome não pode ser vazio</b>";
        exit();
    }

    if ($email=="" || $email==null){
        echo "<b style='color:red'>Email não pode ser vazio</b>";
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
    $sql = $pdo->prepare("UPDATE clientes SET nome=?, email=? WHERE id=?");
    $sql->execute(array($nome,$email,$id));

    echo "Atualizado ".$sql->rowCount()." registros!";

}

//deletar dados
if(isset($_POST['deletar']) && isset($_POST['id_deleta']) && isset($_POST['nome_deleta']) && isset($_POST['email_deleta'])){

    $id=limpaPost($_POST['id_deleta']);
    $nome=limpaPost($_POST['nome_deleta']);
    $email=limpaPost($_POST['email_deleta']); 

    //comando para deletar     
    $sql = $pdo->prepare("DELETE FROM clientes WHERE id=? AND nome=? AND email=?");
    $sql->execute(array($id, $nome, $email));

    echo "Deletado com sucesso!";

}

//seleciona dados na tabela
$sql = $pdo->prepare("SELECT * FROM clientes");
$sql->execute();
$dados = $sql->fetchAll();


//verifica se existem dados na tabela
if(count($dados) > 0){
    //constroi a parte superior da tabela
    echo "<br><br><table>
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>";

    //laço de repetiçao para adiçao de linha
    foreach($dados as $chave => $valor){
        echo " <tr>
                    <td>".$valor['id']."</td>
                    <td>".$valor['nome']."</td>
                    <td>".$valor['email']."</td>
                    <td><a href='#' class='btn-atualizar' data-id='".$valor['id']."' data-nome='".$valor['nome']."' data-email='".$valor['email']."'>Atualizar</a> | <a href='#' class='btn-deletar' data-id='".$valor['id']."' data-nome='".$valor['nome']."' data-email='".$valor['email']."'>Deletar</a></td>
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
            var id = $(this).attr('data-id');
            var nome =  $(this).attr('data-nome');
            var email = $(this).attr('data-email');

            $('#form_salva').addClass('oculto');
            $('#form_atualiza').removeClass('oculto');

            $("#id_editado").val(id);
            $("#nome_editado").val(nome);
            $("#email_editado").val(email);

        });

        $('#cancelar').click(function(){
            $('#form_salva').removeClass('oculto');
            $('#form_atualiza').addClass('oculto');
        });

        $(".btn-deletar").click(function(){
            var id = $(this).attr('data-id');
            var nome =  $(this).attr('data-nome');
            var email = $(this).attr('data-email');

            $("#id_deleta").val(id);
            $("#nome_deleta").val(nome);
            $("#email_deleta").val(email);
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