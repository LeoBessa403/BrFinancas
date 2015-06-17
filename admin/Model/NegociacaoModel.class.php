<?php

class NegociacaoModel{
      
    const tabela = "tb_negociacao";
    const campos = "id_entidade,cadastro,tipo_negociacao,observacao";
    const chave_primaria = "id_negociacao";
    
    public static function CadastraPagamento(array $dados){
        $cadastro = new Cadastra();
        $cadastro->Cadastrar(self::tabela, $dados);
        return $cadastro->getUltimoIdInserido();
    }
    
    public static function CadastraRenda(array $dados){
        $cadastro = new Cadastra();
        $cadastro->Cadastrar(self::tabela, $dados);
        return $cadastro->getUltimoIdInserido();
    }
    
    public static function AtualizaNegociacao(array $dados,$id){
        $atualiza = new Atualiza();
        $atualiza->Atualizar(self::tabela, $dados, "where ".self::chave_primaria." = :id", "id={$id}");
        return $atualiza->getResult();
    }    
    
    public static function PesquisaNegociacoes($tipo){
        
        $tabela = self::tabela." neg".
                   " inner join tb_pessoa pes".
                   " on neg.id_entidade = pes.id_entidade".
                   " inner join tb_pagamento pag".
                   " on neg.id_negociacao = pag.id_negociacao";
        
        $campos = "pag.numero_parcelas, pag.situacao, neg.id_negociacao, neg.cadastro, pag.tipo_pagamento, pag.valor_total, pes.nome_razao";
        
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar($tabela,"where neg.tipo_negociacao = '$tipo'",null,$campos);
        return $pesquisa->getResult();
        
    }
    
     public static function PesquisaParcelasListar($id_neg){
        
         $tabela = " tb_pagamento pag".                 
                   " inner join tb_parcelamento parc".
                   " on parc.id_pagamento = pag.id_pagamento";
        
        $campos = "pag.situacao, parc.vencimento, parc.vencimento_pago, parc.parcela, parc.valor_parcela_pago";
        
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar($tabela,"where pag.id_negociacao = :id_neg","id_neg={$id_neg}",$campos);
        return $pesquisa->getResult();
        
    }
    
    public static function PesquisaUmaNegociacao($id_neg,$tipo){
        
         $tabela = self::tabela." neg".
                   " inner join tb_pessoa pes".
                   " on neg.id_entidade = pes.id_entidade".
                   " inner join tb_pagamento pag".
                   " on neg.id_negociacao = pag.id_negociacao";
        
        $campos = "pag.id_pagamento, pag.numero_parcelas, pag.situacao, neg.id_negociacao, neg.cadastro, pag.tipo_pagamento, pag.valor_total, pes.nome_razao, neg.observacao, pes.id_entidade";
        
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar($tabela,"where neg.tipo_negociacao = '$tipo' and neg.id_negociacao = :id","id={$id_neg}",$campos);
        return $pesquisa->getResult();
        
    }
    
    public static function DeletaNegociacao($id_negociacao){        
        $deleta = new Deleta();
        $deleta->Deletar(self::tabela, "where id_negociacao = :id_negociacao", "id_negociacao={$id_negociacao}");
        return $deleta->getResult();        
    }
    
     public static function PesquisaNegociacoesEmAberto(){
       $tabela =   "tb_negociacao neg".
                   " inner join tb_pessoa pes".
                   " on neg.id_entidade = pes.id_entidade".
                   " inner join tb_pagamento pag".
                   " on neg.id_negociacao = pag.id_negociacao".
                   " inner join tb_parcelamento parc".
                   " on parc.id_pagamento = pag.id_pagamento";
        
        $campos = "neg.tipo_negociacao, pag.tipo_pagamento, parc.valor_parcela, parc.vencimento, pes.nome_razao, pag.id_negociacao";
        
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar($tabela,"where parc.vencimento <= '".Valida::DataAtual("Y/m/d")."' AND parc.vencimento_pago is NULL order by parc.vencimento ASC",null,$campos);
        return $pesquisa->getResult();
        
    }
    
    public static function PesquisaNegociacoesProximas(){
       $tabela =   "tb_negociacao neg".
                   " inner join tb_pessoa pes".
                   " on neg.id_entidade = pes.id_entidade".
                   " inner join tb_pagamento pag".
                   " on neg.id_negociacao = pag.id_negociacao".
                   " inner join tb_parcelamento parc".
                   " on parc.id_pagamento = pag.id_pagamento";
        
        $campos = "neg.tipo_negociacao, pag.tipo_pagamento, parc.valor_parcela, parc.vencimento, pes.nome_razao, pag.id_negociacao";
        
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar($tabela,"where parc.vencimento BETWEEN '".date("Y-m-d", strtotime("+1 days"))."' AND '".date("Y-m-d", strtotime("+16 days"))."' AND parc.vencimento_pago is NULL order by parc.vencimento ASC",null,$campos);
        return $pesquisa->getResult();
        
    }
    
    public static function PesquisaNegociacoesGastosRecebimentos($data_inicial,$data_final){
       $tabela =   "tb_negociacao neg".
                   " inner join tb_pessoa pes".
                   " on neg.id_entidade = pes.id_entidade".
                   " inner join tb_pagamento pag".
                   " on neg.id_negociacao = pag.id_negociacao".
                   " inner join tb_parcelamento parc".
                   " on parc.id_pagamento = pag.id_pagamento";
        
        $campos = "neg.tipo_negociacao, parc.valor_parcela, parc.vencimento, pag.id_negociacao, parc.valor_parcela_pago, parc.vencimento_pago";
        
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar($tabela,"where parc.vencimento BETWEEN '".$data_inicial."' AND '".$data_final."'",null,$campos);
        return $pesquisa->getResult();
        
    }
    
}