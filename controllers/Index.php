<?php

class Index extends AController {

    public function __construct(){

    }

    public function get_body(){

        $db = new Database(HOST, USER, PASS, DB);

        $tasks = $db->get_tasks($_SESSION['id']);

        return $this->render('index', ['title'=>'family book', 'content'=>$tasks]);

    }

}
?>