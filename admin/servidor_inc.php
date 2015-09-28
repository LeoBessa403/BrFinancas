<?php

function servidor_inicial(){
    
//$servidor = "local";
$servidor = "web";

if($servidor == "web"){
    $config = array('HOME'=>'http://i9comsistemas.com.br/','HOST'=>'cpmy0025.servidorwebfacil.com','USER'=>'i9_leobessa','PASS'=>'Admin101$','DBSA'=>'i9_sistemas');
}else{
    $config = array('HOME'=>'http://localhost/BrFinancas/','HOST'=>'localhost','USER'=>'root','PASS'=>'','DBSA'=>'i9_sistemas');
}

define('HOME', $config['HOME']);
define('HOST', $config['HOST']);
define('USER', $config['USER']);
define('PASS', $config['PASS']);
define('DBSA', $config['DBSA']);


//////////////////////////////////////////////
// ******* CONFIGURAÇÔES DO SITE ********** //
//////////////////////////////////////////////

// T�tulo do Site
define('DESC', 'BR Finanças');
// Tabela de pesquisa de usuário para validação
define('TABLE_USER', 'tb_user');
// Campo de login na Tabela de pesquisa de usuário para validação
define('CAMPO_USER', 'login');
// Campo da senha na Tabela de pesquisa de usuário para validação
define('CAMPO_PASS', 'senha');
// Campo do ID (Chave Primaria) na Tabela de pesquisa de usuário para validação
define('CAMPO_ID', 'id');
// Campo do Perfil na Tabela de pesquisa de usuário para validação dos perfis 
// (Ex.: cadastrante, administrador, pesquisador) Sepmre separados por (, )
define('CAMPO_PERFIL', 'perfil');
// Atribui o nome da Sessão do usuario Logado no sitema
define('SESSION_USER', 'user_br_financas');
// Tempo de Inativadade Máximo em Minutos, aceito para deslogar do Sistema.
define('INATIVO', 20);
// TAMANHO PADR�O DO WIDTH DAS IAMGENS A SEREM CARREGADAS
define('TAMANHO', 600);
// PASTA DE ARMAZENAMENTO DE UPLOADS
define('PASTAUPLOADS', 'uploads/');
// TABELA PARA ARMAZENAR OS DADOS PARA AUDITORIA
define('TABELA_AUDITORIA', 'tb_auditoria');

}


