<?php 

namespace php\dao;

use php\ado\Connection;
use php\model\User;
use php\model\Task;

use PDO;
use PDOException;
use php\ado\Criteria;
use php\ado\Delete;
use php\ado\Filter;
use php\ado\Insert;
use php\ado\Select;
use php\ado\Update;

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
        // $sql = "INSERT INTO task (title, description, status, idUser, isImportant) VALUES (:title, :description, :status, :idUser, :isImportant)";

        $sql = new Insert;
        $sql->setEntity('Task');

        $sql->setRowData('title', $task->getTitle());
        $sql->setRowData('description', $task->getDescription());
        $sql->setRowData('status', $task->getStatus());
        $sql->setRowData('isImportant', $task->getImportant());
        $sql->setRowData('dateStart', $task->getDateStart());
        $sql->setRowData('dateEnd', $task->getDateEnd());
        $sql->setRowData('idUser', $task->getIdUser());
        
        // echo $sql->getInstruction();

        try
        {
            $statement = $conn->prepare($sql->getInstruction());   
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

        // print_r($user);

        $conn = Connection::open('/var/www/html/TODO-LIST/configs/DB.ini');
        // $sql = "SELECT * from task WHERE idUser = :idUser";

        $sql = new Select;
        $Criteria = new Criteria;

        $sql->setEntity('Task');
        $sql->addColumn('*');

        $Criteria->add(new Filter('idUser', '=', $user->getId()));
        $sql->setCriteria($Criteria);

        try 
        {
            $st = $conn->prepare($sql->getInstruction());
            $st->execute();

            $result = $st->fetchAll(PDO::FETCH_ASSOC);

            // var_dump($result);
            
            foreach($result as $value)
            {
                // var_dump($value);
                $task = new Task;

                $task->setIdTask($value['id']);
                $task->setTitle($value['title']);
                $task->setDescription($value['description']);
                $task->setStatus($value['status']);
                $task->setImportant($value['isImportant']);
                $task->setDateStart($value['dateStart']);
                $task->setDateEnd($value['dateEnd']);
                $task->setIdUser($value['idUser']);

                $tasks[] = $task;
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

        $conn = Connection::open('/var/www/html/TODO-LIST/configs/DB.ini');
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

    /**
     * Deleta elemento pelo ID
     * @param idTask        = ID da tarefa que vai ser excluir
     * @throws PDOException = Pode lançar exceções do tipo PDO
     */
    public function deleteById($idTask)
    {
        $conn = Connection::open('/var/www/html/TODO-LIST/configs/DB.ini');

        $sql = new Delete;
        
        $Criteria = new Criteria;
        $Criteria->add(new Filter('id', '=', $idTask));
        
        $sql->setEntity('Task');
        $sql->setCriteria($Criteria);

        //echo $sql->getInstruction();

        try
        {
            $st = $conn->prepare($sql->getInstruction());
            $st->execute();

            return true; // Sucesso
        }
        catch(PDOException $e)
        {
            echo 'error: '.$e->getMessage();
        }finally
        {
            Connection::closeConnection();
        }

        return false; // No sucesso
    }

    public function concluirById($idTask)
    {
        $conn = Connection::open('/var/www/html/TODO-LIST/configs/DB.ini');

        $sql = new Update;
        $sql->setEntity('Task');

        $Criteria = new Criteria;
        $Criteria->add(new Filter('id', '=', $idTask));

        $sql->setRowData('status', 'Concluida');
        $sql->setCriteria($Criteria);
        
        try
        {
            $st = $conn->prepare($sql->getInstruction());
            $st->execute();

            return true; // Sucesso
        }
        catch(PDOException $e)
        {
            echo 'error: '.$e->getMessage();
        }finally
        {
            Connection::closeConnection();
        }

        return false; // No sucesso
    }

}