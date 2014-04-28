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

    public function novoEvento($titulo, $descricao, $ativo, $usuarioId, $data){
        $dtNascimento = implode('-', array_reverse(explode('/', $data)));
        $sql = "INSERT INTO evento (nome, descricao, ativo, apartamento_id, data, data_criacao)
                                VALUES ('".$titulo."','".$descricao."','".$ativo."','".$_SESSION['apartamentoId']."', '".$data."', '".date('Y-m-d H:i:s')."');";
        $sqlQuery = mysql_query("INSERT INTO evento (nome, descricao, ativo, apartamento_id, data, data_criacao)
                                VALUES ('".$titulo."','".$descricao."','".$ativo."', '".$_SESSION['apartamentoId']."', '".$data."', '".date('Y-m-d H:i:s')."');");

        if($sqlQuery){
            $this->mensagem = 'Notificação cadastrada com sucesso!';
        }else{
            $this->mensagem = 'Notificação não cadastrada';
        }

        return $this->mensagem;
    }

    public function excluirEvento($id){

        $mensagem = null;
        $sqlQuery = mysql_query("DELETE FROM evento WHERE id = '".$id."' ");

        if($sqlQuery){
            $this->mensagem = 'Evento excluído com sucesso!';
        }else{
            $this->mensagem = 'Evento não foi excluído!';
        }

        return $this->mensagem;

    }

}

?>