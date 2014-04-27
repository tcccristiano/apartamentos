<?php include_once $_SERVER['DOCUMENT_ROOT'].'/apartamentos/config/config.php';

if(isset($_POST['msg'])){
    $msg = new mensagens();
    $msg->enviarMsg($_POST['msg'], $_SESSION['id']);
}else if(isset($_POST['excluir'])){
    $msg = new mensagens();
    $msg->consultaMensagens();
}else{
    $msg = new mensagens();
    $msg->consultaMensagens();
}