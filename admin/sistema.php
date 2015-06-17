<?php
    require_once 'valida_user.php'; 
    $url2 = new UrlAmigavel();
    $compara = strstr(UrlAmigavel::$action,'Exporta');
    if($compara != null):
        $url2->pegaControllerAction();
        exit;
    endif;
?>
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.3 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title>SISTEMA | <?php echo DESC;?></title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<!-- end: META -->
		<!-- start: MAIN CSS -->
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>fonts/style.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>css/main-responsive.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>css/main.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>css/theme_navy.css" type="text/css" id="skin_color">
                <link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/css3-animation/animations.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>css/print.css" type="text/css" media="print"/>
                <!--[if IE 7]>
                    <link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
                <!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
               
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR FULLCALENDARIO -->
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/fullcalendar/fullcalendar/fullcalendar.css">
                <!-- start: CSS REQUIRED FOR DATAPICKER -->
		<link rel="stylesheet" href="<?php echo INCLUDES;?>Jcalendar.css">
                <!-- start: CSS REQUIRED FOR SELECT -->
                <link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/select2/select2.css"> 
                <!-- start: CSS REQUIRED FOR UPLOAD -->
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/bootstrap-fileupload/bootstrap-fileupload.min.css">
                <!-- start: CSS REQUIRED FOR CHECK -->
                <link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/bootstrap-switch/static/stylesheets/bootstrap-switch.css">
                <!-- start: CSS REQUIRED FOR CHECK -->
                <link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/DataTables/media/css/DT_bootstrap.css">
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
		<link rel="shortcut icon" href="favicon.ico" />
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
                                        <a class="navbar-brand" href="<?php echo PASTAADMIN;?>">
						<?php echo DESC;?>
					</a>
					<!-- end: LOGO -->
				</div>
				<div class="navbar-tools">
					<!-- start: TOP NAVIGATION MENU -->
					<ul class="nav navbar-right">
						<!-- start: USER DROPDOWN -->
                                                <?php
                                                                                    
                                                     $pagamentos  = NegociacaoModel::PesquisaNegociacoesEmAberto();
                                                     $pagamentos2 = NegociacaoModel::PesquisaNegociacoesProximas();                                                    
                                                     $Total = count($pagamentos) + count($pagamentos2);
                                                ?>
						<li class="dropdown">
							<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
								<i class="fa-credit-card fa"></i>
                                                                <span class="badge"> <?php echo $Total; ?></span>
							</a>
							<ul class="dropdown-menu todo">
								<li>
									<span class="dropdown-menu-title"> Recebimentos e Pagamentos</span>
								</li>
								<li>
									<div class="drop-down-wrapper">
										<ul>
                                                                                    <?php
                                                                                        $receber = 0;
                                                                                        $pagar   = 0;
                                                                                        foreach ($pagamentos as $pag_res):
                                                                                    ?>
                                                                                        <li>
												<a href="
                                                                                                   <?php echo 'admin/';
                                                                                                   if($pag_res['tipo_negociacao'] == "RC"):
                                                                                                       echo "Recebimento/DetalhaRecebimento";
                                                                                                   else:
                                                                                                       echo "Pagamento/DetalhaPagamento";
                                                                                                   endif;                                                                                                   
                                                                                                   echo '/neg/'.$pag_res["id_negociacao"]; ?>
                                                                                                   ">
                                                                                                    <i class="fa fa-square-o"></i> <b>                                                                                                     
                                                                                                         <?php 
                                                                                                            if($pag_res['tipo_negociacao'] == "RC"):
                                                                                                               echo '<span class="text-success">'; 
                                                                                                               echo "RECEBER";
                                                                                                               $receber += $pag_res['valor_parcela'];
                                                                                                             else:
                                                                                                                echo '<span class="text-danger">';
                                                                                                                echo "APAGAR";
                                                                                                                $pagar += $pag_res['valor_parcela'];
                                                                                                             endif;
                                                                                                                echo " ".Valida::formataMoeda($pag_res['valor_parcela'],"R$");
                                                                                                                ?></span></b> 
                                                                                                        <?php
                                                                                                            if(strtotime(Valida::DataAtual('Y/m/d')) > strtotime($pag_res['vencimento'])):
                                                                                                                echo '<span class="label label-danger" style="opacity: 1;"> '.Valida::DataShow($pag_res['vencimento'], "d/m/y").'</span>';
                                                                                                            else:
                                                                                                                echo '<span class="label label-warning" style="opacity: 1;"> Hoje</span>';
                                                                                                            endif;
                                                                                                        ?>
												</a>
											</li>
                                                                                        
                                                                                    <?php
                                                                                        endforeach;
                                                                                    ?>
<!--                                                                                    /// SEGUNDO RESUTADO-->
                                                                                    <?php
                                                                                        foreach ($pagamentos2 as $pag_res):
                                                                                    ?>
                                                                                        <li>
												<a href="
                                                                                                   <?php echo 'admin/';
                                                                                                   if($pag_res['tipo_negociacao'] == "RC"):
                                                                                                       echo "Recebimento/DetalhaRecebimento";
                                                                                                   else:
                                                                                                       echo "Pagamento/DetalhaPagamento";
                                                                                                   endif;                                                                                                   
                                                                                                   echo '/neg/'.$pag_res["id_negociacao"]; ?>
                                                                                                   ">
                                                                                                    <i class="fa fa-square-o"></i> <b>                                                                                                     
                                                                                                         <?php 
                                                                                                            if($pag_res['tipo_negociacao'] == "RC"):
                                                                                                               echo '<span class="text-success">'; 
                                                                                                               echo "RECEBER";
                                                                                                               $receber += $pag_res['valor_parcela']; 
                                                                                                             else:
                                                                                                                echo '<span class="text-danger">';
                                                                                                                echo "APAGAR";
                                                                                                                $pagar += $pag_res['valor_parcela'];
                                                                                                             endif;
                                                                                                                echo " ".Valida::formataMoeda($pag_res['valor_parcela'],"R$");
                                                                                                          ?></span></b> 
                                                                                                        <?php
                                                                                                                echo '<span class="label label-info" style="opacity: 1;"> '.Valida::DataShow($pag_res['vencimento'], "d/m/y").'</span>';
                                                                                                         ?>
												</a>
											</li>
                                                                                        
                                                                                    <?php
                                                                                        endforeach;
                                                                                    ?>
										</ul>
									</div>
								</li>
								<li class="view-all active">
									<a href="javascript:void(0)">
                                                                            <span class="dropdown-menu-title">A Receber <b><?php echo Valida::formataMoeda($receber,"R$"); ?></b> <br/> A Pagar <b><?php echo Valida::formataMoeda($pagar,"R$"); ?></b></span>
									</a>
								</li>
							</ul>
						</li>
						<li class="dropdown current-user">
							<a data-toggle="dropdown" data-hover="dropdown" class="dropdown-toggle" data-close-others="true" href="#">
								<img src="<?php echo PASTAADMIN; ?>images/avatar-1-small.jpg" class="circle-img" alt="">
                                                                <span class="username">
                                                                    <?php                                                                 
                                                                           $us = $_SESSION[SESSION_USER];                                                                    
                                                                           $user = $us->getUser();
                                                                           echo $user[md5('nome')];                                                              

                                                                      ?>
                                                                </span>
								<i class="clip-chevron-down"></i>
							</a>
							<ul class="dropdown-menu">
								<li>
									<a href="<?php echo PASTAADMIN;?>login/deslogar/desloga/10">
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
                                            $menu = array("Credor"      =>array("fa fa-truck","CadastroCredor","ListarCredor"),
                                                          "Renda"       =>array("fa fa-money","CadastroRenda","ListarRenda"),
                                                          "Pagamento"   =>array("fa-credit-card fa","CadastroPagamento","CadastroContasMensais","ListarPagamento"),
                                                          "Recebimento" =>array("fa fa-shopping-cart","CadastroRecebimento","CadastroRecebimentosMensais","ListarRecebimento")
                                                          );
                                            GeraMenu($menu);
                                        ?>
					<!-- end: MAIN NAVIGATION MENU -->
				</div>
				<!-- end: SIDEBAR -->
			</div>
			<!-- start: PAGE -->
			
                                 <?php  
                                    $url = new UrlAmigavel();
                                    $url->pegaControllerAction();
                                 ?>
			<!-- end: PAGE -->
		</div>
		<!-- end: MAIN CONTAINER -->
		<!-- start: FOOTER -->
		<div class="footer clearfix">
			<div class="footer-inner">
				2014 &copy; Leo Bessa Desenvolvimento.
			</div>
			<div class="footer-items">
				<span class="go-top"><i class="clip-chevron-up"></i></span>
			</div>
		</div>
		<!-- end: FOOTER -->
		<?php Modal::aviso("alerta") ;?>
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
                    <script src="<?php echo PASTAADMIN;?>plugins/respond.min.js"></script>
                    <script src="<?php echo PASTAADMIN;?>plugins/excanvas.min.js"></script>
                    <script type="text/javascript" src="<?php echo INCLUDES;?>jquery-1.10.2.js"></script>
		<![endif]-->                
		<!--[if gte IE 9]><!-->
		<script src="<?php echo INCLUDES;?>jquery-2.0.3.js"></script>
		<!--<![endif]-->
                <!--<script src="<?php echo PASTAADMIN;?>plugins/jquery-ui/jquery-ui-1.10.2.custom.min.js"></script>-->
                <script src="<?php echo INCLUDES;?>jquery-ui.js"></script>
                <script type="text/javascript" src="<?php echo INCLUDES;?>gera-grafico.js"></script>
                <script type="text/javascript" src="<?php echo INCLUDES;?>jquery.mask.js"></script>
                <script type="text/javascript" src="<?php echo INCLUDES;?>jquery.maskMoney.js"></script>
                <?php echo '<script type="text/javascript">
                        function servidor_inicial(){    
                                var home = "'.HOME.'";
                                return home;
                        }
                        function inatividade(){    
                                var inativo = "'.INATIVO.'";
                                return inativo;
                        }
                        function pasta_upload(){    
                                var pasta = "'.PASTAUPLOADS.'";
                                return pasta;
                        }
                </script>'; ?>
                <script type="text/javascript" src="<?php echo INCLUDES;?>validacoes.js"></script>               
                
		<script src="<?php echo PASTAADMIN;?>plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/blockUI/jquery.blockUI.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<!--<script src="<?php //echo PASTAADMIN;?>plugins/less/less-1.5.0.min.js"></script>-->
		<script src="<?php echo PASTAADMIN;?>plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="<?php echo PASTAADMIN;?>js/main.js"></script>
		<script src="<?php echo PASTAADMIN;?>js/ui-animation.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo PASTAADMIN;?>plugins/flot/jquery.flot.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/flot/jquery.flot.pie.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/flot/jquery.flot.resize.min.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/jquery.sparkline/jquery.sparkline.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/jquery-easy-pie-chart/jquery.easy-pie-chart.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/fullcalendar/fullcalendar/fullcalendar.js"></script>
		<script src="<?php echo PASTAADMIN;?>js/index.js"></script>
		
                <script src="<?php echo PASTAADMIN;?>plugins/select2/select2.min.js"></script>                 
		<script src="<?php echo PASTAADMIN;?>plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>                
		<script src="<?php echo PASTAADMIN;?>plugins/bootstrap-switch/static/js/bootstrap-switch.min.js"></script>
                <script src="<?php echo PASTAADMIN;?>plugins/DataTables/media/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/DataTables/media/js/DT_bootstrap.js"></script>
                <script src="<?php echo PASTAADMIN;?>js/table-data.js"></script>
                <script src="<?php echo PASTAADMIN;?>js/Funcoes.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
                                Funcoes.init();
				Main.init();				
                                TableData.init();
                                FormWizard.init();
                                Index.init();                                
			});
		</script>                 
	</body>
	<!-- end: BODY -->
</html>