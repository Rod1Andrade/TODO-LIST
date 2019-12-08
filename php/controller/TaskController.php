<?php

include_once '/var/www/html/TODO-LIST/configs/autoload.php';

use php\model\Task;
use php\dao\TaskDao;
use php\model\User;

function createTaskController()
{
    $taskDao = new TaskDao;
    $task = new Task;

    if($_REQUEST['title'] == '' or $_REQUEST['title'] == null)
    {   
        echo 'O titulo deve ser válido';
        echo "<script type='text/javascript'>";
        echo "location.href='/TODO-LIST/pages/dashboard.php'";
        echo "</script>";    
        return false;
    }

    $important = (isset($_REQUEST['important']) ? "true" : "false");

    $task->setTitle($_REQUEST['title']);
    $task->setDescription($_REQUEST['description']);
    $task->setImportant($important);
    $task->setStatus($_REQUEST['status']);
    $task->setDateStart($_REQUEST['dateStart']);

    $dateEnd = $_REQUEST['dateEnd'] ? $_REQUEST['dateEnd'] : null;

    $task->setDateEnd($dateEnd);
    $task->setIdUser($_REQUEST['idUser']);

    // var_dump($_REQUEST);
    // echo '<hr />';
    // var_dump($task);

    $taskDao->createTask($task);

    // var_dump($taskDao);

    if($task != NULL)
    {
        echo "<script type='text/javascript'>";
        echo "location.href='/TODO-LIST/pages/dashboard.php'";
        echo "</script>";    
    }

    return false;

}

function deleteTask($idTask)
{
    $taskDao = new TaskDao;
    
    $taskDao->deleteById($idTask);

}

function changeToConcluir($idTask)
{
    $taskDao = new TaskDao;
    $taskDao->concluirById($idTask);
}

function changeTittle($idTask, $title)
{
    $taskDao = new TaskDao;
    $taskDao->updateTitleById($idTask, $title);
}

function changeDesc($idTask, $description)
{
    $taskDao = new TaskDao;
    $taskDao->updateDescById($idTask, $description);
}

/**
 * Usando as funções do Controller
 */


if(isset($_REQUEST['btn-adcionar-task']))
{
    createTaskController();
}

if(isset($_REQUEST['delete']))
{
    // deleteTask($_REQUEST[['delete']]);
    $id = $_REQUEST['delete'];

    deleteTask($id);

}
if(isset($_REQUEST['concluir']))
{
    $id = $_REQUEST['concluir'];
    changeToConcluir($id);   
}

if(isset($_REQUEST['updateTitle']))
{
    $idTask =  $_REQUEST['id'];
    $title  =  $_REQUEST['updateTitle'];

    changeTittle($idTask, $title);
}

if(isset($_REQUEST['updateDesc']))
{
    $idTask =  $_REQUEST['id'];
    $title  =  $_REQUEST['updateDesc'];

    changeDesc($idTask, $title);
}