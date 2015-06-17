<?php

class renda{ 
    
    public $result;
    public $resultAlt;
    public $form;
    
    function CadastroRenda(){    
        
        $id = "cadastroRenda";
        
        if(!empty($_POST[$id])):
            
            $dados = $_POST;            
            $dados["tipo_entidade"] = "R";
            if(isset($dados["tipo"]) && $dados["tipo"] != ""):
                $dados["tipo_pessoa"] = "F";
                $dados["cpf_cnpj"] = $dados["cpf"];
            else:
                $dados["tipo_pessoa"] = "J";
                $dados["cpf_cnpj"] = $dados["cnpj"];
            endif;

            unset($dados[$id],$dados["cpf"],$dados["cnpj"]); 
        
            if(!empty($_POST['id_entidade'])):
                
                    $fornec = RendaModel::PesquisaUmRenda($_POST['id_entidade']);
                    $dados[PessoaModel::chave_primaria] = $fornec[PessoaModel::chave_primaria];
                    $entidade = Valida::RecebiVariavel(EntidadeModel::campos, $dados);
                    $pessoa   = Valida::RecebiVariavel(PessoaModel::campos, $dados);
                    $dado     = Valida::RecebiVariavel(DadosModel::campos, $dados);                   
                    
                    $entid = EntidadeModel::AtualizaEntidade($entidade, $fornec['id_entidade']);
                    $pess  = PessoaModel::AtualizaPessoa($pessoa, $fornec['id_pessoa']);
                    $dad   = DadosModel::AtualizaDados($dado, $fornec['id_dados']);                   
                    
                    if($entid && $pess && $dad):
                        $this->resultAlt = true;
                    endif;
            else:
                    
                    $entidade = Valida::RecebiVariavel(EntidadeModel::campos, $dados);
                    $entidade["cadastro"] = Valida::DataDB(Valida::DataAtual());
                    
                    $idEntidade = EntidadeModel::CadastraEntidade($entidade);

                    if($idEntidade):
                        $pessoa = Valida::RecebiVariavel(PessoaModel::campos, $dados);
                        $pessoa['id_entidade'] = $idEntidade;

                        $idPessoa = PessoaModel::CadastraPessoa($pessoa);
                        $dados[PessoaModel::chave_primaria] = $idPessoa;
                         
                        if($idPessoa):
                                $dado = Valida::RecebiVariavel(DadosModel::campos, $dados);
                                $idDados = DadosModel::CadastraDados($dado); 

                                if($idDados):
                                    $this->result = true;
                                endif;

                        endif;

                    endif;
            endif;
        endif;
        
        $id_ent = UrlAmigavel::PegaParametro("ent");
        $res = array();
        if($id_ent):
            $res = RendaModel::PesquisaUmRenda($id_ent);
        endif;
        
        $checked = "checked";
        if(!empty($res)):
            if($res['tipo_pessoa'] == "F"):
                $checked = "checked";
                $res['cpf'] = $res['cpf_cnpj'];
                $res['cnpj'] = "";
            else:
                $checked = "";
                $res['cnpj'] = $res['cpf_cnpj'];
                $res['cpf'] = "";
            endif;
        endif;
        
        
       $formulario = new Form($id, "admin/Renda/CadastroRenda");
       $formulario->setValor($res);
             
        
        $label_options = array("Física","Jurídica","amarelo","vermelho");
        $formulario
                ->setClasses($checked)
                ->setId("tipo")
                ->setType("checkbox")
                ->setLabel("Tipo de Pessoa")
                ->setOptions($label_options)
                ->CriaInpunt();        

        $formulario
                ->setId("nome_razao")
                ->setLabel("Nome / Razão")
                ->setIcon("clip-user-3")
                ->setClasses("ob")
                ->setInfo("Nome da pessoa ou Razão social da empresa")
                ->CriaInpunt();
           

        $formulario
                ->setId("cpf")
                ->setLabel("CPF") 
                ->setTamanhoInput(6)
                ->setClasses("cpf")
                ->setInfo("Caso seja Pessoa Física")
                ->CriaInpunt();

         $formulario
                ->setId("cnpj")
                ->setLabel("CNPJ")  
                ->setTamanhoInput(6)
                ->setClasses("cnpj")
                ->setInfo("Caso seja Pessoa Jurídica")
                ->CriaInpunt();

         $formulario
                ->setId("tel1")
                ->setTamanhoInput(4)   
                ->setIcon("fa fa-phone")
                ->setLabel("Telefone 0800")
                ->setClasses("tel tel0800")
                ->CriaInpunt();

         $formulario
                ->setId("tel2")
                 ->setTamanhoInput(4) 
                 ->setIcon("fa fa-mobile-phone")
                ->setLabel("Telefone Celular")
                ->setClasses("tel")
                ->CriaInpunt();

         $formulario
                ->setId("tel3")
                ->setTamanhoInput(4) 
                ->setIcon("fa fa-phone")
                ->setLabel("Telefone da Empresa")
                ->setClasses("tel")
                ->CriaInpunt();

         $formulario
                ->setId("site")
                ->setTamanhoInput(6) 
                ->setIcon("clip-earth-2")
                ->setLabel("Site")
                ->CriaInpunt();

         $formulario
                ->setId("email") 
                ->setTamanhoInput(6)
                ->setIcon("clip-archive")
                ->setLabel("E-mail")
                ->setClasses("email")
                ->CriaInpunt();

          $formulario
                ->setType("textarea") 
                ->setId("observacao")
                ->setLabel("Observação")
                ->CriaInpunt();
        
          if($id_ent):
                $formulario
                        ->setType("hidden")
                        ->setId("id_entidade")
                        ->setValues($id_ent)
                        ->CriaInpunt();
          endif;
        
        $this->form = $formulario->finalizaForm(); 
    }
    
    function ListarRenda(){
        
        $this->result = RendaModel::PesquisaRenda();
    }
}