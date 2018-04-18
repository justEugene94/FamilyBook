<?php
class Family extends Database {

    public $db;

    public function __construct($host, $user, $pass, $db)
    {
        parent::__construct($host, $user, $pass, $db);
    }

    public function get_user($name){

        $sql = "SELECT `id`, `name`, `password`, `family_memder_id` FROM `family` WHERE `name` = '". $name . "'";

        $res = mysqli_query($this->db, $sql);

        if(!$res){
            return False;
        }

        $row = mysqli_fetch_assoc($res);

        return $row;

    }

}
?>