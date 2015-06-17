<?php

 require 'library/Config.inc.php'; 
               
               $url = (isset($_GET['url']) && $_GET['url'] != "" ? $_GET['url'] : "");
               $url = $url;
               $explode = explode( '/' ,$url );
               $session = new Session();              
              
               if(!$session->CheckSession(SESSION_USER)):
                    if(!isset($_POST['logar_no_sigeplan'])):
                        if(empty($explode[1])): 
                            Redireciona(ADMIN.LOGIN);
                            die;
                        else:
                            Redireciona(ADMIN.LOGIN."?o=erro2");
                            die;
                        endif;
                    else:
                        Index::logar();
                    endif;
               else: 
                    if(isset($explode[3]) && $explode[3] == "desloga"):
                        $session->FinalizaSession(SESSION_USER);
                        Redireciona(ADMIN.LOGIN."?o=sucesso2");      
                        die();
                    else:             
                        $us = $_SESSION[SESSION_USER];                                                                    
                        $user = $us->getUser();                        
                        
                        $ultimo_acesso = intval($user[md5("ultimo_acesso")] + (60 * INATIVO)  );
                        $agora         = strtotime(Valida::DataDB(Valida::DataAtual())); 
                        if($agora > $ultimo_acesso):
                            $session->FinalizaSession(SESSION_USER);
                            Redireciona(ADMIN.LOGIN."?o=deslogado");      
                            die();
                        else:
                            $us->setUserUltimoAcesso(strtotime(Valida::DataDB(Valida::DataAtual())));                            
                        endif;
                    endif;                 
               endif;

