<?php

namespace php\ado;

final class Update extends Instruction
{
    private $columnValues;

    public function __construct()
    {
        $this->columnValues = array();
    }

     /**
     * setRowData()
     * Configura o esquema de linhas de UPDATE no banco
     * @param $param    = Linha do banco de dados
     * @param $value    = Valor a ser atualizado (UPDATED)
     */
    public function setRowData($param, $value)
    {
        if(is_scalar($value))
        {
            if(is_string($value) && !empty($value))
                $this->columnValues[$param] = "'$value'";
            elseif(is_bool($value))
                $this->columnValues[$param] = $value ? 'TRUE' : 'FALSE';
            else
                $this->columnValues[$param] = $value;
        }
    }

    /**
     * Retorna a instrução de UPDATE no banco 
     * UPDATE TABLE SET chave = valor, chave = valor WHERE <condicao>
     */
    public function getInstruction(): string
    {

        $this->sql = "UPDATE {$this->entity} SET ";

        # Define no padrão do UPDATE SQL
        foreach($this->columnValues as $key => $value)
            $keyValue[] = "{$key} = {$value}";

        # Converte para string
        $keyValue = implode(', ', $keyValue);

        # Concatena com a clusula WHERE se existir
        $this->sql .= $keyValue;

        if(isset($this->Criteria))
            $this->sql .= " WHERE {$this->Criteria->dump()}";

        return "{$this->sql}";
    }
}