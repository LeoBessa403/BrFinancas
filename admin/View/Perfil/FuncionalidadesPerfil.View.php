<div class="main-content">
    <div class="container">
        <!-- start: PAGE HEADER -->
        <div class="row">
            <div class="col-sm-12">
                <!-- start: PAGE TITLE & BREADCRUMB -->
                <ol class="breadcrumb">
                    <li>
                        <i class="clip-home-3"></i>
                        <a href="<?php echo PASTAADMIN; ?>index/index">
                            Home
                        </a>
                    </li>
                    <li class="active">
                        Funcionalidades do Perfil
                    </li>
                </ol>
                <div class="page-header">
                    <h1>Funcionalidades do Perfil
                        <small> Realizar Cadastro e Edição</small>
                    </h1>
                </div>
                <p>Perfil: </br></p>
                <h3 style="font-family: serif; font-style: italic; margin-top: 0; padding-top: 0;">
                    <?php echo $perfil->getNoPerfil(); ?>
                </h3>
                <div class="col-sm-3">
                    <label>
                        <input id='todas' name='todas' type='checkbox' class="todas"/>
                        Todas Funcionalidades
                    </label><br>
                    <hr>
                </div>
                <!-- end: PAGE TITLE & BREADCRUMB -->
            </div>
        </div>
        <!-- end: PAGE HEADER -->
        <!-- start: PAGE CONTENT -->
        <?php
        Modal::load();
        ?>
        <div class="row">
            <div class="panel-body">
                <form action="<?php echo HOME; ?>admin/Perfil/FuncionalidadesPerfil" role="form"
                      id="funcionalidades-perfil" name="funcionalidades-perfil" method="post"
                      enctype="multipart/form-data" class="formulario">
                    <?php
                    $bloqueados = array(1, 9, 6, 10, 11, 12, 13);
                    /** @var FuncionalidadeEntidade $func */
                    foreach ($funcionalidades as $func):
//                        if (!in_array($func->getCoFuncionalidade(), $bloqueados)):
                            $checked = "";
                            /** @var PerfilFuncionalidadeEntidade $value */
                            foreach ($perfil->getCoPerfilFuncionalidade() as $value) {
                                if ($func->getCoFuncionalidade() == $value->getCoFuncionalidade()->getCoFuncionalidade()):
                                    $checked = "checked";
                                endif;
                            }
                            ?>
                            <div class="col-sm-3">
                                <label>
                                    <input id='fun-<?php echo $func->getCoFuncionalidade(); ?>' name='funcionalidades[]'
                                           value='<?php echo $func->getCoFuncionalidade(); ?>' type='checkbox'
                                           class="funcionalidade" <?php echo $checked; ?> />
                                    <?php echo $func->getNoFuncionalidade(); ?>
                                </label><br>
                                <hr>
                            </div>
                            <?php
//                        endif;
                    endforeach;
                    ?>

                    <div class="col-sm-12">
                        <button data-style="zoom-out" class="btn btn-success ladda-button" type="submit"
                                value="funcionalidades-perfil" name="funcionalidades-perfil">
                            <span class="ladda-label"> Salvar </span>
                            <i class="fa fa-save"></i>
                            <span class="ladda-spinner"></span>
                        </button>
                        <a href="<?php echo PASTAADMIN . 'Perfil/ListarPerfil'; ?>"
                           class="btn btn-primary tooltips" data-original-title="Voltar" data-placement="top">
                            Voltar <i class="clip-arrow-right-2"></i>
                        </a>
                        <input id="id_credenciado" name="co_perfil" value="<?php echo $co_perfil; ?>" type="hidden"/>
                </form>
            </div>
        </div>

    </div>
    <!-- end: PAGE CONTENT-->
</div>
</div>