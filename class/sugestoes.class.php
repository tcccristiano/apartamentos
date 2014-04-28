<?php

class sugestoes{

    public $mensagem = NULL;

    public function listarSugestoes(){

        $minhasSugestoes= array();

        if($_SESSION['regra'] == 'admin'){
            $sqlQuery = mysql_query("SELECT *
                                        FROM   sugestao sg
                                               INNER JOIN usuario us
                                                       ON ( sg.usuario_id = us.id )
                                        WHERE  us.apartamento_id = '".$_SESSION['apartamentoId']."'
                                        ORDER  BY sg.id DESC; ");

        }else{
            $sqlQuery = mysql_query("SELECT * FROM sugestao WHERE usuario_id = '".$_SESSION['id']."' ORDER BY id DESC;");
        }

        if(mysql_num_rows($sqlQuery) > 0){
            while($row = mysql_fetch_array($sqlQuery)){
                $minhasSugestoes[] = $row;
            }
        }

        return $minhasSugestoes;

    }

    public function novaSugestao($titulo, $descricao, $ativo, $dataCriacao){

        $sqlQuery = mysql_query("INSERT INTO sugestao (nome, descricao, ativo, usuario_id, data_criacao) VALUES ('".$titulo."','".$descricao."','".$ativo."','".$_SESSION['id']."','".$dataCriacao."');");

        if($sqlQuery){
            $this->mensagem = 'Notificação cadastrada com sucesso!';
        }else{
            $this->mensagem = 'Notificação não cadastrada';
        }

        return $this->mensagem;
    }

    public function excluirSugestao($id){

        $mensagem = null;

        $sqlQuery = mysql_query("DELETE FROM sugestao WHERE id = '".$id."' ");

        if($sqlQuery){
            $this->mensagem = 'Sugestão excluída com sucesso!';
        }else{
            $this->mensagem = 'Sugestão não foi excluída!';
        }

        return $this->mensagem;

    }

}

?>