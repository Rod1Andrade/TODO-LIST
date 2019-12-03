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
    private $idUser; // Id do objeto Usuário

    public function setIdTask($idTask){
        $this->idTask = $idTask;
    }

    public function getIdTask(){ return $this->idTask; }

    public function setTitle($title){

        if(strlen($title) <= 50){
            $this->title = $title;
        }else{
            // Lançar Exceção posteriormente
        }
    }

    public function getTitle() { return $this->title; }

    public function setDescription($description){

        if(strlen($description) <= 100){
            $this->description = $description;
        }else{
            // TODO: Lançar Exceção
        }

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

    public function setIdUser($idUser){
        $this->idUser = $idUser;
    }
    
    public function getIdUser() { return $this->idUser; }

}
