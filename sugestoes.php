<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/includes/header.php'; ?>

<?
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
if(isset($_SESSION['email']) && (isset($_SESSION['senha']))){
    header("Location: apartamentos.php");
}
?>

<?

$usuario = new usuarios();

$listarUsuarios = $usuario->listarUsuarios();

?>
<?php

$sugestoes = new sugestoes();

if(isset($_GET['excluir'])){
    $sugestoes->excluirSugestao($_GET['excluir']);
}

if(isset($_POST['submit'])){

    $sugestoes->novaSugestao($_POST['titulo'], $_POST['descricao'], $_POST['ativo'], $_POST['data_criacao']);
    if(!is_null($sugestoes->mensagem)){ ?>
        <div class="resposta">
            <div class="alert alert-sucess">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Atenção!</strong> <? echo $sugestoes->mensagem ?>
            </div>
        </div>
    <? }
}
if($_SESSION['regra'] == 'admin'){
    $listarSugestoes = $sugestoes->listarSugestoes();
}else{
    $listarSugestoes = $sugestoes->listarSugestoes($_SESSION['id']);
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
        <h4>Sugestão</h4>
    </div>
    <? if($_SESSION['regra'] == 'usuario') {?>
        <a href="#modal" role="button" class="btn btn btn-success btn-large btn-block" style="margin:20px 0 40px; text-transform: uppercase; font-weight: bold;" data-toggle="modal">Criar Sugestão</a>

        <!-- Modal -->

        <div id="modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Nova Sugestão</h3>
            </div>
            <div class="modal-body">

                <form name="cadastrodeusuarios" class="form-horizontal" method="post" action="" onsubmit="return validar(cadastrodeusuarios);">

                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Título</label>
                        <div class="controls">
                            <input type="text" name="titulo" placeholder="Título" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <textarea class="form-control" rows="10" name="descricao" placeholder="Descreva a sugestão..." required ></textarea>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <button type="submit" name="submit" class="btn btn-primary"">Enviar</button>
                        </div>
                    </div>
                    <input type="hidden" name="data_criacao" value="<? echo date('Y-m-d H:m:s'); ?>">
                    <input type="hidden" name="ativo" value="1">
                </form>

            </div>
        </div>
    <? } ?>
    <? foreach($listarSugestoes as $listarSugestao){ ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th><? echo $listarSugestao['nome']; ?> <? if($_SESSION['regra'] == 'usuario'){ ?><a class="btn-small btn-danger" style="float:right;" href="sugestoes.php?excluir=<? echo $listarSugestao['id']; ?>">Excluir</a><? } ?></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><? echo $listarSugestao['descricao']; ?></td>
            </tr>
            </tbody>
        </table>
    <? } ?>
</div>
<br/>
<? include_once 'includes/footer.php'; ?>