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

       <h3>CondoControle</h3><br/><br/>
        <form class="form-horizontal" method="post" action="">
            <div class="control-group">
                <label class="control-label" for="inputEmail">Email</label>
                <div class="controls">
                    <input type="text" name="email" placeholder="Email">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="senha">Senha</label>
                <div class="controls">
                    <input type="password" name="senha" placeholder="Password">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <label class="checkbox">
                        <input type="checkbox"> Lembrar senha
                    </label>
                    <button type="submit" name="entrar" class="btn btn-primary">Entrar</button>
                </div>
            </div>
        </form>
    </div>
<? include_once 'includes/footer.php'; ?>