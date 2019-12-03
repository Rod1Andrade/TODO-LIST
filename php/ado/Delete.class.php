<?php

namespace php\ado;

final class Delete extends Instruction
{

    /**
     * Define a SQL de DELETE do banco
     */
    public function getInstruction(): string
    {
        $this->sql = "DELETE FROM {$this->entity}";

        if(isset($this->Criteria))
            $this->sql .= " WHERE {$this->Criteria->dump()}";

        return "{$this->sql}";
    }
}