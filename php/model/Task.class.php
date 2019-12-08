<?php

namespace php\model;

/**
 * @author: Rodrigo Andrade
 */
class Task{

    private $idTask;
    private $title;
    private $description;
    private $status;
    private $important;
    private $dateStart; // Sempre recebe a data atual do sistema
    private $dateEnd;
    private $idUser; // Id do objeto Usuário

    public function setIdTask($idTask){
        $this->idTask = $idTask;
    }

    public function getIdTask(){ return $this->idTask; }

    public function setTitle($title){
        $this->title = $title;
    }

    public function getTitle() { return $this->title; }

    public function setDescription($description){
        $this->description = $description;

    }

    public function getDescription() { return $this->description; }

    public function setStatus($status){
        $this->status = $status;
    }

    public function getStatus() { return $this->status; }

    public function setImportant($important){
        if($important == "true"){
            $this->important =  true;
        }
        else{
            $this->important = false;
        }
    }

    public function getImportant() { return $this->important; }

    public function setDateStart($dateStart)
    {
        $this->dateStart = $dateStart;
    }

    public function getDateStart()
    {
        return $this->dateStart;
    }

    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;
    }

    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    public function setIdUser($idUser){
        $this->idUser = $idUser;
    }
    
    public function getIdUser() { return $this->idUser; }

}
