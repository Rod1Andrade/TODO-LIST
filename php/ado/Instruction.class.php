<?php

namespace php\ado;

abstract class Instruction
{

    protected $sql;
    protected $Criteria;
    protected $entity;

    /**
     * setEntity()
     * Definir entidade do banco de dados
     * @param $entity       = Entidade Relacional
     */
    public function setEntity($entity)
    {
        if(!empty($entity))
            $this->entity = $entity;
    }

    /**
     * getEntity()
     * Recuperar nome da entidade do banco
     * @return $this->enitity   = Entidade definida no objeto
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * setCriteria()
     * Define o critério da instrução que vai ser executada (WHERE)
     */
    public function setCriteria(Criteria $Criteria)
    {
        $this->Criteria = $Criteria;
    }

    /**
     * getInstruction()
     * <abstract>
     * Definição da implementação nas Classe (Insert, Update, Delete, Select):
     * @return Instruction      = Instrução SQL completa.
     */
    abstract function getInstruction(): string;

}