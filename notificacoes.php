<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/includes/header.php'; ?>

<?
if(isset($_SESSION['email']) && (isset($_SESSION['senha']))){
    header("Location: apartamentos.php");
}
?>

<?

$usuario = new usuarios();

$listarUsuarios = $usuario->listarUsuarios();

?>
<?php

$notificacoes = new notificacoes();

if(isset($_GET['excluir'])){
    $notificacoes->excluirNotificacao($_GET['excluir']);
}

if($_SESSION['regra'] == 'admin'){
    $listarNotificacoes = $notificacoes->listarNotificacoes();
}else{
    $listarNotificacoes = $notificacoes->listarNotificacoes($_SESSION['id']);
}

if(isset($_POST['submit'])){

    $notificacoes->novaNotificacao($_POST['titulo'], $_POST['descricao'], $_POST['ativo'], $_POST['usuario_id'], $_POST['data_criacao']);
    if(!is_null($notificacoes->mensagem)){ ?>
        <div class="resposta">
            <div class="alert alert-sucess">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Atenção!</strong> <? echo $notificacoes->mensagem ?>
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
            <h4>Notificações</h4>
        </div>
        <? if($_SESSION['regra'] == 'admin') {?>
        <a href="#modal" role="button" class="btn btn btn-success btn-large btn-block" style="margin:20px 0 40px; text-transform: uppercase; font-weight: bold;" data-toggle="modal">Criar Notificação</a>

        <!-- Modal -->

        <div id="modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h3 id="myModalLabel">Nova Notificação</h3>
            </div>
            <div class="modal-body">

                <form name="cadastrodeusuarios" class="form-horizontal" method="post" action="" onsubmit="return validar(cadastrodeusuarios);">
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Condômino</label>
                        <div class="controls">
                            <select name="usuario_id" placeholder="Condômino" required>
                                <option value="">Selecione</option>
                                <?
                                    foreach ($listarUsuarios as $listaUsuario){
                                ?>
                                <option value="<? echo $listaUsuario['id'] ?>"><? echo $listaUsuario['nome'].' - '.$listaUsuario['numero_apartamento'] ?></option>
                                <? } ?>
                            </select>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label" for="inputEmail">Título</label>
                        <div class="controls">
                            <input type="text" name="titulo" placeholder="Título" required>
                        </div>
                    </div>
                    <div class="control-group">
                        <div class="controls">
                            <textarea style="width: 75%" class="form-control" rows="10" name="descricao" placeholder="Descreva a notificação..." required ></textarea>
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
        <? foreach($listarNotificacoes as $listarNotificacao){ ?>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th><? echo $listarNotificacao['titulo']; ?> <? if($_SESSION['regra'] == 'admin'){ ?><a class="btn-small btn-danger" style="float:right;" href="notificacoes.php?excluir=<? echo $listarNotificacao['id']; ?>">Excluir</a><? } ?></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><? echo $listarNotificacao['descricao']; ?></td>
                </tr>
                </tbody>
            </table>
        <? } ?>
    </div>
    <br/>
<? include_once 'includes/footer.php'; ?>