<?php
/* 
 * Controller résponsavel para receber e passar dados para controller responsável.
 */
include "../../library/Config.inc.php";

if(isset($_GET['valida'])){    
    
	switch($_GET['valida']){
    
////////////////////////////////////////////////////////////////////////
/////////////////// PARTICULARIDADES DO SISTEMA ////////////////////////
//////////////////////////////////////////////////////////////////////// 
  
        case 'pesquisa_tarefa': 
            $id =  $_GET['co_tarefa'];    
            $agenda = AgendaModel::PesquisaUmaAgenda($id);
            $perfis = AgendaModel::PesquisaPerfilAgenda($id);
            $agenda = $agenda[0];      
            $agenda['perfis'] = $perfis;
            $dt_ini = explode(" ", $agenda['dt_inicio']);
            $agenda['dt_inicio'] = implode("/",array_reverse(explode("-", $dt_ini[0]))) ;
            $dt_ini = explode(":", $dt_ini[1]);
            $agenda['hr_inicio'] = $dt_ini[0].":".$dt_ini[1];
            
            if($agenda['dt_fim']):
                $dt_fim = explode(" ", $agenda['dt_fim']);
                $agenda['dt_fim'] = implode("/",array_reverse(explode("-", $dt_fim[0]))) ;
                $dt_fim = explode(":", $dt_fim[1]);
                $agenda['hr_fim'] = $dt_fim[0].":".$dt_fim[1];
            else:
                $agenda['dt_fim'] = null;
                $agenda['hr_fim'] = null;
            endif;
            
            echo json_encode($agenda);
        break;
        
        case 'capa_livro': 
            $id =  $_GET['id'];    
            $livro = BibliotecaModel::PesquisaUmLivro($id);
            $capa  = $livro[0];      
            echo json_encode($capa);
        break;
    
        case 'pesquisa_livro': 
            $id =  $_GET['id'];    
            $livro = BibliotecaModel::PesquisaUmLivro($id);
            echo $livro[0]['no_titulo'];
        break;
    
        case 'reservar': 
            $id =  $_GET['id'];    
            $co_codigo_livro = BibliotecaModel::PesquisaLivroDisponivel($id);
            $dados['co_codigo_livro'] = $co_codigo_livro[0]['co_codigo_livro'];
            $dados['dt_reserva'] = Valida::DataAtualBanco();
            $dados['st_situacao'] = "R";
            $us = $_SESSION[SESSION_USER];                                                                    
            $user = $us->getUser();
            $dados['co_usuario'] = $user[md5('co_usuario')];
            echo BibliotecaModel::CadastraResevaLivro($dados);
        break;
    
    
    
            
}} // FIM SWITCH