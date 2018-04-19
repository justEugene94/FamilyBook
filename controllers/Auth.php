<?php

class Auth extends AController {

    public function get_body(){

            return $this->render('login',['title'=>'Login Page']);

    }

    public function login(){

        $input = $_POST;

        $name = $input['name'];
        $pass = $input['pass'];

        $validator = $this->validator($input);
        if(is_string($validator) ){
            return $this->render('registry', ['title'=>'Registry Page', 'ErrorStatus'=>$validator]);
        }

        $pass = md5($pass);

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

        $db = new Family(HOST, USER, PASS, DB);

        $members = $db->get_members();

        if(!empty($_POST)){

            $input = $_POST;

            $validator = $this->validator($input);
            if(is_string($validator) ){
                return $this->render('registry', ['title'=>'Registry Page','members'=>$members, 'ErrorStatus'=>$validator]);
            }

            $checkParent = $db->check_parent($input['family_member_id']);
            if(is_string($checkParent)){
                return $this->render('registry', ['title'=>'Registry Page','members'=>$members, 'ErrorStatus'=>$checkParent]);
            }

            $checkName = $db->check_name($input['name']);
            if(is_string($checkName)){
                return $this->render('registry', ['title'=>'Registry Page','members'=>$members, 'ErrorStatus'=>$checkName]);
            }

            if($input['pass'] != $input['pass_confirm']){
                return $this->render('registry', ['title'=>'Registry Page','members'=>$members, 'ErrorStatus'=>'Пароль не совпадает']);
            }

            $input['pass'] = md5($input['pass']);

            unset($input['pass_confirm']);

            $id = $db->save($input);
            if(is_string($id)){
                return $this->render('registry', ['title'=>'Registry Page','members'=>$members, 'ErrorStatus'=>$id]);
            }

            $_SESSION['id'] = $id;

            header('Location: http://testprog.loc/');
            die();

        }


        return $this->render('registry', ['title'=>'Registry Page', 'members'=>$members]);
    }


}?>