<?php
// Import Files: 
include_once 'Task.php';

class ScheduleTask extends Task{
    
    private $finishDay;

    public function __construct($title, $description, $status, $finishDay){
        parent::__construct($title, $description, $status);
        $this->finishDay = $finishDay;
    }
}

?>