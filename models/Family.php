<?php
class Family extends Database {

    public $db;

    public function __construct($host, $user, $pass, $db)
    {
        parent::__construct($host, $user, $pass, $db);
    }

    //Достаем с базы данных пользователя если имя совпадает
    public function get_user($name){

        $sql = "SELECT `id`, `name`, `password`, `family_member_id` FROM `family` WHERE `name` = '". $name . "'";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return False;
        }

        $row = mysqli_fetch_assoc($res);

        return $row;

    }

    //Проверка при регистрации на существование в таблице family Матери или Отца
    public function check_parent($id){

        $sql = "SELECT fm.member FROM family f, family_members fm WHERE f.family_member_id = fm.id AND f.family_member_id='" . $id . "'";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return 'Проблема с подключением к базе данных';
        }

        for($i = 0; $i < mysqli_num_rows($res); $i++) {
            $row[] = mysqli_fetch_assoc($res);
        }

        if(!$row){
            return TRUE;
        }
        elseif(is_array($row)){
            foreach ($res as $item){
                if($item['member'] == 'Mother' || $item['member'] == 'Father'){
                    return 'Такой член семьи уже зарегестрирован';
                }
            }
        }
        else return TRUE;
    }

    //Проверка имени в таблице family на совпадения
    public function check_name($name){

        $sql = "SELECT `name` FROM `family` WHERE `name`= '" . $name . "'";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return 'Проблема с подключением к базе данных';
        }

        $row = mysqli_fetch_assoc($res);

//        print_r($row);

        if($row['name'] == $name){
            return 'Такое имя уже используется';
        }
        else return TRUE;

    }

    public function save($arr){

        $str = "'" . $arr['name'] . "', '" . $arr['pass']. "', '" . $arr['family_member_id'] . "'";

        $sql = 'INSERT INTO `family` (`name`, `password`, `family_member_id`) VALUES ('. $str .')';

        mysqli_query($this->db, $sql);

        if(mysqli_insert_id($this->db) == 0){

            return 'Возникла ошибка при регистрации';
        }

        return mysqli_insert_id($this->db);
    }

    //Метод, который возвращает "ранг" члена семьи по его id
    public function takeMember($id){
        $sql = "SELECT fm.member FROM family_members fm, family f WHERE fm.id = f.family_member_id AND f.id = '" . $id . "'";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return FALSE;
        }

        $row = mysqli_fetch_assoc($res);
        $row = implode($row);

        return $row;
    }

}
?>