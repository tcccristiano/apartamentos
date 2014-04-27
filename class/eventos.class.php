<?php

class eventos{

    public $mensagem = NULL;

    public function listarEventos($usuarioId = NULL){

        $meusEventos = array();

        $sqlQuery = mysql_query("SELECT * FROM evento WHERE apartamento_id = '".$_SESSION['apartamentoId']."' ORDER BY id DESC;");

        if(mysql_num_rows($sqlQuery) > 0){
            while($row = mysql_fetch_array($sqlQuery)){
                $meusEventos[] = $row;
            }
        }

        return $meusEventos;

    }

    public function novoEvento($titulo, $descricao, $ativo, $usuarioId, $dataCriacao){

        $sqlQuery = mysql_query("INSERT INTO notificacao (titulo, descricao, ativo, usuario_id, data_criacao) VALUES ('".$titulo."','".$descricao."','".$ativo."','".$usuarioId."','".$dataCriacao."');");

        if($sqlQuery){
            $this->mensagem = 'Notificação cadastrada com sucesso!';
        }else{
            $this->mensagem = 'Notificação não cadastrada';
        }

        return $this->mensagem;
    }

    public function excluirEvento($id){

        $mensagem = null;

        $sqlQuery = mysql_query("DELETE FROM notificacao WHERE id = '".$id."' ");

        if(mysql_num_rows($sqlQuery) > 0){
            $this->mensagem = 'Notificação excluída com sucesso!';
        }else{
            $this->mensagem = 'Notificação não foi excluída!';
        }

        return $this->mensagem;

    }

}

?>