<?php

class Index extends AController {

    public function __construct(){

    }

    public function get_body(){

        $db = new Database(HOST, USER, PASS, DB);

        $status = 'Не выполнено';

        $id = $_SESSION['id'];

        $tasks = $db->get_tasks($status, $id);

        if(!empty($_POST)){

            $id = $this->sanitizeString($_POST['id']);

            $done = $db->statusDone($id);

            if(!$done){

                $error = 'Проблема с работой сайта, попробуйте позже';

                return $this->render('index', ['title'=>'Family book','parentMenu'=>$this->parentMenu(), 'content'=>$tasks, 'ErrorStatus'=>$error]);
            }

            $successStatus = 'Спасибо за выполнение поставленой задачи. Удачи в начинаниях';

           return $this->render('index', ['title'=>'Family book','parentMenu'=>$this->parentMenu(), 'content'=>$tasks, 'successStatus'=>$successStatus]);
        }

        return $this->render('index', ['title'=>'Family book','parentMenu'=>$this->parentMenu(), 'content'=>$tasks]);

    }

    public function doneTasks(){

        $db = new Database(HOST,USER, PASS, DB);

        $status = 'Выполнено';

        $tasks = $db->get_tasks($status, false);

        $done = 'Еще никто не успел выполнить задания';

        return $this->render('index', ['title'=>'Family book','parentMenu'=>$this->parentMenu(),'done'=>$done, 'content'=>$tasks]);
    }

    public function newTask(){

        if(!empty($_POST)){

            $task = $this->sanitizeString($_POST['task']);

            $validator = $this->validator($task);
            if(is_string($task)){
                return $this->render('newtask', ['title'=>'New Task', 'parentMenu'=>$this->parentMenu(), 'ErrorStatus'=>$validator]);
            }

            $db = new Database(HOST,USER, PASS, DB);

            $newtask = $db->saveTask($task);

            if(is_string($newtask)){
                return $this->render('newtask', ['title'=>'New Task', 'parentMenu'=>$this->parentMenu(), 'ErrorStatus'=>$newtask]);
            }

            $success = 'Задание добавлено';

            return $this->render('newtask', ['title'=>'New Task', 'parentMenu'=>$this->parentMenu(), 'successStatus'=>$success]);

        }

        return $this->render('newtask', ['title'=>'New Task', 'parentMenu'=>$this->parentMenu()]);
    }

    public function assignTask(){

        $db = new Family(HOST,USER, PASS, DB);

        $tasks = $db->get_tasks_for_father();

        $users = $db->takeNames();

        if(!empty($_POST)){

            $id = $this->sanitizeString($_POST['id']);
            $family_id = $this->sanitizeString($_POST['family_id']);

            $res = $db->changeFamilyId($id, $family_id);

            if(!$res){

                $error = 'Возникла ошибка при назначении пользователя на задание';

                return $this->render('assigntask', ['title'=>'New Task', 'parentMenu'=>$this->parentMenu(), 'content'=>$tasks, 'names'=>$users, 'ErrorStatus'=>$error]);
            }

            $success = 'Вы назначили на задание пользователя';

            return $this->render('assigntask', ['title'=>'New Task', 'parentMenu'=>$this->parentMenu(), 'content'=>$tasks, 'names'=>$users, 'successStatus'=>$success]);
        }

        return $this->render('assigntask', ['title'=>'New Task', 'parentMenu'=>$this->parentMenu(), 'content'=>$tasks, 'names'=>$users]);
    }

}
?>