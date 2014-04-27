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