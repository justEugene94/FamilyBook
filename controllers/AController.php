<?php

abstract class AController {

    protected function render($file, $params){
        extract($params);
        ob_start();
        include('views/'. $file . '.php');
        return ob_get_clean();
    }

    //Простая валидация через регулярное выражение
    protected function validator($request){

        $pattern = '/[а-яА-яёЁa-zA-Z0-9]+$/';

        foreach ($request as $item){
            if(empty($item)){
                return 'Вы не заполнили поле';
            }
            elseif (preg_match($pattern, $item)){
                $arr[] = $item;
            }
            else{
                return 'Поле заполнено не верно';
            }
        }
        return $arr;
    }

    //Метод благодаря которому будут или не будут отображаться определенные ссылки из меню
    protected function parentMenu(){
        $id = $_SESSION['id'];

        $db = new Family(HOST, USER, PASS, DB);

        $parentMenu = $db->takeMember($id);

        return $parentMenu;
    }

}
?>