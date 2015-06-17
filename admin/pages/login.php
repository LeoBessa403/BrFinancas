<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
     <?php
            require('../library/Config.inc.php');
        ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sem título</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
<script>
$(function(){
   $(".button1").click(function(){
       $(".alert2").fadeOut("fast");
       $(".logar-amigos").submit();
       $(".load").fadeIn("fast");
   }) 
})
</script>
<style>
	body {background-image:url(img/login/backloguin.jpg);}
	#login {background-image:url(img/login/loginprincipal.png); background-repeat:no-repeat; width:324px; height:338px; position:absolute; top:50%; left:50%; margin-left:-162px; margin-top:-220px;}
	form {width:240px; margin-left:40px; margin-top:130px; float:left;}
	input {width:195px; display:block; margin-left:5px; margin-top:9px; height:32px; color:#999; border:none; padding:2px 5px; font-size:18px; letter-spacing:1px;
        background: none; padding-left: 30px;}
        input:focus {box-shadow: 0px 0px 2px 2px #99ccff;}
	input[type="text"]{margin-bottom:37px;}
	.button {float:left; margin-right:45px; border: none;}
	.button1 {float:right;}
	.button, .button1 {margin-top:12px; cursor:pointer;}
        .msg-erro {display: none;}
        .alert2 {width: 222px; clear: both; float: left; padding: 10px 30px 10px 50px; margin: 2px 10px;  margin-left: -30px; -moz-border-radius: 5px; -webkit-border-radius: 5px; border-radius: 5px; background-repeat: no-repeat; background-position: left center;}
        .sucesso2 {background-color: #DFF0D8; color: green;  border: 1px solid green; background-image:url(../library/Helpers/includes/imagens/sucesso.png);}
        .erro2 {background-color: #F2DEDE; color: #900; border: 1px solid #900; background-image:url(../library/Helpers/includes/imagens/erro.png);}
        .alerta2 {background-color: #FCF8E3; color: #cc9900; border: 1px solid #cc9900; background-image:url(../library/Helpers/includes/imagens/alerta.png); }
        .info2 {background-color: #D9EDF7; color: #069; border: 1px solid #069; background-image:url(../library/Helpers/includes/imagens/info.png);}
</style>
</head>

<body>
    <?php
        $class = "";
        $msg = "";
        $visivel = "";
        if(isset($_GET['o']) && $_GET['o'] != ""):
            $class = $_GET['o'];
            if($class == "info2"):
               $msg = "Por Favor, Preencha o Usuário e senha!";
            elseif($class == "erro2"):
               $msg = "Acesso Restrito, Você não tem permição para acessar essa parte do Sistema!";
            elseif($class == "alerta2"):
               $msg = "Usuário ou senha Inválido!";
            elseif($class == "sucesso2"):
               $msg = "Usuário deslogado com sucesso!";
            else:
                $msg = "Erro desconhecido!";
            endif;
            $visivel = "alert2";
        else:
            $visivel = "msg-erro";
        endif;
       $class = " ".$class;
    ?>
    <div id="login">
        <form action="login/logar" method="post" class="logar-amigos">
            
            <input type="text" name="user" id="user" />
            <input type="password" name="senha" id="senha" />
          
            <img src="img/login/esqueceusenha.png" class="button" alt="Esqueci Minha Senha" title="Esqueci Minha Senha"/>
            <img src="img/login/limparcampo.png" class="button" alt="Limpar Campos" title="Limpar Campos"/>
            <img src="img/login/logar.png" class="button1" alt="Logar no Sistema" title="Logar no Sistema"/>
            <input type="hidden" name="logar_no_sigeplan" id="logar_no_sigeplan" value="logar"/>
            <img src="../library/Helpers/includes/imagens/load.gif" width="35" style="margin-left: 7px; display: none;" class="load"/>
            <div class="<?php echo $visivel; ?><?php echo $class; ?>"><?php echo $msg; ?></div>
        </form>
    </div>    
</body>
</html>
