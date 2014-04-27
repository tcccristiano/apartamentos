<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/class/notificacoes.class.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/class/usuarios.class.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/class/mensagens.class.php'; ?>
<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/class/db.class.php'; ?>


<?php session_start(); ?>


<?php

$conectar = new db();

$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'apartamentos';

$conectar->dbConectar($host, $user, $pass, $db);
//if(is_null($_SESSION['id'])){
//    header ('Location: index.php');
//}
?>
