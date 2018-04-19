<?php

class Index extends AController {

    public function __construct(){

    }

    public function get_body(){

        $db = new Database(HOST, USER, PASS, DB);

        $status = 'Не выполнено';

        $tasks = $db->get_tasks($_SESSION['id'], $status);

        return $this->render('index', ['title'=>'family book','parentMenu'=>$this->parentMenu(), 'content'=>$tasks]);

    }

    public function doneTasks(){

        $db = new Database(HOST,USER, PASS, DB);

        $status = 'Выполнено';

        $tasks = $db->get_tasks($_SESSION['id'], $status);

        $done = 'Еще никто не успел выполнить задания';

        return $this->render('index', ['title'=>'family book','parentMenu'=>$this->parentMenu(),'done'=>$done, 'content'=>$tasks]);
    }

}
?>