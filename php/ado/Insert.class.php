<?php

namespace php\ado;

use php\ado\Instruction;
use php\ErrorExceptions\InsertExceptions;

final class Insert extends Instruction
{

    private $columnValues;

    public function __construct()
    {
        $this->columnValues = array();
    }

    /**
     * setRowData()
     * Configura o esquema de linhas de inserçao no banco
     * @param $param    = Linha do banco de dados
     * @param $value    = Valor a ser inserido
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
     * Sobreescrita do setCriteria
     * O Insert não tem critério de inserção
     * @Exceptions throw InsertException
     */
    public function setCriteria(Criteria $Criteria)
    {
        throw new InsertExceptions("Impossible pass parameter Criteria to class: ".__CLASS__);
    }

    /**
     * Retorna a instrução de Inserção no banco 
     */
    public function getInstruction(): string
    {
        $this->sql      = "INSERT INTO {$this->entity} ";
        $parameters     = '('.implode(', ', array_keys($this->columnValues)).')';
        $values         = '('.implode(', ', array_values($this->columnValues)).')';
        
        $this->sql .= "{$parameters} VALUES {$values}";

        return "{$this->sql}";
    }
}