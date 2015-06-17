<?php

class PagamentoModel{
      
    const tabela = "tb_pagamento";
    const campos = "id_negociacao,valor_pago,tipo_pagamento,valor_total,observacao,situacao,numero_parcelas";
    const chave_primaria = "id_pagamento";
    
    public static function CadastraPagamento(array $dados){
        $cadastro = new Cadastra();
        $cadastro->Cadastrar(self::tabela, $dados);
        return $cadastro->getUltimoIdInserido();
    }
    
    public static function AtualizaPagamento(array $dados,$id){
        $atualiza = new Atualiza();
        $atualiza->Atualizar(self::tabela, $dados, "where ".self::chave_primaria." = :id", "id={$id}");
        return $atualiza->getResult();
    }    
    
    
    public static function PesquisaPagamentoAtivo($id){
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar(self::tabela,"where id_negociacao = :id", "id={$id}");
        $result   = $pesquisa->getResult();
        if($result):
            return $result[0];
        else:
            return $result;
        endif;
        
    }
    
     public static function DeletaPagamento($id_negociacao){ 
        $tabela =   "tb_negociacao neg".                 
                   " inner join tb_pagamento pag".
                   " on neg.id_negociacao = pag.id_negociacao";
        
        $pesquisa = new Pesquisa();
        $pesquisa->Pesquisar($tabela,"where neg.id_negociacao = :id_neg", "id_neg={$id_negociacao}","pag.id_pagamento");
        $result   = $pesquisa->getResult();
        $id_pagamento = $result[0]['id_pagamento'];
         
        $deletados = ParcelamentoModel::deletaParcelamentoIdPagamento($id_pagamento);
        if($deletados):         
            $deleta = new Deleta();
            $deleta->Deletar(self::tabela, "where id_pagamento = :id_pagamento", "id_pagamento={$id_pagamento}");
            $deletadoPagamento = $deleta->getResult();
            if($deletadoPagamento):         
                return NegociacaoModel::DeletaNegociacao($id_negociacao);
            else:
                return "";
            endif;
        else:
            return "";
        endif;
    }
    
    
}