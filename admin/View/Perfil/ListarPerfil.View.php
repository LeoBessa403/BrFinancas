<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- start: PAGE TITLE & BREADCRUMB -->
                <ol class="breadcrumb">
                    <li>
                        <i class="clip-grid-6"></i>
                        <a href="#">
                            Perfis
                        </a>
                    </li>
                    <li class="active">
                        Listar
                    </li>
                </ol>
                <div class="page-header">
                    <h1>Perfis
                        <small>Listar Perfis</small>
                    </h1>
                </div>
                <!-- end: PAGE TITLE & BREADCRUMB -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <i class="fa fa-external-link-square"></i>
                        Perfis dos Usuários
                    </div>
                    <div class="panel-body">
                        <?php
                        Modal::load();
                        Modal::deletaRegistro("Perfil");
                        Modal::confirmacao("confirma_Perfil");
                        $arrColunas = array('Nome', 'Ações');
                        $grid = new Grid();
                        $grid->setColunasIndeces($arrColunas);
                        $grid->criaGrid();
                        /** @var PerfilEntidade $res */
                        foreach ($result as $res):
                            if ($res->getCoPerfil() > 1):
                                $acao = '<a href="' . PASTAADMIN . 'Perfil/CadastroPerfil/' .
                                    Valida::GeraParametro("per/" . $res->getCoPerfil()) . '" class="btn btn-primary tooltips" 
                                    data-original-title="Editar Registro" data-placement="top">
                                     <i class="fa fa-clipboard"></i>
                                 </a>
                                 <a href="' . PASTAADMIN . 'Perfil/FuncionalidadesPerfil/' .
                                    Valida::GeraParametro("per/" . $res->getCoPerfil()) . '" class="btn btn-dark-grey tooltips" 
                                       data-original-title="Funcionalidades do Perfil" data-placement="top">
                                        <i class="fa fa-outdent"></i>
                                    </a>';
                                if ($res->getCoPerfil() > 3)  :
                                    $acao .= ' '
                                        . '<a data-toggle="modal" role="button" class="btn btn-bricky 
                                        tooltips deleta" id="' . $res->getCoPerfil() . '" data-msg-restricao="MSG01"
                                           href="#Perfil" data-original-title="Excluir Registro" data-placement="top">
                                            <i class="fa fa-trash-o"></i>
                                        </a>';
                                endif;

                                $grid->setColunas($res->getNoPerfil());
                                $grid->setColunas($acao, 3);
                                $grid->criaLinha($res->getCoPerfil());
                            endif;
                        endforeach;
                        $grid->finalizaGrid();
                        ?>
                    </div>
                </div>
                <!-- end: DYNAMIC TABLE PANEL -->
            </div>
        </div>
        <!-- end: PAGE CONTENT-->
    </div>
</div>
<!-- end: PAGE -->