<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/includes/header.php'; ?>

<?
if(isset($_SESSION['email']) && (isset($_SESSION['senha']))){
    header("Location: apartamentos.php");
}
if(is_null($_SESSION['id'])){
    header("Location: index.php");
}
?>

<?php

$usuario = new usuarios();

if(isset($_POST['salvar'])){
    $editarUsuario = $usuario->editarUsuarios($_SESSION['id'], $_POST['nome'], $_POST['email'], $_POST['data_nascimento'], $_POST['senha']);
    ?>
    <div class="resposta">
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <strong>Atenção!</strong> <? echo $editarUsuario ?>
        </div>
    </div>

<? }?>

<?

if(isset($_SESSION['id'])){
    $listarUsuario = $usuario->listarUsuarios($_SESSION['id']);
}

?>
    <script type="text/javascript">
        function validar(cadastrodeusuarios){
            if(cadastrodeusuarios.email.value.indexOf(('@' && '.'),0)== -1){
                alert("EMAIL invalido.");
                return false;
            }
            if(cadastrodeusuarios.senha.value != cadastrodeusuarios.confSenha.value){
                alert("Confirme sua senha!");
                return false;
            }else{
                return true;
            }
        }
        jQuery(function($){
            $("#data_nascimento").mask("99/99/9999");
        });
    </script>

<body>
<div class="container">
    <div id="newuserlivro">
        <h4>Meu perfil</h4>
    </div>
    <form name="cadastrodeusuarios" class="form-horizontal" method="post" action="" onsubmit="return validar(cadastrodeusuarios);">

        <div class="control-group">
            <label class="control-label" for="inputEmail">Nome</label>
            <div class="controls">
                <input type="text" name="nome" placeholder="Nome" value="<? echo $listarUsuario[0]['nome']; ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Email</label>
            <div class="controls">
                <input type="text" name="email" placeholder="Email" value="<? echo $listarUsuario[0]['email']; ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Senha</label>
            <div class="controls">
                <input type="password" name="senha" placeholder="********">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Data de nascimento</label>
            <div class="controls">
                <input type="text" id="data_nascimento" name="data_nascimento" value="<? echo implode('/', array_reverse(explode('-', $listarUsuario[0]['data_nascimento']))); ; ?>">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Número do apartamento</label>
            <div class="controls">
                <input type="text" name="numero_apartamento" placeholder="Número do apartamento" value="<? echo $listarUsuario[0]['numero_apartamento']; ?>">
            </div>
        </div>
        <div class="control-group">
            <div class="controls">
                <button type="submit" name="salvar" class="btn btn-primary">Salvar</button>
            </div>
        </div>
    </form>
</div>
<? include_once 'includes/footer.php'; ?>