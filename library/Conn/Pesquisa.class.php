<?php

/**
 * <b>Read.class:</b>
 * Classe responsável por leituras genéticas no banco de dados!
 * 
 * @copyright (c) 2104, Leo Bessa
 */
class Pesquisa extends Conn {

    private $Select;
    private $Places;
    private $Result;
    private $Tabela;

    /** @var PDOStatement */
    private $Read;

    /** @var PDO */
    private $Conn;

    /**
     * <b>Pesquisa:</b> Executa uma leitura simplificada com Prepared Statments. Basta informar o nome da tabela,
     * os termos da seleção e uma analize em cadeia (Dados) para executar.
     * @param STRING $Tabela = Nome da tabela
     * @param STRING $Termos = WHERE | ORDER | LIMIT :limit | OFFSET :offset
     * @param STRING $Valores = variavel={$valor}&variavel2={$valor2}
     */
    public function Pesquisar($Tabela, $Termos = null, $Valores = null, $Campos = null) {
        $this->Tabela = $Tabela;
        if (!empty($Valores)):
            parse_str($Valores, $this->Places);
        endif;
        
        if(!$Campos):
            $Campos = '*';
        endif;
        
        $this->Select = "SELECT {$Campos} FROM {$Tabela} {$Termos}";
        $this->Execute();
    }

    /**
     * <b>Obter resultado:</b> Retorna um array com todos os resultados obtidos. 
     * Para obter um resultado chame o índice getResult()[0]!
     * @return ARRAY $this = Array ResultSet
     */
    public function getResult() {
        return $this->Result;
    }

    /**
     * <b>Contar Registros: </b> Retorna o número de registros encontrados pelo select!
     * @return INT $Var = Quantidade de registros encontrados
     */
    public function getRegistrosEncontrados() {
        return $this->Read->rowCount();
    } 
    
    /**
     * <b>Seta os dados:</b> Dados a serem substituidos na query de pesquisa.  
     * @param STRING $Valores = variavel={$valor}&variavel2={$valor2}
     */
    public function setDados($Valores) {
        parse_str($Valores, $this->Places);
        $this->Execute();
    }

    /**
     * ****************************************
     * *********** PRIVATE METHODS ************
     * ****************************************
     */
    //Obtém o PDO e Prepara a query
    private function Connect() {
        $this->Conn = parent::getConn();
        $this->Read = $this->Conn->prepare($this->Select);
        $this->Read->setFetchMode(PDO::FETCH_ASSOC);      
    }

    //Cria a sintaxe da query para Prepared Statements
    private function getSyntax() {
        if ($this->Places):
            foreach ($this->Places as $Vinculo => $Valor):
                if ($Vinculo == 'limit' || $Vinculo == 'offset'):
                    $Valor = (int) $Valor;
                endif;
                $this->Read->bindValue(":{$Vinculo}", $Valor, ( is_int($Valor) ? PDO::PARAM_INT : PDO::PARAM_STR));
            endforeach;
        endif;
    }

    //Obtém a Conexão e a Syntax, executa a query!
    private function Execute() {
        $this->Connect();
        try {
            $this->getSyntax();
            $this->Read->execute();
            $this->Result = $this->Read->fetchAll();
        } catch (PDOException $e) {
            $this->Result = null;
            Valida::Mensagem("Erro ao Ler: {$e->getMessage()}", 4);
        }
    }

}
