<?php
if(!isset($_SESSION['email']) && (!isset($_SESSION['senha']))){
    header("Location: index.php");
}
?>