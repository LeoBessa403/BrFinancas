<?php

class Perfil
{

    function ListarPerfil()
    {
        $perfilModel = new PerfilModel();
        $this->result = $perfilModel->PesquisaTodos();
    }

    function FuncionalidadesPerfil()
    {
        $funcionalidadeModel = new FuncionalidadeModel();
        $perfilFuncionalidadeModel = new PerfilFuncionalidadeModel();
        $perfilModel = new PerfilModel();
        $this->co_perfil = UrlAmigavel::PegaParametro("per");
        if (!empty($_POST['co_perfil'])):
            $session = new Session();
            unset($_POST['funcionalidades-perfil']);
            $perfilFunc['co_perfil'] = $_POST['co_perfil'];
            $ok = $perfilFuncionalidadeModel->DeletaQuando($perfilFunc);
            if ($ok):
                if (!empty($_POST['funcionalidades'])):
                    $dados['co_perfil'] = $_POST['co_perfil'];
                    foreach ($_POST['funcionalidades'] as $value) {
                        $dados['co_funcionalidade'] = $value;
                        $perfilFuncionalidadeModel->Salva($dados);
                        $session->setSession(ATUALIZADO, "OK");
                    }
                endif;
//                if ($_POST['co_perfil'] == 3):
//                    $dados['co_perfil'] = $_POST['co_perfil'];
//                    $dados['co_funcionalidade'] = 6;
//                    PerfilModel::CadastraFuncionalidadesPerfil($dados);
//                endif;
            endif;

            $this->ListarPerfil();
            UrlAmigavel::$action = "ListarPerfil";
        endif;

        $this->funcionalidades = $funcionalidadeModel->PesquisaTodos();
        $this->perfil = $perfilModel->PesquisaUmRegistro($this->co_perfil);
    }

    function CadastroPerfil()
    {
        $perfilModel = new PerfilModel();
        $id = "cadastroPerfil";

        if (!empty($_POST[$id])):
            $session = new Session();
            $dados = $_POST;
            unset($dados[$id]);
            $perfil['no_perfil'] = trim($_POST['no_perfil']);

            if (!empty($_POST['co_perfil'])):
                $CoPerfil = $perfilModel->Salva($perfil, $_POST['co_perfil']);
                if ($CoPerfil):
                    $session->setSession(ATUALIZADO, "OK");
                endif;
            else:
                $coPerfil = $perfilModel->Salva($perfil);
                if ($coPerfil):
                    $session->setSession(CADASTRADO, "OK");
                endif;
            endif;
            $this->ListarPerfil();
            UrlAmigavel::$action = "ListarPerfil";
        endif;

        $co_perfil = UrlAmigavel::PegaParametro("per");
        $res = array();
        if ($co_perfil):
            /** @var PerfilEntidade $perf */
            $perf = $perfilModel->PesquisaUmRegistro($co_perfil);
            $res["no_perfil"] = $perf->getNoPerfil();
        endif;

        $formulario = new Form($id, "admin/Perfil/CadastroPerfil");
        $formulario->setValor($res);

        $formulario
            ->setId("no_perfil")
            ->setClasses("ob")
            ->setLabel("Perfil")
            ->CriaInpunt();
        
        if ($co_perfil):
            $formulario
                ->setType("hidden")
                ->setId("co_perfil")
                ->setValues($co_perfil)
                ->CriaInpunt();

        endif;
        $this->form = $formulario->finalizaForm();

    }

    public function montaComboTodosPerfis()
    {
        $PerfilModel = new PerfilModel();
        $Perfis = $PerfilModel->PesquisaTodos();
        $todosPerfis = array();
        foreach ($Perfis as $perfil) :
            $todosPerfis[$perfil->getCoPerfil()] = $perfil->getNoPerfil();
        endforeach;
        return $todosPerfis;
    }

    public function montaComboPerfil(UsuarioEntidade $usuario)
    {
        $meusPerfis = array();
        foreach ($usuario->getCoUsuarioPerfil() as $perfil) :
            $meusPerfis[$perfil->getCoPerfil()->getCoPerfil()] = $perfil->getCoPerfil()->getNoPerfil();
        endforeach;
        return $meusPerfis;
    }

    public function montaArrayPerfil(UsuarioEntidade $usuario)
    {
        $meusPerfis = array();
        foreach ($usuario->getCoUsuarioPerfil() as $perfil) :
            $meusPerfis[] = $perfil->getCoPerfil()->getCoPerfil();
        endforeach;
        return $meusPerfis;
    }


}

?>
   