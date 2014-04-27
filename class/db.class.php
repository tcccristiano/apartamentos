<?php

class db{
    public function dbConectar($host, $user, $pass, $db){
        if(mysql_connect($host, $user, $pass) or die (mysql_error())){
            mysql_select_db($db);
        }else{
            echo "Nao foi possivel conectar ao db";
        }
    }
}

?>