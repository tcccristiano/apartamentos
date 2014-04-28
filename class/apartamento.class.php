<?php

class apartamentos{

    public $mensagem = NULL;

    public function listarApartamento($apartamentoId){

        $sqlQuery = mysql_query("SELECT * FROM apartamento WHERE id = '".$apartamentoId."' ");

        if($sqlQuery){
            $apartamento = mysql_fetch_array($sqlQuery);
        }

        return $apartamento;

    }
}

?>