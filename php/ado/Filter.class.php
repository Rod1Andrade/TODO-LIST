<?php

namespace php\ado;

class Filter extends Expression
{

    private $variable;
    private $operator;
    private $value;

    public function __construct($variable, $operator, $value)
    {
        $this->variable     = $variable;
        $this->operator     = $operator;
        $this->value        = $this->transformToSQLType($value);
    }

    /**
     * Transforma para o tipo de dado
     * @param $value    = Valor a ser convertido para o formato SQL
     * @return StringSQL devolve uma string SQL
     */
    private function transformToSQLType($value) : string
    {

        if(is_array($value))
        {
            $arr = array();
            foreach($value as $val)
            {
                if(is_string($val))
                    $arr[] = "'$val'";
                else
                    $arr[] = $val;
            }

            $string_sql_format = '('.implode(',', $arr).')';
        }
        elseif(is_string($value))
            $string_sql_format = "'$value'";
        elseif(is_bool($value))
            $string_sql_format = $value ? 'TRUE' : 'FALSE';
        elseif(is_null($value))
            $string_sql_format = 'NULL';
        else
            $string_sql_format = $value;

        return $string_sql_format;
    }

    /**
     * Implementação do método <abstract> na classe Expression
     * Devolve o Critério filtrado na expressão Lógica
     */
    public function dump() : string
    {
        return " {$this->variable} {$this->operator} {$this->value} ";
    }
}