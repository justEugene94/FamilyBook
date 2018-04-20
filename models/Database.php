<?php

class Database {

    public $db;

    //Подключение к базе данных
    public function __construct($host, $user, $pass, $db){
        $this->db = mysqli_connect($host, $user, $pass);
        if(!$this->db){
            exit('Нет связи с базой данных');
        }

        if(!mysqli_select_db($this->db, $db)){
            exit('Нет таблицы');
        }

        mysqli_query($this->db,'SET NAMES utf8');

        return $this->db;
    }

    public function get_tasks($status, $id = false){

        if(is_integer($id)){
            $sql = "SELECT t.id, t.task, t.status, f.name FROM tasks t, family f WHERE t.family_id = f.id AND t.status='" .$status . "' AND t.family_id = '" . $id ."'";

        }
        else{
            $sql = "SELECT t.id, t.task, t.status, f.name FROM tasks t, family f WHERE t.family_id = f.id AND t.status='" .$status ."'";

        }

        $res = mysqli_query($this->db, $sql);


        if(!$res){
            return FALSE;
        }

        for($i = 0; $i < mysqli_num_rows($res); $i++){
            $row[] = mysqli_fetch_assoc($res);
        }

        return $row;
    }

    public function get_tasks_for_father(){
        $sql = "SELECT id, task, status FROM tasks WHERE family_id IS NULL ";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return FALSE;
        }

        for($i = 0; $i < mysqli_num_rows($res); $i++){
            $row[] = mysqli_fetch_assoc($res);
        }

        return $row;
    }

    public function get_members(){

        $sql = "SELECT `id`, `member` FROM `family_members`";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return False;
        }

        for($i = 0; $i < mysqli_num_rows($res); $i++){
            $row[] = mysqli_fetch_assoc($res);
        }

        return $row;

    }

    public function statusDone($id){

        $sql = "UPDATE `tasks` SET `status`='Выполнено' WHERE `id` = '" . $id . "'";

        $res = mysqli_query($this->db, $sql);

        if(mysqli_affected_rows($this->db) == -1){
            return FALSE;
        }

        return TRUE;
    }

    public function saveTask($string){

        $sql = "INSERT INTO `tasks` (`task`) VALUES ('" . $string . "')";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return 'Проблема с подключением базы данных';
        }

        if(mysqli_insert_id($this->db) == 0){

            return 'Возникла ошибка при сохранении задания';
        }

        return TRUE;
    }


}
?>