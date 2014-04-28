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
            <h4>Cadastro de novo condômino</h4>
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
                    <input type="text" id="dtNascimento" placeholder="dd/mm/yyyy" name="dtNascimento">
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
                    <button type="submit" name="submit" class="btn btn-primary"">Salvar</button>
<!--                    <input type="submit" class="btn-sucess" value="Salvar">-->
                </div>
            </div>
        </form>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Apartamento</th>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Data de criação</th>
                <th>Ação</th>
            </tr>
            </thead>
            <tbody>
        <? foreach($listaUsuarios as $listaUsuario){ ?>
                <tr>
                    <td><? echo $listaUsuario['numero_apartamento']; ?></td>
                    <td><? echo $listaUsuario['nome']; ?></td>
                    <td><? echo $listaUsuario['email']; ?></td>
                    <td><? echo $listaUsuario['data_criacao']; ?></td>
                    <td><? if($_SESSION['regra'] == 'admin'){ ?>
                            <a class="btn-small btn-danger"  href="usuarios.php?excluir=<? echo $listaUsuario['id']; ?>"><strong>Excluir</strong></a>
                        <? } ?></td>
                </tr>
            </tbody>

        <? } ?>
        </table>
    </div>
<? include_once 'includes/footer.php'; ?>