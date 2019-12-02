<?php
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

        $conn = Connection::getInstance();
        $sql = "INSERT INTO User (name, nickname, email, password, sexo, imageProfile)
        VALUES (:name, :nickname, :email, :password, :sexo, :imageProfile)";

        echo $sql;

        try
        {
            $name = $user->getName();
            $nickname = $user->getNickname();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $sexo = $user->getSexo();
            $imageProfile = $user->getImageProfile();

            $statement = $conn->prepare($sql);
            $statement->bindParam(':name', $name);
            $statement->bindParam(':nickname', $nickname);
            $statement->bindParam(':email', $email);
            $statement->bindParam('password', $password);
            $statement->bindParam('sexo', $sexo);
            $statement->bindParam(':imageProfile', $imageProfile);

            $statement->execute();

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
        $conn = Connection::getInstance();

        $sql = "SELECT * FROM User WHERE (email = :email AND password = :password)";

        try{

            // Encode Hash para a senha: 
            $password = sha1($password);

            $statement = $conn->prepare($sql);
            $statement->bindParam(':email', $email);
            $statement->bindParam(':password', $password);
            $statement->execute();

            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);

            $arr = $statement->fetchAll();

            if($result && $arr){

                $user->setId($arr[0]["id"]);
                $user->setName($arr[0]["name"]);
                $user->setNickname($arr[0]["nickName"]);
                $user->setEmail($arr[0]["email"]);
                $user->setPassword($arr[0]["password"]);
                $user->setSexo($arr[0]["sexo"]);
                $user->setImageProfile($arr[0]["imageProfile"]);
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

    /**
     * Procura um elemento pelo nick name e retorna uma instância
     * @param nickName
     * @param password
     * @return $user -> Instãncia do objeto usuario preenchido com os dados do banco de dados
     */
    public function getUserByNickname($nickName, $password)
    {
        
        $user = new User();
        $conn = Connection::getInstance();

        $sql = "SELECT * FROM User WHERE (nickName = :nickName AND password = :password)";

        try{

            // Encode Hash para a senha: 
            $password = sha1($password);

            $statement = $conn->prepare($sql);
            $statement->bindParam(':nickName', $nickName);
            $statement->bindParam(':password', $password);
            $statement->execute();

            $result = $statement->setFetchMode(PDO::FETCH_ASSOC);

            $arr = $statement->fetchAll();

            if($result && $arr){

                $user->setId($arr[0]["id"]);
                $user->setName($arr[0]["name"]);
                $user->setNickname($arr[0]["nickName"]);
                $user->setEmail($arr[0]["email"]);
                $user->setPassword($arr[0]["password"]);
                $user->setSexo($arr[0]["sexo"]);
                $user->setImageProfile($arr[0]["imageProfile"]);
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