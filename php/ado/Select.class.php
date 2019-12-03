<?php

namespace php\ado;

use php\ErrorExceptions\SelectException;

class Select extends Instruction
{

    // Para se buscar todos os dados dentro da tabela
    const ALL = '*';
    private $columns;

    public function __construct()
    {
        $this->columns = array();
    }

    /**
     * addColumn()
     * Adciona uma coluna a ser retornada pelo SELECT
     * @param $column   = Coluna a ser adcionada
     * @exception SelectException
     */
    public function addColumn($column)
    {
        if(isset($column) && is_string($column))
            $this->columns[] = $column;
        else
            throw new SelectException("The column value need be a String type");
    }

    public function getInstruction(): string
    {
        
        $this->sql = "SELECT ";
        $this->sql .= implode(',', $this->columns);
        $this->sql .= " FROM {$this->entity} ";

        if(isset($this->Criteria))
        {

            # WHERE CLAUSURES:
            $expression = $this->Criteria->dump();
            if($expression)
                $this->sql .= "WHERE {$expression} ";
                
            # Propriedades dos Critérios
            $order      = $this->Criteria->getProperty('order');
            $limit      = $this->Criteria->getProperty('limit');
            $offset     = $this->Criteria->getProperty('offset');

            if(isset($order) && !empty($order))
                $this->sql .= " ORDER BY {$order} ";
            if(isset($limit) && !empty($limit))
                $this->sql .= " LIMIT {$limit} ";
            if(isset($offset) && !empty($offset))
                $this->sql .= " OFFSET {$offset} ";
        }

        return "{$this->sql}";
    }   

}