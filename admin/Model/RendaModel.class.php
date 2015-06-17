<?php

class RendaModel{    
      
    public static function PesquisaRenda(){
        $tabela = EntidadeModel::tabela." ent"
                . " inner join ".PessoaModel::tabela." pes"
                . " on pes.".EntidadeModel::chave_primaria." = ent.".EntidadeModel::chave_primaria
                . " inner join ".DadosModel::tabela." dad"
                . " on dad.".PessoaModel::chave_primaria." = pes.".PessoaModel::chave_primaria;
        
        $campos = "ent.id_entidade, pes.nome_razao, dad.tel1, dad.tel2, dad.site";
        
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar($tabela,"where ent.tipo_entidade = 'R'",null,$campos);
        return $pesquisa->getResult();
    }
    
    public static function PesquisaRendaSelect(){
        $tabela = EntidadeModel::tabela." ent"
                . " inner join ".PessoaModel::tabela." pes"
                . " on pes.".EntidadeModel::chave_primaria." = ent.".EntidadeModel::chave_primaria;
        
        $campos = "ent.id_entidade, pes.nome_razao";
        
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar($tabela,"where ent.tipo_entidade = 'R'",null,$campos);
        return $pesquisa->getResult();
    }
    
    public static function PesquisaUmRenda($id){
       $tabela = EntidadeModel::tabela." ent"
                . " inner join ".PessoaModel::tabela." pes"
                . " on pes.".EntidadeModel::chave_primaria." = ent.".EntidadeModel::chave_primaria
                . " inner join ".DadosModel::tabela." dad"
                . " on dad.".PessoaModel::chave_primaria." = pes.".PessoaModel::chave_primaria;
        
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar($tabela,"where ent.".EntidadeModel::chave_primaria." = :id","id={$id}");
        $result   = $pesquisa->getResult();
        return $result[0];
    }    
    
    public static function DeletaRenda($id){
        $tabela = EntidadeModel::tabela." ent"
                . " inner join ".PessoaModel::tabela." pes"
                . " on pes.".EntidadeModel::chave_primaria." = ent.".EntidadeModel::chave_primaria
                . " inner join ".DadosModel::tabela." dad"
                . " on dad.".PessoaModel::chave_primaria." = pes.".PessoaModel::chave_primaria;
        
        $campos = "ent.id_entidade, pes.id_pessoa, dad.id_dados";
        
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar($tabela,"where ent.".EntidadeModel::chave_primaria." = ".$id,null,$campos);
        $deleta = new Deleta();
        foreach ($pesquisa->getResult() as $res):
            $deleta->Deletar(DadosModel::tabela, "where ".DadosModel::chave_primaria." = :res", "res={$res['id_dados']}");
            $deleta->Deletar(PessoaModel::tabela, "where ".PessoaModel::chave_primaria." = :res", "res={$res['id_pessoa']}");
            $deleta->Deletar(EntidadeModel::tabela, "where ".EntidadeModel::chave_primaria." = :res", "res={$res['id_entidade']}");
            return $deleta->getResult();
        endforeach;
    }
    
}