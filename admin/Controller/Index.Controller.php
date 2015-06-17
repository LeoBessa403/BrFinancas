<?php
          
class Index{
    

    function Index(){
        $grafico = new Grafico("coluna", "Gastos e Recebimentos", "gastos_recebimentos",320,320);
              
        $mes = date("m");
        $ano  = date("Y"); 
        $termo = -1;
        for ($i = 0; $i < 4; $i++) {            
            $mes_inicial = $mes+$termo;
            $termo++;
            if($mes_inicial == 13):
                $mes_inicial = 1;
                $mes         = 1;
                $termo       = 1;
                $ano         = $ano+1;
            endif;
            if($mes_inicial == 0):
                $mes_inicial = 12;
                $mes         = 12;
                $termo       = 1;
                $ano         = $ano-1;
            endif;
            if($mes_inicial < 10):
                $mes_inicial = "0".$mes_inicial;
            endif;
            $data_ini     = "01/".$mes_inicial."/".$ano;
            $data_inicial = Valida::DataShow("01-".$mes_inicial."-".$ano,"Y/m/d");
            $data_fim     = Valida::CalculaData(Valida::CalculaData($data_ini, 1, "+", "m"), 1, "-");
            $data_final   = Valida::DataShow(str_replace("/", "-", $data_fim), "Y/m/d");
            $RG[$i] = NegociacaoModel::PesquisaNegociacoesGastosRecebimentos($data_inicial,$data_final);           
                if(count($RG[$i]) == 0):
                    $rec_gas[$i]['recebimentos'] = 0;
                    $rec_gas[$i]['gastos'] = 0;
                else:
                    $rec_gas[$i]['recebimentos'] = 0;
                    $rec_gas[$i]['gastos'] = 0;
                    foreach ($RG[$i] as $key => $value) {
                        if($value["tipo_negociacao"] == "RC"):
                            if($value["valor_parcela_pago"] == ""):
                                $rec_gas[$i]['recebimentos'] += $value["valor_parcela"];
                            else:
                                $rec_gas[$i]['recebimentos'] += $value["valor_parcela_pago"];
                            endif;                            
                        else:
                            if($value["valor_parcela_pago"] == ""):
                                 $rec_gas[$i]['gastos'] += $value["valor_parcela"];
                            else:
                                 $rec_gas[$i]['gastos'] += $value["valor_parcela_pago"];
                            endif;                           
                        endif;                        
                    }
                endif;
               
                switch($mes_inicial)
                {
                        case '1':  $letra = 'Jan';break; 
                        case '2':  $letra = 'Fev';break;
                        case '3':  $letra = 'Mar';break; 
                        case '4':  $letra = 'Abr';break;
                        case '5':  $letra = 'Mai';break; 
                        case '6':  $letra = 'jun';break;
                        case '7':  $letra = 'Jul';break;
                        case '8':  $letra = 'Ago';break; 
                        case '9':  $letra = 'Set';break;
                        case '10': $letra = 'Out';break; 
                        case '11': $letra = 'Nov';break;
                        case '12': $letra = 'Dez';break;
                }
                $rec_gas[$i]['mes'] = $letra."/".$ano;
        }
         //debug($RG);
        
        $dados = array("['Mes','Recebimentos','Gastos']",
           "['".$rec_gas[0]["mes"]."',".$rec_gas[0]["recebimentos"].",".$rec_gas[0]["gastos"]."]",
	   "['".$rec_gas[1]["mes"]."',".$rec_gas[1]["recebimentos"].",".$rec_gas[1]["gastos"]."]",
           "['".$rec_gas[2]["mes"]."',".$rec_gas[2]["recebimentos"].",".$rec_gas[2]["gastos"]."]",
           "['".$rec_gas[3]["mes"]."',".$rec_gas[3]["recebimentos"].",".$rec_gas[3]["gastos"]."]");
        
        
        
        $grafico->setDados($dados);
        $this->grafico_coluna = $grafico->GeraGrafico();
    }
    
    public static function Logar(){     
    // CLASSE DE LOGAR
        $login = Valida::LimpaVariavel($_POST['user']);
        $senha = Valida::LimpaVariavel($_POST['senha']);
        
         if(($login != "") && ($senha != "")):
            $acesso = new Pesquisa();

            $acesso->Pesquisar(TABLE_USER);
            $user = "";
            foreach ($acesso->getResult() as $result):
                if (($result[CAMPO_USER] == $login) && ($result[CAMPO_PASS] == $senha)):
                    $user = $result; 
                    break;
                endif;
            endforeach;

            if($user != ""):          
                $user["session_id"] = session_id();               
                $user["ultimo_acesso"] = strtotime(Valida::DataDB(Valida::DataAtual()));  
                
                $usuario = new Session();
                $usuario->setUser($user);
                $usuario->setSession(SESSION_USER,$usuario);
                echo "<script type='text/javascript'>"
                        . "window.location.href = '".HOME.ADMIN.LOGADO."';"
                     . "</script>";
            else:
                Redireciona(ADMIN.LOGIN."?o=alerta2");
            endif;
        else:
                Redireciona(ADMIN.LOGIN."?o=info2");
        endif;     
    }
    
    
}
?>
   