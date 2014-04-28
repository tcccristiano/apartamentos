<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/includes/header.php'; ?>

<?

if(isset($_SESSION['email']) && (isset($_SESSION['senha']))){
    header("Location: apartamentos.php");
}
if(is_null($_SESSION['id'])){
    header("Location: index.php");
}
?>

<?php

$cadastrar = new usuarios();

if(isset($_GET['excluir'])){
    $cadastrar->excluirUsuario($_GET['excluir']);
}

if(isset($_POST['email'])){
    $cadastrar->cadastro($_POST['nome'], $_POST['email'], $_POST['dtNascimento'], $_POST['regra'], $_POST['numApartamento'], $_POST['apartamentoId']);
    if(!is_null($cadastrar->resposta)){ ?>
        <div class="resposta">
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <strong>Atenção!</strong> <? echo $cadastrar->resposta ?>
            </div>
        </div>
    <? }
}

if($_SESSION['regra'] == 'admin'){
    $listaUsuarios = $cadastrar->listarUsuarios();
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
            $("#dtNascimento").mask("99/99/9999");
        });
    </script>

    <body>
    <div class="container">
        <div id="newuserlivro">
            <h4>Novo usuário? Inscreva-se!</h4>
        </div>
        <form name="cadastrodeusuarios" class="form-horizontal" method="post" action="usuarios.php" onsubmit="return validar(cadastrodeusuarios);">

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
                    <input type="text" id="dtNascimento" name="dtNascimento">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword">Regra</label>
                <div class="controls">
                    <select name="regra">
                        <option value="admin">Admin</option>
                        <option value="usuario">Usuário</option>
                    </select>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputEmail">Número do apartamento</label>
                <div class="controls">
                    <input type="text" name="numApartamento" placeholder="Número do apartamento">
                    <input type="hidden" name="apartamentoId" value="<? echo $_SESSION['apartamentoId'] ?>">
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <input type="submit" class="btn-sucess" value="Salvar">
                </div>
            </div>
        </form>
        <? foreach($listaUsuarios as $listaUsuario){ ?>
            <div class="list-group">
                <a href="#" class="list-group-item active">
                    <h4 class="list-group-item-heading"><? echo $listaUsuario['nome']; ?></h4>
                    <p class="list-group-item-text"><? echo $listaUsuario['descricao']; ?></p>
                    <? if($_SESSION['regra'] == 'admin'){ ?>
                        <a class="list-group-item-text" style="color:#CD2626" href="usuarios.php?excluir=<? echo $listaUsuario['id']; ?>">Excluir</a>
                    <? } ?>
                </a>
            </div>
        <? } ?>
    </div>
<? include_once 'includes/footer.php'; ?>