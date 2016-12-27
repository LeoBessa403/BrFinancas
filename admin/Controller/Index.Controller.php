<?php

class Index
{

    function Index()
    {
    }

    function Registrar()
    {
        $id = "CadastroUsuario";
        if (!empty($_POST[$id])):
            $usuarioControl = new Usuario();
            $usuarioControl->salvaUsuario($_POST, $_FILES, true);
        endif;

        $this->form = UsuarioForm::Cadastrar(false, true, 12);
    }

    public function Acessar()
    {
        $acesso = UrlAmigavel::PegaParametro('acesso');
        $class = 0;
        $msg = "";
        $visivel = true;

        switch ($acesso) {
            case 'B':
                $msg = "Por Favor, Preencha o Usuário e senha!";
                $class = 2;
                break;
            case 'R':
                $msg = "Acesso Restrito, Você não tem permição para acessar!";
                $class = 4;
                break;
            case 'A':
                $msg = "CPF ou senha Inválido!";
                $class = 3;
                break;
            case 'I':
                $msg = "Usuário Inativo!";
                $class = 3;
                break;
            case 'D':
                $msg = "Usuário deslogado com sucesso!";
                $class = 1;
                break;
            case 'E':
                $msg = "Sua Sessão foi Expirada!";
                $class = 2;
                break;
            default:
                $visivel = false;
                break;

        }
        $this->class = " " . $class;
        $this->visivel = $visivel;
        $this->msg = $msg;
    }

    public static function Logar()
    {
        // CLASSE DE LOGAR
        $cpf = Valida::RetiraMascara(Valida::LimpaVariavel($_POST[Constantes::NU_CPF]));
        $senha = Valida::LimpaVariavel($_POST[Constantes::DS_SENHA]);

        if (($cpf != "") && ($senha != "")):

            $Model = new UsuarioModel();
            $usuarios = $Model->PesquisaTodos();

            $user = "";
            // Codifica a senha
            $senha = base64_encode(base64_encode($senha));
            /** @var UsuarioEntidade $usuario */
            foreach ($usuarios as $usuario):
                if (($usuario->getCoPessoa()->getNuCpf() == $cpf) && ($usuario->getDsCode() == $senha)):
                    if ($usuario->getStStatus() == "I"):
                        Redireciona(ADMIN . LOGIN . Valida::GeraParametro("acesso/I"));
                        exit();
                    endif;
                    /** @var UsuarioEntidade $user */
                    $user = $usuario;
                    break;
                endif;
            endforeach;
            if ($user != ""):
                $acesso[Constantes::DS_SESSION_ID] = session_id();
                $acesso[Constantes::CO_USUARIO] = $user->getCoUsuario();
                $acessoObj = new AcessoModel();
                $meuAcesso = $acessoObj->PesquisaUmQuando($acesso);
                if ($meuAcesso) {
                    $novoAcesso[Constantes::DT_FIM_ACESSO] = Valida::DataAtualBanco();
                    $acessoObj->Salva($novoAcesso, $user->getCoUsuario());
                } else {
                    $acesso[Constantes::DT_INICIO_ACESSO] = Valida::DataAtualBanco();
                    $acesso[Constantes::DT_FIM_ACESSO] = Valida::DataAtualBanco();
                    $acesso[Constantes::CO_USUARIO] = $user->getCoUsuario();
                    $acessoObj->Salva($acesso);
                }

                $perfis = array();
                $no_perfis = array();
                /** @var UsuarioPerfilEntidade $perfil */
                foreach ($user->getCoUsuarioPerfil() as $perfil) {
                    $perfis[] = $perfil->getCoPerfil()->getCoPerfil();
                    $no_perfis[] = $perfil->getCoPerfil()->getNoPerfil();
                }
                $usuarioAcesso[Constantes::CO_USUARIO] = $user->getCoUsuario();
                $usuarioAcesso[Constantes::DS_CAMINHO] = $user->getCoImagem()->getDsCaminho();
                $usuarioAcesso[Constantes::NU_CPF] = $user->getCoPessoa()->getNuCpf();
                $usuarioAcesso[Constantes::NO_PESSOA] = $user->getCoPessoa()->getNoPessoa();
                $usuarioAcesso[Constantes::ST_SEXO] = $user->getCoPessoa()->getStSexo();
                $usuarioAcesso[Constantes::DT_FIM_ACESSO] = Valida::DataAtualBanco();
                $usuarioAcesso[CAMPO_PERFIL] = implode(',', $perfis);
                $usuarioAcesso['no_perfis'] = implode(', ', $no_perfis);


                $session = new Session();
                $session->setUser($usuarioAcesso);
                Redireciona(ADMIN . LOGADO);
            else:
                Redireciona(ADMIN . LOGIN . Valida::GeraParametro("acesso/A"));
            endif;
        else:
            Redireciona(ADMIN . LOGIN . Valida::GeraParametro("acesso/B"));
        endif;
    }


    //*************************************************************//
    //************ EXEMPLOS DE ACTION ****************************//
    //*************************************************************//

    // EXEMPLO DE ENVIO DE EMAIL
    function EmailCliente()
    {
        $email = new Email();

        // Índice = Nome, e Valor = Email.
        $emails = array(
            "Leo Bessa Hot" => "leodjx@hotmail.com",
            "Lili Gmail" => "lililasp@gmail.com",
            "Lele Hot" => "lele.403@hotmail.com",
            "Leo Bessa Gmail" => "leonardomcbessa@gmail.com"
        );
        $Mensagem = "<h2>Olá vc ganhou um Bônus de 5 Milhões.... que piada</h2>";

        $email->setEmailDestinatario($emails)
            ->setTitulo("Email de  Teste Pra Todos")
            ->setMensagem($Mensagem);

        // Variável para validação de Emails Enviados com Sucesso.
        $this->Email = $email->Enviar();
    }

    // LISTAGEM COM PESQUISA AVANÇADA
    function ListarMembros()
    {
        $dados = array();
        if (!empty($_POST)):
            $dados['st_status'] = $_POST['st_status'][0];
            $dados['no_membro'] = $_POST['no_membro'];
        endif;
        $this->result = MembrosModel::PesquisaMembros($dados);
    }

    // AÇÃO DA TELA DE PESQUISA AVANÇADA
    function ListarMembrosPesquisaAvancada()
    {

        $id = "pesquisaMembros";

        $formulario = new Form($id, "admin/Membros/ListarMembros", "Pesquisa", 12);


        $label_options = array("" => "Todos", "S" => "Ativo", "N" => "Inativo");
        $formulario
            ->setLabel("Status do Membro")
            ->setId("st_status")
            ->setType("select")
            ->setOptions($label_options)
            ->CriaInpunt();

        $formulario
            ->setId("no_membro")
            ->setIcon("clip-user-6")
            ->setLabel("Nome do Membro")
            ->setInfo("Pode ser Parte do nome")
            ->CriaInpunt();

        echo $formulario->finalizaFormPesquisaAvancada();

    }

    // AÇÃO DE EXPORTAÇÃO
    function ExportarCategoria()
    {

        $formato = UrlAmigavel::PegaParametro("formato");
        $result = CategoriaModel::PesquisaCategoria();
        $i = 0;
        foreach ($result as $value) {
            $res[$i]['id_categoria'] = $value['id_categoria'];
            $res[$i]['nome'] = $value['nome'];
            $i++;
        }
        $Colunas = array('Código', 'Categoria');
        $exporta = new Exportacao($formato, "Relatório de Categorias");
        // $exporta->setPapelOrientacao("paisagem");
        $exporta->setColunas($Colunas);
        $exporta->setConteudo($res);
        $exporta->GeraArquivo();

    }


}

?>
   