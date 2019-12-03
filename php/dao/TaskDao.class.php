<?php 

namespace php\dao;

use php\ado\Connection;
use php\model\User;
use php\model\Task;

use PDO;
use PDOException;
use php\ado\Insert;

/**
 * @author: Rodrigo Andrade
 */
class TaskDao
{

    /**
     * Armazena dados na tabela'task'.
     * @param task Objeto Task passando todos os dados para criar uma nova tarefa.
     * @Exception PDOExcepetion
     */
    public function createTask(Task $task)
    {

        $conn = Connection::open('../../configs/DB.ini');
        $sql = "INSERT INTO task (title, description, status, idUser, isImportant) VALUES (:title, :description, :status, :idUser, :isImportant)";

        $sql = new Insert;
        $sql->setEntity('Task');

        $sql->setRowData('title', $task->getTitle());
        $sql->setRowData('description', $task->getDescription());
        $sql->setRowData('status', $task->getStatus());
        $sql->setRowData('isImportant', $task->getImportant());
        $sql->setRowData('dateStart', 'none');
        $sql->setRowData('dateEnd', 'none');
        $sql->setRowData('idUser', $task->getIdUser());
        
        try
        {
            $statement = $conn->prepare($sql);   
            $statement->execute();

        }
        catch(PDOException $e){
            echo 'Error in task: '.$e->getMessage();
        }
        finally
        {
            Connection::closeConnection();
        }
    }

    /**
     * Recupera todas as tuplas continas na tabela, senão conter registro retornase
     * @param User Instância de um usuário para recuperar dados
     * @return Null or Task
     */
    public function getAll(User $user)
    {

        $tasks = array();

        $conn = Connection::open('../../configs/DB.ini');
        $sql = "SELECT * from task WHERE idUser = :idUser";

        try
        {

            $statement = $conn->prepare($sql);

            $idUser = $user->getId();

            $statement->bindParam(':idUser', $idUser);
            $statement->execute();

            $statement->setFetchMode(PDO::FETCH_ASSOC);

            $result = $statement->fetchAll();

            //print_r($result);

            foreach($result as $line){
                $task = new Task();

                $task->setIdTask($line["idTask"]);
                $task->setTitle($line["title"]);
                $task->setDescription(($line["description"]));
                $task->setStatus($line["status"]);
                $task->setIdUser($line["idUser"]);
                $task->setImportant($line["isImportant"]);

                array_push($tasks, $task);

            }

        }
        catch(PDOException $e){
            echo 'Error in TaskDAO: '.$e->getMessage();
        }
        finally
        {
            Connection::closeConnection();
        }

        return $tasks;
    }

    /**
     * Procura um objeto Task na tabela task e retorna uma Instância com base no seu id.
     * @param idTask ID
     * @param User Instância do objeto Usuário
     * @return Task Instânciada
     */
    public function getTaskById($idTask, User $user)
    {

        $conn = Connection::open('../../configs/DB.ini');
        $sql = "SELECT title, description FROM task WHERE idTask = :idTask AND idUser = :idUser";

        $task = new Task();

        try
        {

            $idUser = $user->getId();

            $statement = $conn->prepare($sql);
            $statement->bindParam(':idTask', $idTask);
            $statement->bindParam(':idUser', $idUser);

            $statement->execute();

            if(true){}

        }
        catch(PDOException $e){
            echo 'Error: '.$e->getMessage();
        }
        finally
        {
            Connection::closeConnection();
        }

        return $task;
    }

}