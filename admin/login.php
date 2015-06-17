 <?php
    require('../library/Config.inc.php');
?>
<!DOCTYPE html>
<!-- Template Name: Clip-One - Responsive Admin Template build with Twitter Bootstrap 3.x Version: 1.4 Author: ClipTheme -->
<!--[if IE 8]><html class="ie8 no-js" lang="en"><![endif]-->
<!--[if IE 9]><html class="ie9 no-js" lang="en"><![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title><?php echo DESC;?></title>
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
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>css/main.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>css/main-responsive.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/iCheck/skins/all.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/bootstrap-colorpalette/css/bootstrap-colorpalette.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/perfect-scrollbar/src/perfect-scrollbar.css">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>css/theme_light.css" type="text/css" id="skin_color">
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>css/print.css" type="text/css" media="print"/>
		<!--[if IE 7]>
		<link rel="stylesheet" href="<?php echo PASTAADMIN;?>plugins/font-awesome/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- end: MAIN CSS -->
		<!-- start: CSS REQUIRED FOR THIS PAGE ONLY -->
		<!-- end: CSS REQUIRED FOR THIS PAGE ONLY -->
	</head>
	<!-- end: HEAD -->
	<!-- start: BODY -->
	<body class="login example1">
             <?php
        $class   = "";
        $msg     = "";
        $visivel = "";
        $cor     = "";
        $icon    = "";
        if(isset($_GET['o']) && $_GET['o'] != ""):
            $class = $_GET['o'];
            if($class == "info2"):
               $msg = "<big><b>INFORMAÇÃO</b></big></br></br>Por Favor, Preencha o Usuário e senha!";
               $class = "alert-info";
               $icon = "clip-info-2";
               $cor = "btn-info";
            elseif($class == "erro2"):
               $msg = "<big><b>PERMIÇÃO NEGADA</b></big></br></br>Acesso Restrito, Você não tem permição para acessar!";
               $class = "alert-danger";
               $icon = "clip-user-block";
               $cor = "btn-orange";
            elseif($class == "alerta2"):
               $msg = "<big><b>ERRO DE ACESSO</b></big></br></br>Usuário ou senha Inválido!";
               $class = "alert-warning";
               $icon = "fa fa-warning";
               $cor = "btn-yellow";
            elseif($class == "sucesso2"):
               $msg = "<big><b>SUCESSO</b></big></br></br>Usuário deslogado com sucesso!";
               $class = "alert-success";
               $icon = "clip-user-block";
               $cor = "btn-success btn-squared";
            elseif($class == "deslogado"):
               $msg   = "<big><b>INFORMAÇÃO</b></big></br></br>Sua Sessão foi Expirada!";
               $class = "alert-info";
               $icon = "clip-info-2";
               $cor = "btn-info";
            else:
                $msg = "Erro desconhecido!";
            endif;
        else:
            $visivel = "no-display";
        endif;
       $class = " ".$class;
    ?>
		<div class="main-login col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
			<div class="logo"><?php echo DESC;?>
			</div>
			<!-- start: LOGIN BOX -->
			<div class="box-login">
				<h3>Entre com sua Conta</h3>
				<p>
					Por Favor! Entre com login e senha.
				</p>
                                <form class="form-login" action="../admin/Index/Logar" method="post">
					<div class="errorHandler alert <?php echo $class; ?> <?php echo $visivel; ?>">
						<a class="btn <?php echo $cor; ?>" href="#"><i class="<?php echo $icon; ?>"></i></a> <?php echo $msg; ?>
					</div>
					<fieldset>
						<div class="form-group">
							<span class="input-icon">
								<input type="text" class="form-control" name="user" id="user" placeholder="Usuário">
								<i class="fa fa-user"></i> </span>
						</div>
						<div class="form-group form-actions">
							<span class="input-icon">
								<input type="password" class="form-control password" name="senha" id="senha" placeholder="Senha">
								<i class="fa fa-lock"></i>								
						</div>
						<div class="form-actions">
                                                        <input type="hidden" name="logar_no_sigeplan" id="logar_no_sigeplan" value="logar"/>
							<label for="remember" class="checkbox-inline">
								<input type="checkbox" class="grey remember" id="remember" name="remember">
								Lembrar de Mim
							</label>
							<button type="submit" class="btn btn-bricky pull-right">
								LOGAR <i class="fa fa-arrow-circle-right"></i>
							</button>
						</div>
						<div class="new-account">
							Você não tem Conta?
							<a href="?box=register" class="register">
								Criar Conta
							</a>
						</div>
					</fieldset>
				</form>
			</div>
			<div class="copyright">
				2014 &copy; LEO BESSA
			</div>
			<!-- end: COPYRIGHT -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<!--[if lt IE 9]>
		<script src="<?php echo PASTAADMIN;?>plugins/respond.min.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/excanvas.min.js"></script>
		<script type="text/javascript" src="<?php echo INCLUDES;?>jquery-1.10.2.js"></script>
		<![endif]-->
		<!--[if gte IE 9]><!-->
		<script src="<?php echo INCLUDES;?>jquery-2.0.3.js"></script>
		<!--<![endif]-->
		<script src="<?php echo INCLUDES;?>jquery-ui.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/blockUI/jquery.blockUI.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/iCheck/jquery.icheck.min.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/perfect-scrollbar/src/jquery.mousewheel.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/perfect-scrollbar/src/perfect-scrollbar.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/less/less-1.5.0.min.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/jquery-cookie/jquery.cookie.js"></script>
		<script src="<?php echo PASTAADMIN;?>plugins/bootstrap-colorpalette/js/bootstrap-colorpalette.js"></script>
		<script src="<?php echo PASTAADMIN;?>js/main.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="<?php echo PASTAADMIN;?>plugins/jquery-validation/dist/jquery.validate.min.js"></script>
		<script src="<?php echo PASTAADMIN;?>js/login.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script>
			jQuery(document).ready(function() {
				Main.init();
				Login.init();
			});
		</script>
	</body>
	<!-- end: BODY -->
</html>