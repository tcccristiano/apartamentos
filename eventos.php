<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/includes/header.php'; ?>

<?
if(isset($_SESSION['email']) && (isset($_SESSION['senha']))){
    header("Location: apartamentos.php");
}
?>

<?php

$eventos = new eventos();

if(isset($_GET['excluir'])){
    $eventos->excluirEvento($_GET['excluir']);
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

if($_SESSION['regra'] == 'admin'){
    $listarEventos = $eventos->listarEventos();
}else{
    $listarEventos = $eventos->listarEventos($_SESSION['id']);
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
            $("#dtEvento").mask("99/99/9999");
        });
    </script>

<body>
<div class="container">
    <div id="newuserlivro">
        <h4>Eventos</h4>
    </div>
    <? if($_SESSION['regra'] == 'admin') {?>
        <a href="#modal" role="button" class="btn btn btn-success btn-large btn-block" style="margin:20px 0 40px; text-transform: uppercase; font-weight: bold;" data-toggle="modal">Criar Evento</a>

        <!-- Modal -->
        <div id="modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Novo Evento</h3>
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
                            <label class="control-label" for="inputEmail">Data do evento</label>
                            <div class="controls">
                                <input type="text" id="dtEvento" name="dtEvento" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <textarea style="width: 75%" class="form-control" rows="10" name="descricao" placeholder="Descreva o evento..." required ></textarea>
                            </div>
                        </div>
                        <div class="control-group">
                            <div class="controls">
                                <button type="submit" name="submit" class="btn btn-primary">Enviar</button>
                            </div>
                        </div>
                        <input type="hidden" name="data_criacao" value="<? echo date('Y-m-d H:m:s'); ?>">
                        <input type="hidden" name="ativo" value="1">
                    </form>

            </div>
        </div>
    <? } ?>
    <? foreach($listarEventos as $listarEvento){ ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>
                    <? echo $listarEvento['nome']; ?>  <? if($_SESSION['regra'] == 'admin'){ ?><a class="btn-small btn-danger" style="float:right;" href="eventos.php?excluir=<? echo $listarEvento['id']; ?>">Excluir</a><? } ?>
                </th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><? echo $listarEvento['descricao']; ?></td>
            </tr>
            <tr>
                <td>Data do evento: <? echo date("d/m/Y H:i:s", strtotime($listarEvento['data'])); ?></td>
            </tr>
            </tbody>
        </table>
    <? } ?>
</div>
<br/>
<? include_once 'includes/footer.php'; ?>