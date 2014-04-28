<?php

class gastos{

    public $mensagem = NULL;

    public function listarGastos($apartamentoId){

        $meusGastos = array();

        $sqlQuery = mysql_query("SELECT * FROM gastos g
                                           INNER JOIN apartamento a
                                                   ON ( a.id = g.apartamento_id ) WHERE g.apartamento_id = '".$apartamentoId."'");

        if(mysql_num_rows($sqlQuery) > 0){
            while($row = mysql_fetch_array($sqlQuery)){
                $meusGastos[] = $row;
            }
        }

        return $meusGastos;

    }

    public function novoGasto($servico, $descricao, $apartamento_id, $valor){

        $sqlQuery = mysql_query("INSERT INTO gastos (servico, descricao, apartamento_id, valor) VALUES ('".$servico."','".$descricao."','".$apartamento_id."','".$valor."');");

        if($sqlQuery){
            $this->mensagem = 'Gasto cadastrado com sucesso!';
        }else{
            $this->mensagem = 'Gasto não cadastrado';
        }

        return $this->mensagem;
    }

    public function excluirGasto($id){

        $sqlQuery = mysql_query("DELETE FROM gastos WHERE id = '".$id."' ");

        if(mysql_num_rows($sqlQuery) > 0){
            $this->mensagem = 'Gasto excluído com sucesso!';
        }else{
            $this->mensagem = 'Gasto não foi excluído!';
        }

        return $this->mensagem;

    }

}

?>