<?php
    session_start();

    if($_SESSION['user'] == null){
        session_destroy();
        session_abort();
        header('location: /');
    }

    include_once '/var/www/html/TODO-LIST/configs/autoload.php';

    error_reporting(E_ALL);

    use php\dao\TaskDao;
    use php\model\Task;

    $user = unserialize($_SESSION['user']);

    $taskDao = new TaskDao;
    $tasks = new Task; // Instância para tarefas

    $userName = "{$user->getName()} {$user->getLastName()}";

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/style.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <title>TODO-LIST</title>
</head>
<body onload="hiddenDiv()">

    <div id="dash-container">
        <div class="menu-left">
            <div class="infos-pessoais">
                <div class="infos-pessoais-img">
                    <img src="../img/Users-images/<?=$user->getImageProfile()?>.png">
                </div><!--infos-pessoais--img-->
                <div class="infos-pessoais-nome">
                    <p><?=$userName?></p>
                </div><!--infos-pessoais--nome-->
                <div class="menu">
                    <div class="menu-content">
                        <img src="../img/verificado.png">
                        <p>Tarefas</p>
                    </div>
                    <!--

                    <div class="menu-content">
                        <img src="../img/cronometro.png">
                        <p>Importantes</p>
                    </div>
                    
                    -->

                    <a href="dashboard-planejada.php">
                        <div class="menu-content">
                            <img src="../img/calendario-main.png">
                            <p>Planejadas</p>
                        </div>
                    </a>

                    <a href="dashboard-concluidas.php">
                        <div class="menu-content">
                            <img src="../img/folder.png">
                            <p>Concluidas</p>
                        </div>
                    </a>
                    <div class="menu-content">
                        <img src="../img/sair.png">
                        <p><a href="../php/controller/LogoutController.php">Logout</a></p>
                    </div>
                </div><!--MENU-->
            </div><!--infos-pessoais-->
        </div><!--menu-left-->


        <div class="main-rigth">
                <div id="container-newTask">
                        <div id="NewTask-space">
                            <div class="task-title"><p>Adcionar Tarefa</p></div><!--task-title-->
                            <div class="close-btn" onclick="hiddenDiv()"><img src="../img/close.png"></div><!--close-btn-->
                        </div><!--NewTask-space-->
                        <hr />
                        <div class="form-task">
                            <form method="POST" action="../php/controller/TaskController.php" name="new-task">
                                <input type="hidden" name="idUser" value="<?=$user->getId()?>">
                                <input type="text" name="title" placeholder="Titulo" class="field">
                                <label class="label-task">Importante: </label><input type="radio" name="important" value="true" class="field-radio"><br>
                                <label><input type="hidden" name="dateStart" value="<?=date('Y/m/d')?>"></label>
                                <label class="label-task">Data de conclusão: </label><input type="date" min="<?=date('Y/m/d')?>" name="dateEnd">
                                <input type="hidden" name="status" value="Andamento">
                                <textarea class="textarea-field" placeholder="Descrição" maxlength="99" name="description"></textarea>
                                <input type="submit" value="Adicionar" name="btn-adcionar-task" class="task-btn" onclick="hiddenDiv()">
                            </form>
                        </div>
                    </div><!--Container-->
            
            <div id="header">
                <div class="header-title"><p>Tarefas</p></div><!--Title-->    
                <div class="header-btn">
                    <button class="header-btn-task" onclick="createNewTask()">Nova Tarefa</button>
                </div><!--Header--btrn-->
            </div><!--Header-->
            <div id="main-section">        
                <div id="element-section">
                    <?php
                        $tasks = $taskDao->getAll($user);
                        foreach($tasks as $line):
                    ?>
                    <div class="main-section-task">
                            <div class="main-section-task-left-image">
                                <img src="../img/favoritos.png">
                            </div><!--left-image-->                        
                            <div class="main-section-task-between">
                            <a href="?editar=<?=$line->getIdTask()?>">
                                <div class="main-section-task-between-title">
                                    <p><?=$line->getTitle()?></p>
                                </div><!--title-->
                                <div class="main-section-task-between-desc">
                                    <?php
                                        if(!empty($line->getDateEnd())):
                                    ?>
                                    <p>Data Conclusão: <?=$line->getDateEnd()?></p>
                                        <?php endif; ?>
                                    <p><?=$line->getDescription()?></p>
                                </div><!--desc-->
                            </a><!-- Fim link de editar -->
                            </div><!--between-->
                        
                            <div class="main-section-task-rigth">
                                <div class="main-section-task-rigth-concluir">
                                <a href="?concluir=<?=$line->getIdTask()?>"><img src="../img/carraca.png"></a>
                                </div><!--Concluir-->
                                <div class="main-section-task-rigth-excluir">
                                    <a href="?delete=<?=$line->getIdTask()?>"><img src="../img/lixeira-excluir.png"></a>
                                </div><!--Excluir-->
                            </div><!--right-->
                    </div><!--main-section--task-->
                    <?php
                        endforeach; // Final do Foreach
                    ?>
                </div><!--element-section-->
            </div><!--main-section-->
        </div><!--main-rigth-->
    </div>

    <script src="../js/dashboard-dom.js"></script>

</body>
</html>