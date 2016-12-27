<?php

class Funcionalidade
{

    function ListarFuncionalidade()
    {
        $funcionalidadeModel = new FuncionalidadeModel();
        $this->result = $funcionalidadeModel->PesquisaTodos();
    }


    function CadastroFuncionalidade()
    {

        $id = "cadastroFuncionalidade";
        $session = new Session();
        $funcionalidadeModel = new FuncionalidadeModel();

        if (!empty($_POST[$id])):

            $dados = $_POST;
            unset($dados[$id]);

            $funcionalidade['no_funcionalidade'] = trim($_POST['no_funcionalidade']);
            $funcionalidade['ds_rota'] = trim($_POST['ds_rota']);

            if (!empty($_POST['co_funcionalidade'])):
                $coFuncionalidade = $funcionalidadeModel->Salva($funcionalidade, $_POST['co_funcionalidade']);
                if ($coFuncionalidade):
                    $session->setSession(ATUALIZADO, "OK");
                endif;
            else:
                $coFuncionalidade = $funcionalidadeModel->Salva($funcionalidade);
                if ($coFuncionalidade):
                    $session->setSession(CADASTRADO, "OK");
                endif;
            endif;
            $this->ListarFuncionalidade();
            UrlAmigavel::$action = "ListarFuncionalidade";
        endif;

        $co_funcionalidade = UrlAmigavel::PegaParametro("fun");
        $res = array();
        if ($co_funcionalidade):
            /** @var FuncionalidadeEntidade $func */
            $func = $funcionalidadeModel->PesquisaUmRegistro($co_funcionalidade);
            $res['no_funcionalidade'] = $func->getNoFuncionalidade();
            $res['ds_rota'] = $func->getDsRota();
        endif;

        $formulario = new Form($id, "admin/Funcionalidade/CadastroFuncionalidade");
        $formulario->setValor($res);

        $formulario
            ->setId("no_funcionalidade")
            ->setClasses("ob")
            ->setLabel("Funcionalidade")
            ->CriaInpunt();

        $formulario
            ->setId("ds_rota")
            ->setClasses("ob")
            ->setLabel("Rota")
            ->CriaInpunt();


        if ($co_funcionalidade):

            $formulario
                ->setType("hidden")
                ->setId("co_funcionalidade")
                ->setValues($co_funcionalidade)
                ->CriaInpunt();

        endif;


        $this->form = $formulario->finalizaForm();

    }

    function PerfilFuncionalidades()
    {
        $funcionalidadeModel = new FuncionalidadeModel();
        $perfilFuncionalidadeModel = new PerfilFuncionalidadeModel();
        $perfilModel = new PerfilModel();
        if (!empty($_POST['co_funcionalidade'])):
            $session = new Session();
            unset($_POST['funcionalidades-perfil']);
            $perfilFunc['co_funcionalidade'] = $_POST['co_funcionalidade'];
            $ok = $perfilFuncionalidadeModel->DeletaQuando($perfilFunc);
            if ($ok):
                if (!empty($_POST['perfis'])):
                    $dados['co_funcionalidade'] = $_POST['co_funcionalidade'];
                    foreach ($_POST['perfis'] as $value) {
                        $dados['co_perfil'] = $value;
                        $perfilFuncionalidadeModel->Salva($dados);
                        $session->setSession(ATUALIZADO, "OK");
                    }
                endif;
            endif;

            $this->ListarFuncionalidade();
            UrlAmigavel::$action = "ListarFuncionalidade";
        else:
            $this->co_funcionalidade = UrlAmigavel::PegaParametro("fun");
        endif;

        $this->funcionalidade = $funcionalidadeModel->PesquisaUmRegistro($this->co_funcionalidade);
        $this->perfis = $perfilModel->PesquisaTodos();

    }


}

?>
   