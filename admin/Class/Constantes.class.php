<?php

/**
 * Check.class [ HELPER ]
 * Classe responável por manipular e validade dados do sistema!
 * 
 * @copyright (c) 2014, Leo Bessa
 */
class Constantes {
    
    const CATEGORIA_TABELA                  = "tb_categoria";
    const CATEGORIA_CAMPOS                  = "nome";
    const CATEGORIA_CHAVE_PRIMARIA          = "id_categoria";
    
    const PROCEDIMENTO_TABELA               = "tb_procedimento";
    const PROCEDIMENTO_CAMPOS               = "nome,carencia,periodicidade,codigo,id_categoria";
    const PROCEDIMENTO_CHAVE_PRIMARIA       = "id_procedimento";
    
    const CLIENTE_TABELA                    = "tb_cliente";
    const CLIENTE_CHAVE_PRIMARIA            = "id_cliente";
    
    const RACA_TABELA                       = "tb_raca";
    const RACA_CAMPOS                       = "raca";
    const RACA_CHAVE_PRIMARIA               = "id_raca";
    
    const CREDENCIADO_TABELA                = "tb_credenciado";
    const CREDENCIADO_CAMPOS                = "observacao,id_pessoa,id_regiao,horario_abertura,horario_fechamento,funcionamento_de,funcionamento_ate,id_veterinario";
    const CREDENCIADO_CHAVE_PRIMARIA        = "id_credenciado";
    
    const PROCEDIMENTO_CREDENCIADO_TABELA   = "tb_procedimento_credenciado";
    
    const PESSOA_TABELA                     = "tb_pessoa";
    const PESSOA_CAMPOS                     = "nome_razao,cpf_cnpj,tipo_pessoa,cliente,fantasia";
    const PESSOA_CHAVE_PRIMARIA             = "id_pessoa";
    
    const DADOS_TABELA                      = "tb_dados";
    const DADOS_CAMPOS                      = "tel1,tel2,tel3,email,site,tel0800,id_pessoa";
    const DADOS_CHAVE_PRIMARIA              = "id_dados";
    
    const ENDERECO_TABELA                   = "tb_endereco";
    const ENDERECO_CAMPOS                   = "endereco,complemento,cep,bairro,cidade,id_pessoa";
    const ENDERECO_CHAVE_PRIMARIA           = "id_endereco";
    
    const FOTO_TABELA                       = "tb_foto";
    const FOTO_CAMPOS                       = "id_cliente,caminho";
    const FOTO_CHAVE_PRIMARIA               = "id_foto";
    
    const PLANO_TABELA                      = "tb_plano";
    const PLANO_CHAVE_PRIMARIA              = "id_plano";
    
    CONST PROCEDIMENTO_PLANO_TABELA         = "tb_procedimento_plano";
    
    const REGIAO_TABELA                     = "tb_regiao";
    const REGIAO_CHAVE_PRIMARIA             = "id_regiao";
    
    const VETERINARIO_TABELA                = "tb_veterinario";
    const VETERINARIO_CAMPOS                = "observacao,id_pessoa,id_regiao,crmv";
    const VETERINARIO_CHAVE_PRIMARIA        = "id_veterinario";
    
}
