<?php

class EntidadeModel{
    
    const tabela = "tb_entidade";
    const campos = "observacao,tipo_entidade";
    const chave_primaria = "id_entidade";

    public static function CadastraEntidade(array $dados){
        $cadastro = new Cadastra();
        $cadastro->Cadastrar(self::tabela, $dados);
        return $cadastro->getUltimoIdInserido();
    }
    
    public static function AtualizaEntidade(array $dados,$id){
        $atualiza = new Atualiza();
        $atualiza->Atualizar(self::tabela, $dados, "where ".self::chave_primaria." = :id", "id={$id}");
        return $atualiza->getResult();
    }
    
    public static function PesquisaUmaEntidadeRazao($id){
       $tabela = self::tabela." ent"
                . " inner join ".PessoaModel::tabela." pes"
                . " on pes.".self::chave_primaria." = ent.".self::chave_primaria;
        
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar($tabela,"where ent.".self::chave_primaria." = :id","id={$id}","nome_razao");
        $result   = $pesquisa->getResult();
         if($result):
            return $result[0];
        else:
            return $result;
        endif;
    }
    
}