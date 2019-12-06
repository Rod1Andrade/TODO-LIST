<?php

include_once '/var/www/html/TODO-LIST/configs/autoload.php';

use php\model\Task;
use php\dao\TaskDao;
use php\model\User;

function createTaskController()
{
    $taskDao = new TaskDao;
    $task = new Task();

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



/**
 * Usando as funções do Controller
 */

createTaskController();
