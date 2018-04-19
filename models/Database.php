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

    public function get_tasks(){
        $sql = 'SELECT `id`, `task`, `family_id`, `status` FROM `tasks`';

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




}
?>