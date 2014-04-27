<?php

class mensagens{

    public $respostaHtml;
    public $mensagens;
    public $minhasmsg;

    public function enviarMsg($texto, $usuario){
        $sqlquery="INSERT INTO mensagens (msg_texto, usuario_id) VALUES ('".$texto."', '".$usuario."')";
        mysql_query($sqlquery);
        if(mysql_affected_rows() > 0){
            echo "Mensagem enviada com sucesso";
        }else{
            echo "A mensagem não pode ser enviada";
        }
    }

    public function consultaMensagens(){
        $sqlquery = 'SELECT m.msg_id, m.msg_texto, u.usuario_id, u.usuario_nome, u.usuario_email, u.usuario_website
                        FROM mensagens m
                        INNER JOIN usuario u
                        on(m.usuario_id = u.usuario_id)
                        ORDER BY m.msg_id DESC';

        $result = mysql_query($sqlquery);
        if(mysql_num_rows($result) > 0){
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $this->mensagens[] = array(
                    'msg_id'        => $row[0],
                    'texto'         => $row[1],
                    'usr_id'        => $row[2],
                    'usr_nome'      => $row[3],
                    'usr_email'     => $row[4],
                    'usr_website'   => $row[5]
                );
            }
        }else{
            $this->html = 'nenhuma mensagem cadastrada';
        }
        $this->resposta();
    }

    public function minhasMensagens(){
        $sqlquery = "SELECT msg_texto FROM mensagens WHERE usuario_id='".$_SESSION['id']."'";
        $result = mysql_query($sqlquery);
        if(mysql_num_rows($result) > 0){
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $this->minhasmsg[] = array(
                        'msg_texto'   => $row[0]
                );
            }
        }else{
            $this->html = 'Você não enviou nenhuma mensagem!';
        }
        $this->resposta();
    }


    public function resposta(){
        if(count($this->mensagens) > 0){
            foreach($this->mensagens as $value){
                $this->html .= '<strong>'.$value['usr_nome'].':<br>'.'</strong>'.$value['texto'].'<br>';
                $this->html .= '<strong>E-mail: </strong>'.$value['usr_email'].'<br>';
                $this->html .= '<strong>Website: </strong>'.$value['usr_website'].'<br><br>';
            }
            echo $this->html;
        }else{
            echo $this->html;
        }
    }
}

