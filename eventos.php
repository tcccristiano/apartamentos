<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/includes/header.php'; ?>

<?
if(isset($_SESSION['email']) && (isset($_SESSION['senha']))){
    header("Location: apartamentos.php");
}
?>

<?php

$eventos = new eventos();

if($_SESSION['regra'] == 'admin'){
    $listarEventos = $eventos->listarEventos();
}else{
    $listarEventos = $eventos->listarEventos($_SESSION['id']);
}

if(isset($_POST['submit'])){

    $eventos->novoEvento($_POST['titulo'], $_POST['descricao'], $_POST['ativo'], $_POST['usuario_id'], $_POST['data_criacao']);
    if(!is_null($eventos->mensagem)){ ?>
        <div class="resposta">
            <div class="alert alert-sucess">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Atenção!</strong> <? echo $eventos->mensagem ?>
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
        <h4>Eventos</h4>
    </div>
    <? if($_SESSION['regra'] == 'admin') {?>
        <form name="cadastrodeusuarios" class="form-horizontal" method="post" action="" onsubmit="return validar(cadastrodeusuarios);">

            <div class="control-group">
                <label class="control-label" for="inputEmail">Título</label>
                <div class="controls">
                    <input type="text" name="titulo" placeholder="Título" required>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <textarea class="form-control" rows="10" name="descricao" placeholder="Descreva a notificação..." required ></textarea>
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
    <? } ?>
    <? foreach($listarEventos as $listarEvento){ ?>
        <div class="list-group">
            <a href="#" class="list-group-item active">
                <h4 class="list-group-item-heading"><? echo $listarEvento['nome']; ?></h4>
                <p class="list-group-item-text"><? echo $listarEvento['descricao']; ?></p>
            </a>
        </div>
    <? } ?>
</div>
<br/>
<? include_once 'includes/footer.php'; ?>