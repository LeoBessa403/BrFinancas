<?php

/**
 * Check.class [ HELPER ]
 * Classe responável por manipular e validade dados do sistema!
 * 
 * @copyright (c) 2014, Leo Bessa
 */
class FuncoesSistema {

    private static $Data;
    private static $Format;    
    
    public static function tipoPagamento($tipo) {
        
        if($tipo == "CH"):
            return "Cheque";
        elseif($tipo == "DI"):
             return "Dinheiro";
        elseif($tipo == "BT"):
             return "Boleto";
        elseif($tipo == "CR"):
             return "Crédito";
        elseif($tipo == "DB"):
             return "Débito";
        endif;
    } 
    
        
 }