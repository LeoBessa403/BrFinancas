<?php

class Pagamento{ 
    
    public $form;
    public $result;
    public $resultAlt;
   
    function CadastroPagamento() {
        
        if(!empty($_POST["cadastroPagamento"])):
             $dados = $_POST;    
        
             $negoc['id_entidade'] = $dados['id_entidade'][0];
             $negoc['cadastro'] = Valida::DataDB($dados['cadastro']);
             $negoc['tipo_negociacao'] = "PG";                        
             $negoc['observacao'] = $dados["observacao"];             
             
             $id_neg = NegociacaoModel::CadastraPagamento($negoc);
            
             $pagam['id_negociacao'] = $id_neg;
             $pagam['valor_total'] = Valida::formataMoedaBanco($dados['valor_total']);             
             $pagam["tipo_pagamento"] = $dados["tipo_pagamento"][0];
             $pagam["numero_parcelas"] = $dados["numero_parcelas"];
             
             $val = true;
             if($dados["numero_parcelas"] == 1):
                 
                 $parcelamento['vencimento'] = Valida::DataDB($dados["vencimento"]);
                 $parcelamento['parcela'] = 1;
                 $parcelamento['valor_parcela'] = $pagam['valor_total'];
                 
                 if(strtotime(Valida::DataDB($dados["vencimento"])) <= strtotime(Valida::DataDB(Valida::DataAtual('d/m/Y')))):
                      $pagam["situacao"]       = "F";
                      $pagam["valor_pago"]     = $pagam['valor_total'];                      
                      $parcelamento['valor_parcela_pago'] = $pagam['valor_total'];
                      $parcelamento['vencimento_pago'] = Valida::DataDB($dados["vencimento"]);
                      $parcelamento['observacao_parcela'] = $dados["observacao"];                    
                 else:
                      $pagam["situacao"]       = "A";
                      $pagam["valor_pago"]     = null;
                 endif;
             else:
                 $pagam["situacao"]       = "A";
                 $pagam["valor_pago"]     = null;
             endif;                       
                     
             $id_pag = PagamentoModel::CadastraPagamento($pagam);
             $parcelamento['id_pagamento'] = $id_pag;
             
             if($dados["numero_parcelas"] > 1):
                $vlr_parcela =  ($pagam['valor_total'] / $dados["numero_parcelas"]);
                $parcelamento['valor_parcela'] = round($vlr_parcela,2);
                for($i=1;$i<=$dados["numero_parcelas"];$i++):       
                    $parcelamento['parcela'] = $i;                    
                    $parcelamento['observacao_parcela'] = "";
                    if($parcelamento['parcela'] > 1):
                        $parcelamento['vencimento'] = Valida::DataDB(Valida::CalculaData($dados["vencimento"],$dados["diferenca"]*($i-1),"+"));
                    else:
                        $parcelamento['vencimento'] = Valida::DataDB($dados["vencimento"]);
                    endif;
                
                    if(($parcelamento['parcela'] == $dados["numero_parcelas"]) && (($parcelamento['valor_parcela'] * $dados["numero_parcelas"]) < $pagam['valor_total'])):                       
                        $parcelamento['valor_parcela'] = $parcelamento['valor_parcela'] + ($valor_total - ($parcelamento['valor_parcela'] * $dados["numero_parcelas"]));     
                    endif;
                    $val = false;
                    $this->result = ParcelamentoModel::CadastraParcelamento($parcelamento);
                endfor;
             endif;
             
             if($val):
                $this->result = ParcelamentoModel::CadastraParcelamento($parcelamento);
             endif;             
        endif;
        
        if(!empty($_POST["atualizaPagamento"])):
             $dados = $_POST;    
             // VALIDAR CONDIÇÕES PARA ATUALIZAR PAGAMENTO
             //Valida::debug($dados);
             // DELETA AS PARCELAS JÁ CADASTRADAS
             $del_parcelas = ParcelamentoModel::DeletaParcelamentoIdPagamento($dados['id_pagamento']);
             if($del_parcelas):
                    $negoc['id_entidade'] = $dados['id_entidade'][0];
                    $negoc['cadastro'] = Valida::DataDB($dados['cadastro']);              
                    $negoc['observacao'] = $dados["observacao"];             

                    $negociacao = NegociacaoModel::AtualizaNegociacao($negoc,$dados['id_negociacao']);

                    if($negociacao):
                           $pagam['valor_total'] = Valida::formataMoedaBanco($dados['valor_total']);             
                           $pagam["tipo_pagamento"] = $dados["tipo_pagamento"][0];
                           $pagam["numero_parcelas"] = $dados["numero_parcelas"];

                           $val = true;
                           if($dados["numero_parcelas"] == 1):

                               $parcelamento['vencimento'] = Valida::DataDB($dados["vencimento"]);
                               $parcelamento['parcela'] = 1;
                               $parcelamento['valor_parcela'] = $pagam['valor_total'];

                               if(strtotime(Valida::DataDB($dados["vencimento"])) <= strtotime(Valida::DataDB(Valida::DataAtual('d/m/Y')))):
                                    $pagam["situacao"]                  = "F";
                                    $pagam["valor_pago"]                = $pagam['valor_total'];                      
                                    $parcelamento['valor_parcela_pago'] = $pagam['valor_total'];
                                    $parcelamento['vencimento_pago']    = Valida::DataDB($dados["vencimento"]);
                                    $parcelamento['observacao_parcela'] = $dados["observacao"];                    
                               else:
                                    $pagam["situacao"]       = "A";
                                    $pagam["valor_pago"]     = null;
                               endif;
                           else:
                               $pagam["situacao"]       = "A";
                               $pagam["valor_pago"]     = null;
                           endif;                       

                           $id_pag = PagamentoModel::AtualizaPagamento($pagam,$dados['id_pagamento']);
                           $parcelamento['id_pagamento'] = $dados['id_pagamento'];

                           if($dados["numero_parcelas"] > 1):
                              $vlr_parcela =  ($pagam['valor_total'] / $dados["numero_parcelas"]);
                              $parcelamento['valor_parcela'] = round($vlr_parcela,2);
                              for($i=1;$i<=$dados["numero_parcelas"];$i++):       
                                  $parcelamento['parcela'] = $i;                    
                                  $parcelamento['observacao_parcela'] = "";
                                  if($parcelamento['parcela'] > 1):
                                      $parcelamento['vencimento'] = Valida::DataDB(Valida::CalculaData($dados["vencimento"],$dados["diferenca"]*($i-1),"+"));
                                  else:
                                      $parcelamento['vencimento'] = Valida::DataDB($dados["vencimento"]);
                                  endif;

                                  if(($parcelamento['parcela'] == $dados["numero_parcelas"]) && (($parcelamento['valor_parcela'] * $dados["numero_parcelas"]) < $pagam['valor_total'])):                       
                                      $parcelamento['valor_parcela'] = $parcelamento['valor_parcela'] + ($pagam['valor_total'] - ($parcelamento['valor_parcela'] * $dados["numero_parcelas"]));     
                                  endif;
                                  $val = false;
                                  $this->result = ParcelamentoModel::CadastraParcelamento($parcelamento);
                              endfor;
                           endif;

                           if($val):
                              $this->result = ParcelamentoModel::CadastraParcelamento($parcelamento);
                           endif;
                    endif;
             endif;
        endif;
        
        $credor = CredorModel::PesquisaCredorSelect();
        $id_neg = UrlAmigavel::PegaParametro("neg");
        $res = array();
        if($id_neg):
            $result = NegociacaoModel::PesquisaUmaNegociacao($id_neg, "PG");
            $res = $result[0];
            $res['cadastro'] = Valida::DataShow($res['cadastro'], "d/m/Y");
            $res['valor_total'] = Valida::formataMoeda($res['valor_total']);
            
            $vencimentos = ParcelamentoModel::PesquisaInicioPagamento($res['id_pagamento']);
            
            $res['vencimento'] = Valida::DataShow($vencimentos[0]['vencimento'], "d/m/Y");
            if($res['numero_parcelas'] > 1):
                $res['diferenca'] = Valida::CalculaDiferencaDiasData(Valida::DataShow($vencimentos[0]['vencimento'], "d/m/Y"),Valida::DataShow($vencimentos[1]['vencimento'], "d/m/Y") );
            else:
                $res['diferenca'] = 0;
            endif;
            $id = "atualizaPagamento";
        endif;
       
        
        if(empty($res)):
            $res['numero_parcelas'] = 1;
            $res["observacao"] = "";
            $res["vencimento"] = Valida::DataAtual();
            $res["cadastro"] = Valida::DataAtual();
            $res['valor_total'] = "0,00";
            $res['diferenca'] = 0;
            $id = "cadastroPagamento";
        endif;
        //debug($res['id_pagamento']);
        $formulario = new Form($id, "admin/Pagamento/CadastroPagamento");
        $formulario->setValor($res);
        
        $formulario
                ->setType("select")
                ->setId("id_entidade")
                ->setClasses("ob")
                ->setLabel("Credor")
                ->setOptions($credor)
                ->setInfo("Quem ira receber o  seu pagamento.")
                ->CriaInpunt();
         
        $options = array("DI" => "Dinheiro","DB" => "Débito","CH" => "Cheque","CR" => "Crédito","BT" => "Boleto");
        $formulario
                ->setId("tipo_pagamento")
                ->setType("select")
                ->setOptions($options)
                ->setLabel("Tipo Pagamento")
                ->setTamanhoInput(4)
                ->setClasses("ob")
                ->CriaInpunt();
        
        
         $formulario
                ->setId("numero_parcelas")
                ->setLabel("QTD. Parcelas") 
                ->setTamanhoInput(4)
                ->setClasses("ob numero")
                ->CriaInpunt(); 
        
        $formulario
                ->setId("valor_total")
                ->setLabel("Total") 
                ->setTamanhoInput(4)
                ->setClasses("ob moeda")
                ->setInfo("Total do Pedido")
                ->CriaInpunt(); 
        
        $formulario
                ->setId("vencimento")
                ->setLabel("Inicio do Pagamento")
                ->setTamanhoInput(4)
                ->setInfo("Data de início de Pagamento")
                ->setClasses("ob data")
                ->CriaInpunt();
        
        $formulario
                ->setId("cadastro")
                ->setLabel("Data do Crédito")
                ->setTamanhoInput(4)
                ->setClasses("ob data")
                ->CriaInpunt();
        
        $formulario
                ->setId("diferenca")
                ->setLabel("Diferença de Dias")
                ->setTamanhoInput(4)
                ->setInfo("Diferença de Dias entre as Parcelas")
                ->setClasses("numero")
                ->CriaInpunt();
         
        $formulario
                ->setType("textarea") 
                ->setId("observacao")
                ->setLabel("Observação")
                ->CriaInpunt();
        
        if($id_neg):
                $formulario
                        ->setType("hidden")
                        ->setId("id_negociacao")
                        ->setValues($id_neg)
                        ->CriaInpunt();
        
                $formulario
                        ->setType("hidden")
                        ->setId("id_pagamento")
                        ->setValues($res['id_pagamento'])
                        ->CriaInpunt();
        endif;
         
        $this->form = $formulario->finalizaForm(); 
    }
    
    function CadastroContasMensais() {
        
        if(!empty($_POST["cadastroContasMensais"])):
             $dados = $_POST;    
        
             $negoc['id_entidade'] = $dados['id_entidade'][0];
             $negoc['cadastro'] = Valida::DataDB(Valida::DataAtual('d/m/Y'));
             $negoc['tipo_negociacao'] = "PG";                        
             $negoc['observacao'] = $dados["observacao"];             
             
             $id_neg = NegociacaoModel::CadastraPagamento($negoc);
            
             $pagam['id_negociacao'] = $id_neg;
             $pagam['valor_total'] = Valida::formataMoedaBanco($dados['valor_total']);             
             $pagam["tipo_pagamento"] = $dados["tipo_pagamento"][0];
             $pagam["numero_parcelas"] = 60;
             $pagam["situacao"]       = "A";
             $pagam["valor_pago"]     = null;
                                
                     
             $id_pag = PagamentoModel::CadastraPagamento($pagam);
             $parcelamento['id_pagamento'] = $id_pag;
             
                $vlr_parcela =  $pagam['valor_total'];
                $parcelamento['valor_parcela'] = round($vlr_parcela,2);
                for($i=1;$i<=$pagam["numero_parcelas"];$i++):       
                    $parcelamento['parcela'] = $i;                    
                    $parcelamento['observacao_parcela'] = "";
                    
                    $dia = date("d");
                    $mes = date("m");
                    $ano  = date("Y");
                    if($dia < $dados['dia']):                        
                        $data = $dados['dia']."/".$mes."/".$ano;
                    else:
                        if($mes == 12):
                            $data = $dados['dia']."/01/".($ano+1);
                        else:
                            $data = $dados['dia']."/".($mes+1)."/".$ano;
                        endif;
                        
                    endif;
                    
                    if($parcelamento['parcela'] > 1):
                        $parcelamento['vencimento'] = Valida::DataDB(Valida::CalculaData($data,($i-1),"+","m"));
                    else:
                        $parcelamento['vencimento'] = Valida::DataDB($data);
                    endif;
                    $this->result = ParcelamentoModel::CadastraParcelamento($parcelamento);
                endfor;
                      
                       
        endif;
        
        if(!empty($_POST["atualizaContasMensais"])):
             $dados = $_POST;    
             // VALIDAR CONDIÇÕES PARA ATUALIZAR PAGAMENTO
             //debug($dados);
             // DELETA AS PARCELAS JÁ CADASTRADAS
             $del_parcelas = ParcelamentoModel::DeletaParcelamentoIdPagamento($dados['id_pagamento']);
             if($del_parcelas):
                    $negoc['id_entidade'] = $dados['id_entidade'][0];              
                    $negoc['observacao'] = $dados["observacao"];             

                    $negociacao = NegociacaoModel::AtualizaNegociacao($negoc,$dados['id_negociacao']);

                    if($negociacao):
                           $pagam['valor_total'] = Valida::formataMoedaBanco($dados['valor_total']);             
                           $pagam["tipo_pagamento"] = $dados["tipo_pagamento"][0]; 
                           $pagam["numero_parcelas"] = 60;

                           $id_pag = PagamentoModel::AtualizaPagamento($pagam,$dados['id_pagamento']);
                           $parcelamento['id_pagamento'] = $dados['id_pagamento'];
                          
                            $vlr_parcela =  $pagam['valor_total'];
                            $parcelamento['valor_parcela'] = round($vlr_parcela,2);
                            for($i=1;$i<=$pagam["numero_parcelas"];$i++):       
                                $parcelamento['parcela'] = $i;                    
                                $parcelamento['observacao_parcela'] = "";
                                $dia = date("d");
                                $mes = date("m");
                                $ano  = date("Y");
                                if($dia < $dados['dia']):                        
                                    $data = $dados['dia']."/".$mes."/".$ano;
                                else:
                                    if($mes == 12):
                                        $data = $dados['dia']."/01/".($ano+1);
                                    else:
                                        $data = $dados['dia']."/".($mes+1)."/".$ano;
                                    endif;

                                endif;

                                if($parcelamento['parcela'] > 1):
                                    $parcelamento['vencimento'] = Valida::DataDB(Valida::CalculaData($data,($i-1),"+","m"));
                                else:
                                    $parcelamento['vencimento'] = Valida::DataDB($data);
                                endif;
                                $this->result = ParcelamentoModel::CadastraParcelamento($parcelamento);
                            endfor;
                    endif;
             endif;
        endif;
        
        $credor = CredorModel::PesquisaCredorSelect();
        $id_neg = UrlAmigavel::PegaParametro("neg");
        $res = array();
        if($id_neg):
            $result = NegociacaoModel::PesquisaUmaNegociacao($id_neg, "PG");
            $res = $result[0];
            $res['cadastro'] = Valida::DataShow($res['cadastro'], "d/m/Y");
            $res['valor_total'] = Valida::formataMoeda($res['valor_total']);            
            $vencimentos = ParcelamentoModel::PesquisaInicioPagamento($res['id_pagamento']);            
            $res['dia'] = Valida::DataShow($vencimentos[0]['vencimento'], "d");
            $id = "atualizaContasMensais";
        endif;
       
        
        if(empty($res)):
            $res["observacao"] = "";
            $res["dia"] = "";
            $res["cadastro"] = Valida::DataAtual();
            $res['valor_total'] = "0,00";
            $id = "cadastroContasMensais";
        endif;
        
        $formulario = new Form($id, "admin/Pagamento/CadastroContasMensais");
        $formulario->setValor($res);
        
        $formulario
                ->setType("select")
                ->setId("id_entidade")
                ->setClasses("ob")
                ->setLabel("Credor")
                ->setOptions($credor)
                ->setInfo("Quem ira receber o  seu pagamento.")
                ->CriaInpunt();
         
        $options = array("DI" => "Dinheiro","DB" => "Débito","CH" => "Cheque","CR" => "Crédito","BT" => "Boleto");
        $formulario
                ->setId("tipo_pagamento")
                ->setType("select")
                ->setOptions($options)
                ->setLabel("Tipo Pagamento")
                ->setTamanhoInput(4)
                ->setClasses("ob")
                ->CriaInpunt();      
        
        $formulario
                ->setId("valor_total")
                ->setLabel("Valor da Conta") 
                ->setTamanhoInput(4)
                ->setClasses("ob moeda")
                ->setInfo("Valor da Conta Aproximado")
                ->CriaInpunt(); 
        
        $formulario
                ->setId("dia")
                ->setLabel("Dia do Vencimento")
                ->setTamanhoInput(4)
                ->setInfo("Venci todo dia")
                ->setClasses("ob numero dia")
                ->CriaInpunt();
         
        $formulario
                ->setType("textarea") 
                ->setId("observacao")
                ->setLabel("Observação")
                ->CriaInpunt();
        
        if($id_neg):
                $formulario
                        ->setType("hidden")
                        ->setId("id_negociacao")
                        ->setValues($id_neg)
                        ->CriaInpunt();
        
                $formulario
                        ->setType("hidden")
                        ->setId("id_pagamento")
                        ->setValues($res['id_pagamento'])
                        ->CriaInpunt();
        endif;
         
        $this->form = $formulario->finalizaForm(); 
    }
   
    function EditaParcelamento(){   
        
        $id  = "editaParcelamento";
        $id_parcelamento = UrlAmigavel::PegaParametro("parc");
        $res = array();
        if($id_parcelamento):
            $result = ParcelamentoModel::PesquisaUmParcelamento($id_parcelamento);
            $res = $result[0];
            $res['valor_parcela'] = Valida::formataMoeda($res['valor_parcela']);
            $res['valor_parcela_pago'] = Valida::formataMoeda($res['valor_parcela_pago']);
            $res['vencimento'] = Valida::DataShow($res['vencimento'],"d/m/Y");
            if($res['vencimento_pago'] != ""):
                $res['vencimento_pago'] = Valida::DataShow($res['vencimento_pago'],"d/m/Y");            
            endif;              
        endif;
        
        
        $formulario = new Form($id, "admin/Pagamento/DetalhaPagamento/neg/".$res['id_negociacao']);
        $formulario->setValor($res);
             
        $formulario
                ->setId("parcela")
                ->setLabel("Parcela")
                ->setTamanhoInput(4)
                ->setClasses("ob numero disabilita")
                ->CriaInpunt();
        
        $formulario
                ->setId("valor_parcela")
                ->setLabel("Valor da Parcela")
                ->setTamanhoInput(4)
                ->setClasses("ob moeda disabilita")
                ->CriaInpunt();        
        
      
        
        $formulario
                ->setId("vencimento")
                ->setLabel("Vencimento")
                ->setClasses("data ob")
                ->setTamanhoInput(4)
                ->CriaInpunt();
        
          $formulario
                ->setId("valor_parcela_pago")
                ->setLabel("Valor Pago")
                ->setClasses("ob moeda")
                ->setTamanhoInput(6)
                ->CriaInpunt();
        
        $formulario
                ->setId("vencimento_pago")
                ->setLabel("Vencimento Pago")
                ->setClasses("data ob")
                ->setTamanhoInput(6)
                ->CriaInpunt();
               
         $formulario
                ->setId("observacao_parcela")
                ->setType("textarea")          
                ->setLabel("Observação da parcela")
                ->CriaInpunt();
        
          if($id_parcelamento):
                $formulario
                        ->setType("hidden")
                        ->setId("id_parcelamento")
                        ->setValues($id_parcelamento)
                        ->CriaInpunt();
          endif;
        
        $this->form = $formulario->finalizaForm(); 
    }
    
    function ListarPagamento(){       
       
        $this->result = NegociacaoModel::PesquisaNegociacoes("PG");
        $parcelamento = array();
        
        foreach ($this->result as $res) {
            $vencidas   = 0;
            $pagas      = 0;
            $avencer    = 0;
            $vencendo   = 0;
            $apresenta = true;
            $parcelas = NegociacaoModel::PesquisaParcelasListar($res['id_negociacao']);
            $parcelamento[$res['id_negociacao']] = "";
            if($res['numero_parcelas'] == 1):               
                if($res['situacao'] == "F"):
                    $parcelamento[$res['id_negociacao']] .= '<div class="alert alert-success alerta-pagamento">
                                                            <h5 class="alert-heading pago h5-pagamento"><i class="fa fa-check-circle"></i> '.Valida::DataShow($parcelas[0]['vencimento_pago'],"d/m/Y").'</h5>
                                                          </div>';
                        $pagas = "Todas";                                  
                else:                                                                                               
                    if(strtotime(Valida::DataDB(Valida::DataAtual('d/m/Y'))) > strtotime($parcelas[0]['vencimento'])):
                        if($parcelas[0]['vencimento_pago'] == null):
                             if(Valida::DataAtual('Y-m-d') == $parcelas[0]['vencimento']):                                 
                                    $parcelamento[$res['id_negociacao']] .=  '<div class="alert alert-warning alerta-pagamento">
                                                                    <h5 class="alert-heading devendo h5-pagamento"><i class="fa fa-exclamation-triangle"></i> '.Valida::DataShow($parcelas[0]['vencimento'],"d/m/Y").'</h5>
                                                                  </div>';
                                    $vencendo++;
                             else:
                                    $parcelamento[$res['id_negociacao']] .=  '<div class="alert alert-danger alerta-pagamento">
                                                                        <h5 class="alert-heading devendo h5-pagamento"><i class="fa fa-times-circle"></i> '.Valida::DataShow($parcelas[0]['vencimento'],"d/m/Y").'</h5>
                                                                      </div>';
                                    $vencidas++;                                  
                             endif;                                                                                            
                        else:
                                    $parcelamento[$res['id_negociacao']] .=  '<div class="alert alert-success alerta-pagamento">
                                                                        <h5 class="alert-heading pago h5-pagamento"><i class="fa fa-check-circle"></i> '.Valida::DataShow($parcelas[0]['vencimento_pago'],"d/m/Y").'</h5>
                                                                      </div>';
                                    $pagas++;                                    
                        endif;                                                                                                   
                    else:
                        if($parcelas[0]['vencimento_pago'] == null):                          
                                    $parcelamento[$res['id_negociacao']] .=  '<div class="alert alert-info alerta-pagamento">
                                                                        <h5 class="alert-heading areceber h5-pagamento"><i class="clip-info"></i> '.Valida::DataShow($parcelas[0]['vencimento'],"d/m/Y").'</h5>
                                                                      </div>';
                                    $avencer++;                                  
                        else:
                                    $parcelamento[$res['id_negociacao']] .=  '<div class="alert alert-success alerta-pagamento">
                                                                        <h5 class="alert-heading pago h5-pagamento"><i class="fa fa-check-circle"></i> '.Valida::DataShow($parcelas[0]['vencimento_pago'],"d/m/Y").'</h5>
                                                                      </div>';
                                    $pagas++;        
                        endif;
                    endif;
               endif;
            else:
                foreach ($parcelas as $par) {                
                
                        if($res['situacao'] == "F"):
//                            $parcelamento[$res['id_negociacao']] .= '<div class="alert alert-success alerta-pagamento">
//                                                                    <h5 class="alert-heading pago h5-pagamento"><i class="fa fa-check-circle"></i> '.Valida::DataShow($par['vencimento_pago'],"d/m/Y").'</h5>
//                                                                  </div>';
                            $pagas = "Todas";
                        else:                                                                                               
                            if(strtotime(Valida::DataDB(Valida::DataAtual('d/m/Y'))) > strtotime($par['vencimento'])):
                                if($par['vencimento_pago'] == ""):
                                    if(Valida::DataAtual('Y-m-d') == $par['vencimento']):                                         
                                         $parcelamento[$res['id_negociacao']] .=  '<div class="alert alert-warning alerta-pagamento">
                                                                            <h5 class="alert-heading devendo h5-pagamento"><i class="fa fa-exclamation-triangle"></i> '.Valida::DataShow($par['vencimento'],"d/m/Y").'</h5>
                                                                          </div>';
                                          $vencendo++;
                                     else:
                                         $parcelamento[$res['id_negociacao']] .=  '<div class="alert alert-danger alerta-pagamento">
                                                                                <h5 class="alert-heading devendo h5-pagamento"><i class="fa fa-times-circle"></i> '.Valida::DataShow($par['vencimento'],"d/m/Y").'</h5>
                                                                              </div>';
                                         $vencidas++;
                                     endif;                                                                                              
                                else:
//                                     $parcelamento[$res['id_negociacao']] .=  '<div class="alert alert-success alerta-pagamento">
//                                                                                <h5 class="alert-heading pago h5-pagamento"><i class="fa fa-check-circle"></i> '.Valida::DataShow($par['vencimento_pago'],"d/m/Y").'</h5>
//                                                                              </div>';
                                    $pagas++;
                                endif;                                                                                                   
                            else:                                 
                                 if($par['vencimento_pago'] == ""):
                                     $avencer++;
                                     if($apresenta):
                                            $parcelamento[$res['id_negociacao']] .=  '<div class="alert alert-info alerta-pagamento">
                                                                                    <h5 class="alert-heading areceber h5-pagamento"><i class="clip-info"></i> '.Valida::DataShow($par['vencimento'],"d/m/Y").'</h5>
                                                                                  </div>';
                                            $apresenta = false;
                                     endif;
                                 else:
                                     $pagas++;
                                 endif;
                                
                            endif;
                       endif;
                }
            endif;  
            $this->parc[$res['id_negociacao']]['vencidas'] = $vencidas;
            $this->parc[$res['id_negociacao']]['avencer'] = $avencer;
            $this->parc[$res['id_negociacao']]['pagas'] = $pagas;
            $this->parc[$res['id_negociacao']]['vencendo'] = $vencendo;
        }
        $this->parcelamento = $parcelamento;
    }
    
    function DetalhaPagamento(){
              
       $id_neg = UrlAmigavel::PegaParametro("neg");
       
         if(!empty($_POST["editaParcelamento"])):
            $dados = $_POST; 
           
            $parcA['valor_parcela_pago'] = Valida::formataMoedaBanco($dados['valor_parcela_pago']);
            $parcA['vencimento_pago'] = Valida::DataDB($dados['vencimento_pago']);        
                    
            $parc10     = ParcelamentoModel::AtualizaParcelamento($parcA, $dados['id_parcelamento']);                
            
            if($parc10):
                
                
                $todas_parcelas = NegociacaoModel::PesquisaParcelasListar($id_neg);
                
                 $pago = true;
                 $total = 0;
                 foreach ($todas_parcelas as $res2) {
                     if($res2['vencimento_pago'] == ""):
                         $pago = false;
                         $total += $res2['valor_parcela_pago'];
                     endif;
                 }
                
                 if($pago):
                     $negoc['valor_pago'] = $total;
                     $negoc['situacao'] = "F";
                     PagamentoModel::AtualizaPagamento($negoc, $id_neg);
                 endif;
                
                 $this->resultAlt = true;                                
            endif;
        endif;
        
       
       $negociacao = NegociacaoModel::PesquisaUmaNegociacao($id_neg, "PG");
       $this->negociacao = $negociacao[0];
       $this->parcelas   = ParcelamentoModel::PesquisaParcelamentoIdPagamento($this->negociacao['id_pagamento']);
       
        foreach ($this->parcelas as $res) {
                       
                if($res['vencimento_pago'] != ""):
                    $parcelamento[$res['id_parcelamento']] = '<div class="alert alert-success alerta-pagamento">
                                                            <h5 class="alert-heading pago h5-pagamento"><i class="fa fa-check-circle"></i> PAGO</h5>
                                                          </div>';
                else:                                                                                               
                    if(strtotime(Valida::DataDB(Valida::DataAtual('d/m/Y'))) > strtotime($res['vencimento'])):
                      
                             if(Valida::DataAtual('Y-m-d') == $res['vencimento']):                                 
                                  $parcelamento[$res['id_parcelamento']] =  '<div class="alert alert-warning alerta-pagamento">
                                                                    <h5 class="alert-heading devendo h5-pagamento"><i class="fa fa-exclamation-triangle"></i> HOJE</h5>
                                                                  </div>';
                             else:
                                  $parcelamento[$res['id_parcelamento']] =  '<div class="alert alert-danger alerta-pagamento">
                                                                        <h5 class="alert-heading devendo h5-pagamento"><i class="fa fa-times-circle"></i> VENCIDA</h5>
                                                                      </div>';
                             endif;                                                                                            
                                                                                                                          
                    else:
                        $parcelamento[$res['id_parcelamento']] =  '<div class="alert alert-info alerta-pagamento">
                                                                        <h5 class="alert-heading areceber h5-pagamento"><i class="clip-info"></i> A VENCER</h5>
                                                                      </div>';
                    endif;
               endif;
                   
        }
        $this->parcelamento = $parcelamento;
    }
}