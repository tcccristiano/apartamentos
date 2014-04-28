<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/includes/header.php'; ?>

<?
if(isset($_SESSION['email']) && (isset($_SESSION['senha']))){
    header("Location: apartamentos.php");
}
?>

<?php

$gastos = new gastos();

if(isset($_POST['submit'])){
//    print_r($_POST);
//    die;
    $gastos->novoGasto($_POST['servico'], $_POST['descricao'], $_SESSION['apartamentoId'], $_POST['valor']);
    if(!is_null($gastos->mensagem)){ ?>
        <div class="resposta">
            <div class="alert alert-sucess">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Atenção!</strong> <? echo $gastos->mensagem ?>
            </div>
        </div>
    <? }
}

$listarGastos = $gastos->listarGastos($_SESSION['apartamentoId']);
?>



<body>
<div class="container">
    <div id="newuserlivro">
        <h4>Gastos do condomínio</h4>
    </div>
    <? if($_SESSION['regra'] == 'admin') {?>
        <a href="#modal" role="button" class="btn btn btn-success btn-large btn-block" style="margin:20px 0 40px; text-transform: uppercase; font-weight: bold;" data-toggle="modal">Criar novo gasto</a>

        <!-- Modal -->

        <div id="modal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 id="myModalLabel">Novo Gasto</h3>
        </div>
        <div class="modal-body">
            <form name="cadastroGastos" class="form-horizontal" method="post" action="" ">
                <div class="control-group">
                    <label class="control-label" for="inputEmail">Serviço</label>
                    <div class="controls">
                        <input type="text" name="servico" placeholder="Serviço" required>
                    </div>
                </div>
                <div class="control-group">
                    <label class="control-label" for="inputEmail">Valor</label>
                    <div class="controls">
                        <input type="text" name="valor" placeholder="0,00" required>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <textarea style="width: 75%" class="form-control" rows="10" name="descricao" placeholder="Descreva detalhes do serviço feito..." required ></textarea>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button type="submit" name="submit" class="btn btn-primary"">Enviar</button>
                    </div>
                </div>
    <!--            <input type="hidden" name="apartamento_id" value="">-->
            </form>
        </div>
    </div>
    <? } ?>
    <? foreach($listarGastos as $listarGasto){ ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Serviço: <? echo $listarGasto['servico']; ?> <span style="float: right">R$ <? echo number_format($listarGasto['valor'],2,',','.'); ?></span></th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td><strong>Descrição do serviço: </strong><? echo $listarGasto['descricao']; ?></td>
            </tr>
            </tbody>
        </table>
    <? } ?>
</div>
<br/>
<? include_once 'includes/footer.php'; ?>