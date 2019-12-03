<?php 

namespace php\model;

/**
 * @author: Rodrigo Andrade
 */
class User{

    private $id;
    private $name;
    private $lastName;
    private $nickname;
    private $email;
    private $password;
    private $sexo;
    private $imageProfile;

    public function setId($id){
        $this->id = $id;
    }    

    public function getId() {return $this->id; }

    public function setName($name){
        $name = trim($name); // Remove os espaços do inicio e do final
        $this->name = $name;
    }

    public function getName() { return $this->name; }

    public function setLastName($lastName)
    {
        $lastName = trim($lastName);
        $this->lastName = $lastName;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setNickname($nickname){
        // if(strlen($nickname) <= 8)
        $this->nickname = $nickname;
    }

    public function getNickname() { return $this->nickname; }

    public function setEmail($email){

        // Regex para validar o emal:
        $this->email = $email;

    }

    public function getEmail() { return $this->email; }

    public function setPassword($password){

        // if(strlen($password) >= 6 && strlen($password) <= 18) VALIDAÇÂO PENDENTE
        $this->password = sha1($password);
        
        if(strlen($password) >= 40)
            $this->password = $password;

    }

    public function getPassword(){ return $this->password; }

    public function setSexo($sexo){
        if($sexo == 'F' || $sexo == 'M')
            $this->sexo = $sexo;
    }

    public function getSexo() { return $this->sexo; }

    public function setImageProfile($imageProfile){
        $this->imageProfile = $imageProfile;
    }

    public function getImageProfile() { return $this->imageProfile; }

}