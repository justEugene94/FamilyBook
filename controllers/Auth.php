<?php

class Auth extends AController {

    public function get_body(){

            return $this->render('login',['title'=>'Login Page']);

    }

    public function login(){

        $name = $_POST['name'];
        $pass = $_POST['pass'];

        $db = new Family(HOST, USER, PASS, DB);

        $rep_user = $db->get_user($name);

        //Запрос к базы данных ничего не вернул
        if(!$rep_user){

            return $this->render('login', ['title'=>'Login Page', 'ErrorStatus'=>'Неверное имя или пароль']);
        }

        //Проверяем только идентичность пароля, так как имя пользователя уже совпало в базе данных
        if($rep_user['password'] == $pass){

            $_SESSION['id'] = $rep_user['id'];

            header('Location: http://testprog.loc/');
            die();
        }

        return $this->render('login', ['title'=>'Login Page', 'ErrorStatus'=>'Неверное имя или пароль']);
    }

    public function logout(){
        session_destroy();
        header('Location: http://testprog.loc/');
        die();
    }

    public function registry(){

        if(!empty($_POST)){

            $input = $_POST;

            $validator = $this->validator($input);

            if(!$validator){
                return $this->render('registry', ['title'=>'Registry Page', 'ErrorStatus'=>'Поля заполнены не верно']);
            }

            print_r($validator);



        }


        return $this->render('registry', ['title'=>'Registry Page']);
    }


}?>