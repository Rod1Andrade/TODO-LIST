<?php

namespace php\dao;

use php\ado\Connection;
use php\model\User;

use php\ado\Insert;
use php\ado\Select;
use php\ado\Criteria;

use PDOException;
use PDO;
use php\ado\Expression;
use php\ado\Filter;

/**
 * @author: Rodrigo Andrade
 */
class UserDao
{

    /**
     * Insere objeto usuario no banco de dados
     * @param $user Instância de um objeto Usuário para inserção no banco de dados
     */
    public function createUser(User $user)
    {

        echo 'HERE...<br />';
        $conn = Connection::open('/var/www/html/TODO-LIST/configs/DB.ini');
        
        var_dump($conn);

        $sql = new Insert;
        $sql->setEntity('User');

        $sql->setRowData('name', $user->getName());
        $sql->setRowData('lastName', $user->getLastName());
        $sql->setRowData('nickName', $user->getNickname());
        $sql->setRowData('email', $user->getEmail());
        $sql->setRowData('password', $user->getPassword());
        $sql->setRowData('sex', $user->getSexo());
        $sql->setRowData('imageProfile', $user->getImageProfile());

        try
        {
            $conn->exec($sql->getInstruction());
        }
        catch(PDOException $e)
        {
            echo 'Error: '.$e->getMessage();
        }
        finally
        {
            Connection::closeConnection();
        }
    }

    //TODO: Refatorar esses dois métodos abaixo, de forma que fique apenas 1.

    /**
     * Procura O usuário por email e devolve uma instância dele
     * @param email
     * @param password
     * @return $user -> Instãncia do objeto usuario preenchido com os dados do banco de dados
     */
    public function getUserByEmail($email, $password)
    {
        
        $user = new User();
        $conn = Connection::open('../../configs/DB.ini');

        // Encode Hash para a senha: 
        $password = sha1($password);

        // $sql = "SELECT * FROM User WHERE (email = :email AND password = :password)";

        $sql = new Select;
        $sql->setEntity('User');
        $sql->addColumn('*');

        $Criteria = new Criteria;
        $Criteria->add(new Filter('email', '=', $email), Expression::AND_OPERATOR);
        $Criteria->add(new Filter('password', '=', $password), Expression::AND_OPERATOR);

        $sql->setCriteria($Criteria);

        // echo 'SQL: '.$sql->getInstruction().'<br />';
        
        try{

            $st = $conn->prepare($sql->getInstruction());
            $st->execute();

            $result = $st->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $row){
                $user->setId($row["id"]);
                $user->setName($row["name"]);
                $user->setLastName($row["lastName"]);
                $user->setNickname($row["nickName"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                $user->setSexo($row["sex"]);
                $user->setImageProfile($row["imageProfile"]);
            }

            // print_r($user);

        }catch(PDOException $e)
        {
            echo 'Error: '.$e->getMessage();
        }finally
        {
            Connection::closeConnection();
        }

        return $user;        
    }

    /**
     * Procura um elemento pelo nick name e retorna uma instância
     * @param nickName
     * @param password
     * @return $user -> Instãncia do objeto usuario preenchido com os dados do banco de dados
     */
    public function getUserByNickname($nickName, $password)
    {
        
        $user = new User();
        $conn = Connection::open('../../configs/DB.ini');

        // Encode Hash para a senha: 
        $password = sha1($password);

        $sql = new Select;
        $sql->setEntity('User');
        $sql->addColumn('*');

        $Criteria = new Criteria;
        $Criteria->add(new Filter('nickName', '=', $nickName), Expression::AND_OPERATOR);
        $Criteria->add(new Filter('password', '=', $password), Expression::AND_OPERATOR);

        $sql->setCriteria($Criteria);

        try{

            // Encode Hash para a senha: 
            $st = $conn->prepare($sql->getInstruction());
            $st->execute();

            $result = $st->fetchAll(PDO::FETCH_ASSOC);

            foreach($result as $row){
                $user->setId($row["id"]);
                $user->setName($row["name"]);
                $user->setLastName($row["lastName"]);
                $user->setNickname($row["nickName"]);
                $user->setEmail($row["email"]);
                $user->setPassword($row["password"]);
                $user->setSexo($row["sex"]);
                $user->setImageProfile($row["imageProfile"]);
            }


        }catch(PDOException $e)
        {
            echo 'Error: '.$e->getMessage();
        }finally
        {
            Connection::closeConnection();
        }

        return $user;        
    }

}