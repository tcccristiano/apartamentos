<?php

class usuarios{

    public $resposta = NULL;

    public function listarUsuarios($id = NULL){


        $usuarios = array();

        if(!empty($id)){
            $sqlQuery = mysql_query("SELECT * FROM usuario WHERE id='".$id."' ");
        }else{
            $sqlQuery = mysql_query("SELECT * FROM usuario");
        }

        if(mysql_num_rows($sqlQuery) > 0){
            while($row = mysql_fetch_array($sqlQuery)){
                $usuarios[] = $row;
            }
        }
        return $usuarios;
    }

    public function editarUsuarios($id, $nome, $email, $data_nascimento, $senha = NULL){

        $dtNascimento = implode('-', array_reverse(explode('/', $data_nascimento)));

        if(!empty($senha)){
            $sqlQuery = mysql_query("UPDATE usuario SET nome='".$nome."',email='".$email."',data_nascimento='".$dtNascimento."',senha='".md5($senha)."' WHERE id='".$id."' ");
        }else{
            $sqlQuery = mysql_query("UPDATE usuario SET nome='".$nome."',email='".$email."',data_nascimento='".$dtNascimento."' WHERE id='".$id."' ");
        }

        if($sqlQuery){
            $this->resposta = "Usuário editado com sucesso";
        }else{
            $this->resposta = "Usuário não editado";
        }

        return $this->resposta;
    }

    public function cadastro($nome, $email, $dtNascimento, $regra, $numApartamento, $apartamentoId){
        $dtNascimento = implode('-', array_reverse(explode('/', $dtNascimento)));
        $sqlquery = "INSERT INTO usuario (nome, email, data_nascimento, senha, regra, apartamento_id, data_criacao, numero_apartamento)
                    VALUES ('".$nome."', '".$email."', '".$dtNascimento."', '".md5('alterar')."', '".$regra."', '".$apartamentoId."', '".date('Y-m-d H:i:s')."', '".$numApartamento."')";
        $valida = $this->verificaCadastro($email);
        if($valida){
            $query = mysql_query($sqlquery);
            if($query){
                $this->resposta = "Usuário Cadastrado com sucesso";
            }else{
                $this->resposta = "Usuário não cadastrado";
            }
        }
    }

    public function verificaCadastro($email){
        $consulta = "SELECT email FROM usuario WHERE email='".$email."'";
        $sql = mysql_query($consulta);
        if(mysql_num_rows($sql) <= 0){
            return TRUE;
        }else{
            $this->resposta = 'Este email ja está em uso';
        }
    }

    public function logar($email, $senha){
        $consulta = "SELECT * FROM usuario WHERE email='".$email."' AND senha='".md5($senha)."' AND ativo=1";
        $sql = mysql_query($consulta);
        if(mysql_num_rows($sql) > 0){
            while ($row = mysql_fetch_array($sql, MYSQL_NUM)) {
                $_SESSION['id'] = $row[0];
                $_SESSION['nome'] = $row[1];
                $_SESSION['email'] = $row[2];
                $_SESSION['dtNascimento'] = $row[3];
                $_SESSION['ativo'] = $row[4];
                $_SESSION['regra'] = $row[6];
                $_SESSION['apartamentoId'] = $row[7];
            }
            header ('Location: pagina_inicial.php');
        }else{
            $this->resposta = "Usuário não cadastrado";
        }
    }

    public function excluirUsuario($id){

        $mensagem = null;
        $sqlQuery = mysql_query("DELETE FROM usuario WHERE id = '".$id."' ");

        if($sqlQuery){
            $this->mensagem = 'Usuario excluído com sucesso!';
        }else{
            $this->mensagem = 'Usuario não foi excluído!';
        }

        return $this->mensagem;

    }
}


?>