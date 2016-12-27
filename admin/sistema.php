<?php
require_once 'library/Config.inc.php';
$url = new UrlAmigavel();
if (in_array(UrlAmigavel::$action, UrlAmigavel::$ACESSO_PERMITIDO)):
    $url->pegaControllerAction();
    exit;
endif;
$valida = new ValidaUsuario();
$compara = strstr(UrlAmigavel::$action, 'Exporta');
if ($compara != null):
    $url->pegaControllerAction();
    exit;
endif;
?>
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.3 Author: ClipTheme -->
<!--[if IE 8]>
<html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]>
<html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- start: HEAD -->
<head>
    <title>SISTEMA | <?= DESC; ?></title>
    <!-- start: META -->
    <meta charset="utf-8"/>
    <!--[if IE]>
    <meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1"/><![endif]-->
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta content="" name="description"/>
    <meta content="" name="author"/>
    <!-- end: META -->
    <!-- start: MAIN CSS -->
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>fonts/style.css">
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>css/main-responsive.css">
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>css/main.css">
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/iCheck/skins/all.css">
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/perfect-scrollbar/src/perfect-scrollbar.css">
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>css/theme_navy.css" type="text/css" id="skin_color">
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/css3-animation/animations.css">
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>css/print.css" type="text/css" media="print"/>
    <!--[if IE 7]>
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/font-awesome/css/font-awesome-ie7.min.css">
    <![endif]-->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->

    <!-- end: MAIN CSS -->
    <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/bootstrap-modal/css/bootstrap-modal-bs3patch.css"
          rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/bootstrap-modal/css/bootstrap-modal.css" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/fullcalendar/fullcalendar/fullcalendar.css">
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    <!-- start: CSS REQUIRED FOR DATAPICKER -->
    <link rel="stylesheet" href="<?= INCLUDES; ?>Jcalendar.css">
    <!-- start: CSS REQUIRED FOR SELECT -->
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/select2/select2.css">
    <!-- start: CSS REQUIRED FOR UPLOAD -->
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
    <!-- start: CSS REQUIRED FOR CHECK -->
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/bootstrap-switch/static/stylesheets/bootstrap-switch.css">
    <!-- start: CSS REQUIRED FOR CHECK -->
    <link rel="stylesheet" href="<?= PASTAADMIN; ?>plugins/DataTables/media/css/DT_bootstrap.css">
    <!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
    <link rel="shortcut icon" href="favicon.ico"/>
</head>
<!-- end: HEAD -->
<!-- start: BODY -->
<body>
<!-- start: HEADER -->
<div class="navbar navbar-inverse navbar-fixed-top">
    <!-- start: TOP NAVIGATION CONTAINER -->
    <div class="container">
        <div class="navbar-header">
            <!-- start: RESPONSIVE MENU TOGGLER -->
            <button data-target=".navbar-collapse" data-toggle="collapse" class="navbar-toggle" type="button">
                <span class="clip-list-2"></span>
            </button>
            <!-- end: RESPONSIVE MENU TOGGLER -->
            <!-- start: LOGO -->
            <a class="navbar-brand" href="<?= PASTAADMIN; ?>Index/Index">
                <?= DESC; ?>
            </a>
            <!-- end: LOGO -->
        </div>
        <div class="navbar-tools">
            <!-- start: TOP NAVIGATION MENU -->
            <ul class="nav navbar-right">
                <!-- start: USER DROPDOWN -->
                <li class="dropdown current-user">
                    <a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true"
                       href="#">
                        <?php
                        $us = $_SESSION[SESSION_USER];
                        $user = $us->getUser();
                        $fotoPerfil = $user[md5('ds_caminho')];
                        if ($fotoPerfil == ""):
                            $sexo = $user[md5('st_sexo')];
                            if ($sexo == "M"):
                                $fotoPerfil = "avatar-homem.jpg";
                            else:
                                $fotoPerfil = "avatar-mulher.jpg";
                            endif;
                        endif;

                        echo Valida::GetMiniatura("usuarios/" . $fotoPerfil, 'Leonardo', 35, 35, "circle-img");
                        ?>
                        <span class="username">
                            <?php
                            echo $user[md5('no_pessoa')];
                            ?>
                        </span>
                        <i class="clip-chevron-down"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?= PASTAADMIN; ?>Usuario/MeuPerfilUsuario">
                                <i class="clip-user-3"></i>
                                &nbsp;Meu Usuário
                            </a>
                        </li>
                        <li>
                            <a href="<?= PASTAADMIN; ?>login/deslogar/desloga/10">
                                <i class="clip-exit"></i>
                                &nbsp;Sair do Sistema
                            </a>
                        </li>
                    </ul>
                </li>
                <!-- end: USER DROPDOWN -->
            </ul>
            <!-- end: TOP NAVIGATION MENU -->
        </div>
    </div>
    <!-- end: TOP NAVIGATION CONTAINER -->
</div>
<!-- end: HEADER -->
<!-- start: MAIN CONTAINER -->
<div class="main-container">
    <div class="navbar-content">
        <!-- start: SIDEBAR -->
        <div class="main-navigation navbar-collapse collapse">
            <!-- start: MAIN MENU TOGGLER BUTTON -->
            <div class="navigation-toggler">
                <i class="clip-chevron-left"></i>
                <i class="clip-chevron-right"></i>
            </div>
            <!-- end: MAIN MENU TOGGLER BUTTON -->
            <!-- start: MAIN NAVIGATION MENU -->
            <?php
            $menu = array(//"Membros" => array("clip-tree","ListarMembros","ListarMembrosRetiro"),
//                "Tarefa" => array("fa fa-tasks","CadastroTarefa","ListarTarefa"),
//                "Evento" => array("fa fa-list","CadastroEvento","ListarEvento"),
//                "Biblioteca" => array("fa fa-book","CadastroLivro","ListarLivro"),
//                "Agenda" => array("fa fa-calendar","Calendario"),
                "Usuario" => array("fa fa-group", "MeuPerfilUsuario", "CadastroUsuario", "ListarUsuario"),
                "Perfil" => array("clip-stack-empty", "CadastroPerfil", "ListarPerfil"),
                "Funcionalidade" => array("fa fa-outdent", "CadastroFuncionalidade", "ListarFuncionalidade"),
                "Auditoria" => array("fa fa-cogs", "ListarAuditoria"),
            );
            $url->GeraMenu($menu);
            ?>
            <!-- end: MAIN NAVIGATION MENU -->
        </div>
        <!-- end: SIDEBAR -->
    </div>
    <!-- start: PAGE -->
    <?php
    $url->pegaControllerAction();
    ?>
    <!-- end: PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
<!-- start: FOOTER -->
<div class="footer clearfix">
    <div class="footer-inner">
        <?= date("Y"); ?> &copy; Leo Bessa Desenvolvimento.
    </div>
    <div class="footer-items">
        <span class="go-top"><i class="clip-chevron-up"></i></span>
    </div>
</div>
<!-- end: FOOTER -->
<?php Modal::aviso("alerta"); ?>
<!-- start: MAIN JAVASCRIPTS -->
<!--[if lt IE 9]>
<script src="<?= PASTAADMIN; ?>plugins/respond.min.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/excanvas.min.js"></script>
<script type="text/javascript" src="<?= INCLUDES;?>jquery-1.10.2.js"></script>
<![endif]-->
<!--[if gte IE 9]><!-->
<script src="<?= INCLUDES; ?>jquery-2.0.3.js"></script>
<!--<![endif]-->
<!--<script src="<?= PASTAADMIN; ?>plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>-->
<script src="<?= INCLUDES; ?>jquery-ui.js"></script>
<script type="text/javascript" src="<?= INCLUDES; ?>gera-grafico.js"></script>
<script type="text/javascript" src="<?= INCLUDES; ?>jquery.mask.js"></script>
<script type="text/javascript" src="<?= INCLUDES; ?>jquery.maskMoney.js"></script>
<?= '<script type="text/javascript">
                        function constantes(){    
                                var dados = {
                                    "HOME" : "' . HOME . '",
                                    "INATIVO" : "' . INATIVO . '",
                                    "PASTAUPLOADS" : "' . PASTAUPLOADS . '"                                        
                                    };
                                return dados;
                        }
                </script>'; ?>
<script type="text/javascript" src="<?= INCLUDES; ?>validacoes.js"></script>

<script src="<?= PASTAADMIN; ?>plugins/bootstrap/js/bootstrap.min.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/blockUI/jquery.blockUI.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/iCheck/jquery.icheck.min.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
<!--<script src="<?php //echo PASTAADMIN; ?>plugins/less/less-1.5.0.min.js"></script>-->
<script src="<?= PASTAADMIN; ?>plugins/jquery-cookie/jquery.cookie.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
<script src="<?= PASTAADMIN; ?>js/main.js"></script>
<script src="<?= PASTAADMIN; ?>js/ui-animation.js"></script>
<!-- end: MAIN JAVASCRIPTS -->
<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script src="<?= PASTAADMIN; ?>plugins/flot/jquery.flot.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/flot/jquery.flot.pie.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/flot/jquery.flot.resize.min.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/jquery.sparkline/jquery.sparkline.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/bootstrap-modal/js/bootstrap-modal.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/bootstrap-modal/js/bootstrap-modalmanager.js"></script>
<script src="<?= PASTAADMIN; ?>js/index.js"></script>

<script src="<?= PASTAADMIN; ?>plugins/select2/select2.min.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/bootstrap-switch/static/js/bootstrap-switch.min.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/DataTables/media/js/DT_bootstrap.js"></script>
<script src="<?= PASTAADMIN; ?>js/table-data.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/ckeditor/ckeditor.js"></script>
<script src="<?= PASTAADMIN; ?>plugins/ckeditor/adapters/jquery.js"></script>
<script src="<?= PASTAADMIN; ?>js/Funcoes.js"></script>
<script src="<?= PASTAADMIN; ?>js/FullCalendar.js"></script>
<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
<script>
    jQuery(document).ready(function () {
        Funcoes.init();
        <?php
        $session = new Session();
        if($session->CheckSession(ATUALIZADO)):
        $session->FinalizaSession(ATUALIZADO);
        ?>
        Funcoes.Sucesso("<?= Mensagens::OK_ATUALIZADO;?>");
        <?php
        endif;
        
        if($session->CheckSession(CADASTRADO)):
        $session->FinalizaSession(CADASTRADO);
        ?>
        Funcoes.Sucesso("<?= Mensagens::OK_SALVO;?>");
        <?php
        endif;
        if($session->CheckSession(MENSAGEM)):
        ?>
        Funcoes.Alerta("<?php echo $session->getSession(MENSAGEM);?>");
        <?php
        $session->FinalizaSession(MENSAGEM);
        endif;
        ?>
        Main.init();
        TableData.init();
        Calendar.init();
        Index.init();
    });
</script>
</body>
<!-- end: BODY -->
</html>