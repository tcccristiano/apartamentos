<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/includes/header.php'; ?>

<?
var_dump($_SESSION);
if(isset($_SESSION['email']) && (isset($_SESSION['senha']))){
    header("Location: apartamentos.php");
}
if(is_null($_SESSION['id'])){
    header("Location: index.php");
}
?>

<?

$logando = new usuarios();
if(isset($_POST['entrar'])){
    $logando->logar($_POST['email'], $_POST['senha']);
    if(!is_null($logando->resposta)){ ?>
        <div class="resposta">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Atenção!</strong> <? echo $logando->resposta ?>
            </div>
        </div>
    <?
            }
    }

    ?>

<?php

$cadastrar = new usuarios();

if(isset($_POST['submit'])){
    $cadastrar->cadastro($_POST['nome'], $_POST['email'], $_POST['dtNascimento'], $_POST['regra'], $_POST['numApartamento']);
    if(!is_null($cadastrar->resposta)){ ?>
        <div class="resposta">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Atenção!</strong> <? echo $cadastrar->resposta ?>
            </div>
        </div>
    <? }
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
    </script>

<body>
<div class="container">
    <div id="newuserlivro">
        <h4>Novo usuário? Inscreva-se!</h4>
    </div>
    <form name="cadastrodeusuarios" class="form-horizontal" method="post" action="" onsubmit="return validar(cadastrodeusuarios);">

        <div class="control-group">
            <label class="control-label" for="inputEmail">Nome</label>
            <div class="controls">
                <input type="text" name="nome" placeholder="Nome">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Email</label>
            <div class="controls">
                <input type="text" name="email" placeholder="Email">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Data de nascimento</label>
            <div class="controls">
                <input type="text" name="dtNascimento">
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputPassword">Regra</label>
            <div class="controls">
                <select name="regra">
                    <option value="admin">Admin</option>
                    <option value="usuario">usuario</option>
                </select>
            </div>
        </div>
        <div class="control-group">
            <label class="control-label" for="inputEmail">Número do apartamento</label>
            <div class="controls">
                <input type="text" name="numApartamento" placeholder="numero do apartamento">
            </div>
        </div>
    </form>
</div>
<? include_once 'includes/footer.php'; ?>