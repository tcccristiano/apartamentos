<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/includes/header.php'; ?>

<?
if(isset($_SESSION['email']) && (isset($_SESSION['senha']))){
    header("Location: apartamentos.php");
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
    $cadastrar->cadastro($_POST['nome'], $_POST['email'], $_POST['website'], $_POST['senha']);
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
            <h4>Votações</h4>
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
                <label class="control-label" for="inputEmail">Website</label>
                <div class="controls">
                    <input type="text" name="website" placeholder="Website">
                </div>

            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Senha</label>
                <div class="controls">
                    <input type="password" name="senha" placeholder="Senha">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Confirmar senha</label>
                <div class="controls">
                    <input type="password" name="confSenha" placeholder="Confirmar Senha">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" name="submit" class="btn btn-primary"">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>
<? include_once 'includes/footer.php'; ?>