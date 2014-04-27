<?php

class usuarios{
// FAZER NOVO USUARIO E EXCLUIR USUARIO
    public $resposta = NULL;

    public function listarUsuarios(){

        $usuarios = array();

        $sqlQuery = mysql_query("SELECT * FROM usuario");

        if(mysql_num_rows($sqlQuery) > 0){
            while($row = mysql_fetch_array($sqlQuery)){
                $usuarios[] = $row;
            }
        }

        return $usuarios;
    }

    public function cadastro($nome, $email, $website, $senha){
        $sqlquery = "INSERT INTO usuario (usuario_nome, usuario_email, usuario_website, usuario_senha) VALUES ('".$nome."', '".$email."', '".$website."', '".md5($senha)."')";
        $valida = $this->verificaCadastro($email);
        if($valida){
            if(mysql_query($sqlquery)){
                $this->resposta = "Usuário Cadastrado com sucesso";
            }else{
                $this->resposta = "Usuário não cadastrado";
            }
        }
    }

    public function verificaCadastro($email){
        $consulta = "SELECT usuario_email FROM usuario WHERE usuario_email='".$email."'";
        $sql = mysql_query($consulta);
        if(mysql_num_rows($sql) <= 0){
            return TRUE;
        }else{
            $this->resposta = 'Este email ja está em uso';
        }
    }

    public function logar($email, $senha){
        $consulta = "SELECT id, nome, email, data_nascimento, apartamento_id, regra FROM usuario WHERE email='".$email."' AND senha='".md5($senha)."' AND ativo=1";
        $sql = mysql_query($consulta);
        while ($row = mysql_fetch_array($sql, MYSQL_NUM)) {
            $id = $row[0];
            $nome = $row[1];
            $email = $row[2];
            $dtNascimento = $row[3];
            $ativo = $row[4];
            $regra = $row[5];
        }
        if(mysql_num_rows($sql) > 0){
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $id;
            $_SESSION['nome'] = $nome;
            $_SESSION['dtNascimento'] = $dtNascimento;
            $_SESSION['ativo'] = $ativo;
            $_SESSION['regra'] = $regra;
            header ('Location: pagina_inicial.php');
        }else{
            $this->resposta = "Usuário não cadastrado";
        }
    }


}


?>