<?php

class mensagens{

    public $respostaHtml;
    public $mensagens;
    public $minhasmsg;

    public function enviarMsg($mensagem, $usuario){
        $sqlquery="INSERT INTO mensagens (usuario_id, mensagem) VALUES ('".$usuario."', '".$mensagem."')";
        mysql_query($sqlquery);
        if(mysql_affected_rows() > 0){
            echo "Mensagem enviada com sucesso";
        }else{
            echo "A mensagem não pode ser enviada";
        }
    }

    public function consultaMensagens(){
        $sqlquery = 'SELECT m.id, m.mensagem, u.id, u.nome, u.email, u.numero_apartamento
                        FROM mensagens m
                        INNER JOIN usuario u on(m.usuario_id = u.id)
                        INNER JOIN apartamento a ON u.apartamento_id = a.id
                        ORDER BY m.id DESC';

        $result = mysql_query($sqlquery);
        if(mysql_num_rows($result) > 0){
            while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
                $this->mensagens[] = array(
                    'msg_id'        => $row[0],
                    'texto'         => $row[1],
                    'usr_id'        => $row[2],
                    'usr_nome'      => $row[3],
                    'usr_email'     => $row[4],
                    'usr_apartamento'   => $row[5]
                );
            }
        }else{
            $this->html = 'nenhuma mensagem cadastrada';
        }
        print_r($this->resposta());
        die;

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
                $this->html = '<table style="width: 77%;"class="table table-bordered">
                <thead>
                <tr>
                    <th>'.$value['usr_nome'].' - Apto '.$value['usr_apartamento'].'</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><strong>Mensagem:</strong> '.$value['texto'].'</td>
                </tr>
                </tbody>
            </table>';
            }
            echo $this->html;
        }else{
            echo $this->html;
        }
    }
}

