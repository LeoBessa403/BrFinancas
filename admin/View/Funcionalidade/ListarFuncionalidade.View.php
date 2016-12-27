<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <!-- start: PAGE TITLE & BREADCRUMB -->
                <ol class="breadcrumb">
                    <li>
                        <i class="clip-grid-6"></i>
                        <a href="#">
                            Funcionalidades
                        </a>
                    </li>
                    <li class="active">
                        Listar
                    </li>
                </ol>
                <div class="page-header">
                    <h1>Funcionalidades
                        <small>Listar Funcionalidades</small>
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
                        Funcionalidades do Sistema
                    </div>
                    <div class="panel-body">
                        <?php
                        Modal::load();
                        Modal::deletaRegistro("Funcionalidade");
                        Modal::confirmacao("confirma_Funcionalidade");
                        $arrColunas = array('Nome', 'Rota', 'Ações');
                        $grid = new Grid();
                        $grid->setColunasIndeces($arrColunas);
                        $grid->criaGrid();
                        /** @var FuncionalidadeEntidade $res */
                        foreach ($result as $res):
                            if ($res->getCoFuncionalidade() > 1):
                                $acao = '<a href="' . PASTAADMIN . 'Funcionalidade/CadastroFuncionalidade/' .
                                    Valida::GeraParametro("fun/" . $res->getCoFuncionalidade()) . '" class="btn btn-primary tooltips" 
                                   data-original-title="Editar Registro" data-placement="top">
                                    <i class="fa fa-clipboard"></i>
                                </a>
                                <a href="' . PASTAADMIN . 'Funcionalidade/PerfilFuncionalidades/' .
                                    Valida::GeraParametro("fun/" . $res->getCoFuncionalidade()) . '" class="btn btn-dark-grey tooltips" 
                                      data-original-title="Perfis da Funcionalidade" data-placement="top">
                                       <i class="fa fa-outdent"></i>
                                   </a>
                                <a data-toggle="modal" role="button" class="btn btn-bricky tooltips deleta" id="' .
                                    $res->getCoFuncionalidade() . '" 
                                   href="#Funcionalidade" data-original-title="Excluir Registro" data-placement="top">
                                    <i class="fa fa-trash-o"></i>
                                </a>';
                                $grid->setColunas($res->getNoFuncionalidade());
                                $grid->setColunas($res->getDsRota());
                                $grid->setColunas($acao, 3);
                                $grid->criaLinha($res->getCoFuncionalidade());
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