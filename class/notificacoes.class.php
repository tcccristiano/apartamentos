<?php

class notificacoes{

    public $mensagem = NULL;

    public function listarNotificacoes($usuarioId = NULL){

        $minhasNotificacoes = array();

        if(!empty($usuarioId)){
            $sqlQuery = mysql_query("SELECT * FROM notificacao WHERE usuario_id = '".$usuarioId."' ORDER BY id DESC;");
        }else{
            $sqlQuery = mysql_query("SELECT nt.id, nt.titulo, nt.descricao, nt.data_criacao FROM notificacao nt
                                        INNER JOIN usuario us
                                          ON ( nt.usuario_id = us.id )
                                        WHERE us.apartamento_id = '".$_SESSION['apartamentoId']."' ORDER BY nt.id DESC");
        }

        if(mysql_num_rows($sqlQuery) > 0){
            while($row = mysql_fetch_array($sqlQuery)){
                $minhasNotificacoes[] = $row;
            }
        }

        return $minhasNotificacoes;

    }

    public function novaNotificacao($titulo, $descricao, $ativo, $usuarioId, $dataCriacao){

        $sqlQuery = mysql_query("INSERT INTO notificacao (titulo, descricao, ativo, usuario_id, data_criacao) VALUES ('".$titulo."','".$descricao."','".$ativo."','".$usuarioId."','".$dataCriacao."');");

        if($sqlQuery){
            $this->mensagem = 'Notificação cadastrada com sucesso!';
        }else{
            $this->mensagem = 'Notificação não cadastrada';
        }

        return $this->mensagem;
    }

    public function excluirNotificacao($id){

        $mensagem = null;

        $sqlQuery = mysql_query("DELETE FROM notificacao WHERE id = '".$id."' ");

        if($sqlQuery){
            $this->mensagem = 'Notificação excluída com sucesso!';
        }else{
            $this->mensagem = 'Notificação não foi excluída!';
        }

        return $this->mensagem;

    }

}

?>