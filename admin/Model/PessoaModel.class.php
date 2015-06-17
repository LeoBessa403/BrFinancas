<?php

class PessoaModel{
    
    const tabela = "tb_pessoa";
    const campos = "nome_razao,cpf_cnpj,tipo_pessoa";
    const chave_primaria = "id_pessoa";
        
    public static function CadastraPessoa(array $dados){
        $cadastro = new Cadastra();
        $cadastro->Cadastrar(self::tabela, $dados);
        return $cadastro->getUltimoIdInserido();
    }
    
    public static function AtualizaPessoa(array $dados,$id){
        $atualiza = new Atualiza();
        $atualiza->Atualizar(self::tabela, $dados, "where ".self::chave_primaria." = :id", "id={$id}");
        return $atualiza->getResult();
    }
    
}