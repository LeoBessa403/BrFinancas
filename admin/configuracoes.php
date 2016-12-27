<?php

function servidor_inicial()
{

    $servidor = "local";
//    $servidor = "web";

    if ($servidor == "web") {
        $config = array('HOME' => 'http://gejdombosco.com.br/', 'HOST' => 'cpmy0025.servidorwebfacil.com', 'USER' => 'gejdombo_user', 'PASS' => 'Admin101$', 'DBSA' => 'gejdombo_db');
    } else {
        $config = array('HOME' => 'http://localhost/gej/', 'HOST' => 'localhost', 'USER' => 'root', 'PASS' => '', 'DBSA' => 'gej_bd');
    }

    define('HOME', $config['HOME']);
    define('HOST', $config['HOST']);
    define('USER', $config['USER']);
    define('PASS', $config['PASS']);
    define('DBSA', $config['DBSA']);


    //////////////////////////////////////////////
    // ******* CONFIGURAÇÕES DO SITE ********** //
    //////////////////////////////////////////////

    // Título do Site
    define('DESC', 'WEB GEJ');
    // Tabela de pesquisa de usuário para validação
    define('TABLE_USER', 'tb_usuario');
    // Campo de login na Tabela de pesquisa de usuário para validação
    define('CAMPO_USER', 'ds_login');
    // Campo da senha na Tabela de pesquisa de usuário para validação
    define('CAMPO_PASS', 'ds_code');
    // Campo do ID (Chave Primaria) na Tabela de pesquisa de usuário para validação
    define('CAMPO_ID', 'co_usuario');
    // Campo do Perfil na Tabela de pesquisa de usuário para validação dos perfis 
    // (Ex.: cadastrante, administrador, pesquisador) Sepmre separados por (, )
    define('CAMPO_PERFIL', 'ds_perfil');
    // Atribui o nome da Sessão do usuario Logado no sitema
    define('SESSION_USER', 'user_gej');
    // Tempo de Inativadade Máximo em Minutos, aceito para deslogar do Sistema.
    define('INATIVO', 20);
    // A frequencia em dias para realizar o BACKUP NO BANCO DE DADOS
    define('BACKUP', 15);
    // TAMANHO PADRÃO DO WIDTH DAS IAMGENS A SEREM CARREGADAS
    define('TAMANHO', 600);
    // PASTA DE ARMAZENAMENTO DE UPLOADS
    define('PASTAUPLOADS', 'uploads/');
    // TABELA PARA ARMAZENAR OS DADOS PARA AUDITORIA
    define('TABELA_AUDITORIA', 'tb_auditoria');
    //define('TABELA_AUDITORIA', NULL);

    //////////////////////////////////////////////
    // ******* CONFIGURAÇÕES DE EMAIL ********** //
    //////////////////////////////////////////////

    define('HOST_EMAIL', 'mail.gejdombosco.net');
    define('PORTA_EMAIL', 587);
    define('USER_EMAIL', 'contato@gejdombosco.net');
    define('PASS_EMAIL', 'contato123*');

    //////////////////////////////////////////////
    // *********** GOOGLE ANALITCS  *********** //
    //////////////////////////////////////////////

    define('ID_ANALITCS', 'UA-71215942-1');


    //////////////////////////////////////////////
    // ***** SERVIDOR DE LOCALIZAÇÃO DE IP **** //
    //////////////////////////////////////////////

    define('IP_LOCALIZACAO', 'http://ip-api.com/php/');


}


