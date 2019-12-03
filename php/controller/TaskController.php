<?php

include_once '../configs/autoload.php';

function createTaskController()
{
    $taskDao = new TaskDao();
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
    $task->setIdUser($_REQUEST['idUser']);

    $taskDao->createTask($task);

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
