<?php

/**
 * Check.class [ HELPER ]
 * Classe responável por manipular e validade dados do sistema!
 * 
 * @copyright (c) 2014, Leo Bessa
 */
class FuncoesSistema {

    public static function retornoCheckbox($check){
        if($check):
            return "S";
        else:
            return "N";
        endif;
    }
    
    public static function OperacaoAuditoria($operacao){
        
        switch ($operacao) {
            case "I":
                $op = '<span class="label label-success">INSERIU</span>';
                break;
            case "D":
                $op = '<span class="label label-danger">DELETOU</span>';
                break;
            case "U":
                $op = '<span class="label label-warning">ATUALIZOU</span>';
                break;
        }
        
        return $op;
    }
    
    public static function GeraCodigo(){
        
        $codigo = '';
        for($p=0;$p<2;$p++)
        {
            for($m=0;$m<3;$m++)
            {
                    $numero = rand(1,26);
                    switch($numero)
                    {
                            case '1':  $letra = 'A';break; 
                            case '2':  $letra = 'B';break;
                            case '3':  $letra = 'C';break; 
                            case '4':  $letra = 'D';break;
                            case '5':  $letra = 'E';break; 
                            case '6':  $letra = 'F';break;
                            case '7':  $letra = 'G';break;
                            case '8':  $letra = 'H';break; 
                            case '9':  $letra = 'K';break;
                            case '10': $letra = 'I';break; 
                            case '11': $letra = 'J';break;
                            case '12': $letra = 'L';break; 
                            case '13': $letra = 'M';break;
                            case '14': $letra = 'N';break;
                            case '15': $letra = 'O';break; 
                            case '16': $letra = 'P';break;
                            case '17': $letra = 'Q';break; 
                            case '18': $letra = 'R';break;
                            case '19': $letra = 'S';break; 
                            case '20': $letra = 'T';break;
                            case '21': $letra = 'U';break;
                            case '22': $letra = 'V';break; 
                            case '23': $letra = 'Y';break;
                            case '24': $letra = 'X';break; 
                            case '25': $letra = 'W';break;
                            case '26': $letra = 'Z';break; 
                    }
                    $codigo .= $letra;
            }

                    $numero = rand(0,9);
                    $codigo .= $numero;
        }
        
        return $codigo;
    }
    
    public static function ValidaAgenda(array $res){
        
        $us = $_SESSION[SESSION_USER];                                                                    
        $user = $us->getUser();
        $meusPerfis = explode(",", $user[md5(CAMPO_PERFIL)]);
        
        $label_options = array();
        foreach ($res as $value) {
            $perfil = array();
            foreach ($value["co_perfil"] as $val) {
                array_push($perfil, $val['co_perfil']);  
            }
            
            $value["co_perfil"] = $perfil;
            
            
                if(in_array(1, $meusPerfis)):
                    $label_options[] = $value;
                elseif(in_array(2, $meusPerfis)):
                    $label_options[] = $value;
                elseif(in_array(3, $meusPerfis) && in_array(3, $value["co_perfil"])):
                    $label_options[] = $value;
                elseif(in_array(4, $meusPerfis) && $value["co_evento"] == 3): // Evento que do Perfil Lider de Evento é Responsável
                    $label_options[] = $value;
                elseif(in_array(5, $meusPerfis) && array_intersect($value["co_perfil"], array(5,6))):
                    $label_options[] = $value;
                elseif(in_array(6, $meusPerfis) && in_array(6, $value["co_perfil"])):
                    $label_options[] = $value;
                elseif(in_array(7, $meusPerfis) && array_intersect($value["co_perfil"], array(7,8))):
                    $label_options[] = $value;
                elseif(in_array(8, $meusPerfis) && in_array(8, $value["co_perfil"])):
                    $label_options[] = $value;
                elseif(in_array(9, $meusPerfis) && array_intersect($value["co_perfil"], array(9,10))):
                    $label_options[] = $value;
                elseif(in_array(10, $meusPerfis) && in_array(10, $value["co_perfil"])):
                    $label_options[] = $value;
                elseif(in_array(11, $meusPerfis) && array_intersect($value["co_perfil"], array(11,12))):
                    $label_options[] = $value;
                elseif(in_array(12, $meusPerfis) && in_array(12, $value["co_perfil"])):
                    $label_options[] = $value;
                elseif(in_array(13, $meusPerfis) && array_intersect($value["co_perfil"], array(13,14))):
                    $label_options[] = $value;
                elseif(in_array(14, $meusPerfis) && in_array(14, $value["co_perfil"])):
                    $label_options[] = $value;
                elseif(in_array(15, $meusPerfis) && array_intersect($value["co_perfil"], array(15,16))):
                    $label_options[] = $value;
                elseif(in_array(16, $meusPerfis) && in_array(16, $value["co_perfil"])):
                    $label_options[] = $value;
                elseif(in_array(17, $meusPerfis) && array_intersect($value["co_perfil"], array(17,18))):
                    $label_options[] = $value;
                elseif(in_array(18, $meusPerfis) && in_array(18, $value["co_perfil"])):
                    $label_options[] = $value;
                elseif(in_array(19, $meusPerfis) && in_array(19, $value["co_perfil"])):
                    $label_options[] = $value;
                endif;
                
        }    
        
        return $label_options;
    }
    
    public static function ValidaTarefa(array $res){
        
        $us = $_SESSION[SESSION_USER];                                                                    
        $user = $us->getUser();
        $meusPerfis = explode(",", $user[md5(CAMPO_PERFIL)]);
        
        $label_options = array();
        foreach ($res as $value) {
                if(in_array(1, $meusPerfis)):
                    $label_options[] = $value;
                elseif(in_array(2, $meusPerfis)):
                    $label_options[] = $value;
                elseif(in_array(3, $meusPerfis) && $value["co_perfil"] == 3):
                    $label_options[] = $value;
                elseif(in_array(4, $meusPerfis) && $value["co_evento"] == 3): // Evento que do Perfil Lider de Evento é Responsável
                    $label_options[] = $value;
                elseif(in_array(5, $meusPerfis) && in_array($value["co_perfil"], array(5,6))):
                    $label_options[] = $value;
                elseif(in_array(6, $meusPerfis) && $value["co_perfil"] == 6):
                    $label_options[] = $value;
                elseif(in_array(7, $meusPerfis) && in_array($value["co_perfil"], array(7,8))):
                    $label_options[] = $value;
                elseif(in_array(8, $meusPerfis) && $value["co_perfil"] == 8):
                    $label_options[] = $value;
                elseif(in_array(9, $meusPerfis) && in_array($value["co_perfil"], array(9,10))):
                    $label_options[] = $value;
                elseif(in_array(10, $meusPerfis) && $value["co_perfil"] == 10):
                    $label_options[] = $value;
                elseif(in_array(11, $meusPerfis) && in_array($value["co_perfil"], array(11,12))):
                    $label_options[] = $value;
                elseif(in_array(12, $meusPerfis) && $value["co_perfil"] == 12):
                    $label_options[] = $value;
                elseif(in_array(13, $meusPerfis) && in_array($value["co_perfil"], array(13,14))):
                    $label_options[] = $value;
                elseif(in_array(14, $meusPerfis) && $value["co_perfil"] == 14):
                    $label_options[] = $value;
                elseif(in_array(15, $meusPerfis) && in_array($value["co_perfil"], array(15,16))):
                    $label_options[] = $value;
                elseif(in_array(16, $meusPerfis) && $value["co_perfil"] == 16):
                    $label_options[] = $value;
                elseif(in_array(17, $meusPerfis) && in_array($value["co_perfil"], array(17,18))):
                    $label_options[] = $value;
                elseif(in_array(18, $meusPerfis) && $value["co_perfil"] == 18):
                    $label_options[] = $value;
                elseif(in_array(19, $meusPerfis) && $value["co_perfil"] == 19):
                    $label_options[] = $value;
                endif;
                
        }    
        
        return $label_options;
    }
    
    public static function ValidaPerfilCadastro(array $res){
        
        $us = $_SESSION[SESSION_USER];                                                                    
        $user = $us->getUser();
        $meusPerfis = explode(",", $user[md5(CAMPO_PERFIL)]);
        
         $label_options[''] = "Selecione um Item";
        foreach ($res as $key => $value) {
                if(in_array(1, $meusPerfis)):
                    $label_options[$key] = $value;
                elseif(in_array(2, $meusPerfis)):
                    $label_options[$key] = $value;
                elseif(in_array(4, $meusPerfis) && !in_array($key, array(1,2))): // Evento que do Perfil Lider de Evento é Responsável
                    $label_options[$key] = $value;
                elseif(in_array(5, $meusPerfis) && in_array($key, array(5,6))): 
                    $label_options[$key] = $value;
                elseif(in_array(7, $meusPerfis) && in_array($key, array(7,8))): 
                    $label_options[$key] = $value;
                elseif(in_array(9, $meusPerfis) && in_array($key, array(9,10))): 
                    $label_options[$key] = $value;
                elseif(in_array(11, $meusPerfis) && in_array($key, array(11,12))): 
                    $label_options[$key] = $value;
                elseif(in_array(13, $meusPerfis) && in_array($key, array(13,14))): 
                    $label_options[$key] = $value;
                elseif(in_array(15, $meusPerfis) && in_array($key, array(15,16))): 
                    $label_options[$key] = $value;
                elseif(in_array(17, $meusPerfis) && in_array($key, array(17,18))): 
                    $label_options[$key] = $value;
                endif;
        }    
        return $label_options;
    }
    
    public static function StatusTarefa($status){
        
        switch ($status) {
            case "C":
                $st = '<i class="fa fa-check-circle alert-success"></i>';
                break;
            case "N":
                $st = '<i class="fa fa-exclamation-triangle alert-warning"></i>';
                break;
            case "A":
                $st = '<i class="fa fa-info-circle alert-info"></i>';
                break;
            case "I":
                $st = '<i class="fa fa-times-circle alert-danger"></i>';
                break;
        }
        
        return $st;
    }
    
    public static function StatusTarefaView($status){
        
        switch ($status) {
            case "C":
                $st = '<span class="label label-success"><i class="fa fa-check-circle"></i> CONCLUIDA</span>';
                break;
            case "N":
                $st = '<span class="label label-warning"><i class="fa fa-exclamation-triangle"></i> NÃO INICIADA</span>';
                break;
            case "A":
                $st = '<span class="label label-info"><i class="fa fa-info-circle"></i> EM ANDAMENTO</span>';
                break;
            case "I":
                $st = '<span class="label label-danger"><i class="fa fa-times-circle"></i> INATIVA</span>';
                break;
        }
        
        return $st;
    }
    
    public static function StatusPrioridade($status){
        
        switch ($status) {
            case 1:
                $st = '<span class="label label-danger">URGENTE</span>';
                break;
            case 2:
                $st = '<span class="label label-warning">ALTA</span>';
                break;
            case 3:
                $st = '<span class="label label-info">MÉDIA</span>';
                break;
            case 4:
                $st = '<span class="label label-success">BAIXA</span>';
                break;
        }
        
        return $st;
    }
    
    public static function SituacaoUsuario($st){
        
        switch ($st) {
            case "A":
                $op = '<span class="label label-success">ATIVO</span>';
                break;
            case "I":
                $op = '<span class="label label-danger">INATIVO</span>';
                break;
        }
        
        return $op;
    }
    
    public static function SituacaoUsuarioLabel($st){
        
        switch ($st) {
            case "A":
                $op = 'ATIVO';
                break;
            case "I":
                $op = 'INATIVO';
                break;
        }

        return $op;
    }
    
    public static function SituacaoSimNao($st){
        if(!$st):
            $st = "N";
        endif;
        switch ($st) {
            case "S":
                $op = '<span class="label label-success">SIM</span>';
                break;
            case "N":
                $op = '<span class="label label-danger">NÃO</span>';
                break;
        }
        
        return $op;
    }
    
    public static function TamanhoCamisa($tm){
        
        switch ($tm) {
            case 1:
                $op = 'BL PP';
                break;
            case 2:
                $op = 'BL P';
                break;
            case 3:
                $op = 'BL M';
                break;
            case 4:
                $op = 'BL G';
                break;
            case 5:
                $op = 'BL GG';
                break;
            case 6:
                $op = 'P';
                break;
            case 7:
                $op = 'M';
                break;
            case 8:
                $op = 'G';
                break;
            case 9:
                $op = 'GG';
                break;
        }
        
        return $op;
    }
        
 }