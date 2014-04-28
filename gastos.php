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
    <? } ?>
    <? foreach($listarGastos as $listarGasto){ ?>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Serviço: <? echo $listarGasto['servico']; ?> <span style="float: right">R$ <? echo $listarGasto['valor']; ?></span></th>
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