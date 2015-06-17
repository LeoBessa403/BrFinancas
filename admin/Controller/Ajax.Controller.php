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
  
/*****************************
Pesquisa Fotos do Cliente
*****************************/	
        case 'foto_cliente': 
            $id  = $_GET['id'];    
            $fotos = ClienteModel::PesquisaFotosUmCliente($id);
            echo json_encode($fotos);
        break;
    
    
    
    
            
}} // FIM SWITCH