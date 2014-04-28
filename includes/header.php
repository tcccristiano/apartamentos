<!DOCTYPE html>
<html>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/config/config.php'; ?>
<head>
    <title>CondoControle</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/jquery.maskedinput.js" type="text/javascript"></script>

</head>

<? if(!is_null($_SESSION['id']) && isset($_SESSION['id'])) {?>
<div class="navbar">
    <ul class="breadcrumb">
        <li><a href="pagina_inicial.php">Home</a> <span class="divider">|</span></li>
        <? if($_SESSION['regra'] == 'admin') {?>
            <li><a href="usuarios.php">Usuarios</a> <span class="divider">|</span></li>
        <? } ?>
        <li><a href="notificacoes.php">Notificações</a> <span class="divider">|</span></li>
        <li><a href="eventos.php">Eventos</a> <span class="divider">|</span></li>
        <li><a href="sugestoes.php">Sugestões</a> <span class="divider">|</span></li>
        <li><a href="gastos.php">Gastos</a></li>
        <li style="float: right"><a href="logout.php">Sair</a> <span class="divider"></span></li>
        <li style="float: right"><a href="meuperfil.php">Meu perfil</a> <span class="divider">|</span></li>
        <li style="float: right">Bem vindo(a), <? echo $_SESSION['nome'] ?> !<span class="divider">|</span></li>
    </ul>
</div>
<? } ?>

