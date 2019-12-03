<?php

namespace php\ado;

class Criteria extends Expression
{
    private $expressionsList; 
    private $operatorsList;
    private $properties;

    /**
     * __construct()
     * 
     * Inicia as listas na forma de array
     */
    public function __construct()
    {
        $this->expressionsList  = array();
        $this->operatorsList    = array();
    }

    /**
     * add()
     * Adciona as expressões e os operadores a lista de expressões
     * @param $expression   = Qualquer subclasse de Expression
     * @param $operator     = Operador Lógico AND ou OR
     */
    public function add(Expression $expression, $operator = Expression::AND_OPERATOR)
    {

        if(empty($this->expressionsList))
            $operator = null;
        
        $this->expressionsList[]    = $expression;
        $this->operatorsList[]      = $operator;
    }

    /**
     * @Override for Expression
     * dump()
     * Retorna a lista de expressões concatenadas em uma string
     * formatada.
     */
    public function dump(): string
    {
        // Concatena a lista de expressões:
        $result_string_sql = "";

        if(is_array($this->expressionsList) && count($this->expressionsList) > 0)
        {
            foreach($this->expressionsList as $k => $expression)
            {
                $operator = $this->operatorsList[$k];
                $result_string_sql .= $operator.$expression->dump().' ';
            }

            $result_string_sql = trim($result_string_sql);
        }
        return "{$result_string_sql}";
    }

    /**
     * setProperty()
     * Define o valor de uma propriedade
     * @param $property     = Propriedade a ser definida
     * @param $value        = Valor referente a propriedade
     */
    public function setProperty($property, $value)
    {
        if(isset($value))
            $this->properties[$property] = $value;
        else
            $this->properties[$property] = null;
    }

    /**
     * getProperty()
     * Passado o parametro da propriedade é retornado o seu valro
     * @param $property     = Propriedade a ser retornada
     */
    public function getProperty($property)
    {
        if(isset($this->properties[$property]))
            return $this->properties[$property];
    }

}