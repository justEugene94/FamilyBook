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

        if(is_array($request)) {
            foreach ($request as $item) {
                if (empty($item)) {
                    return 'Вы не заполнили поле';
                } elseif (preg_match($pattern, $item)) {
                    $arr[] = $item;
                } else {
                    return 'Поле заполнено не верно';
                }
            }
            return $arr;
        }
        else{
            if (empty($request)) {
                return 'Вы не заполнили поле';
            } elseif (preg_match($pattern, $request)) {
                $string = $request;
            } else {
                return 'Поле заполнено не верно';
            }

            return $string;
        }
    }

    //Метод благодаря которому будут или не будут отображаться определенные ссылки из меню
    protected function parentMenu(){
        $id = $_SESSION['id'];

        $db = new Family(HOST, USER, PASS, DB);

        $parentMenu = $db->takeMember($id);

        return $parentMenu;
    }

    //Зашита от вредоносных инъекций
    protected function sanitizeString($var)
    {
        if(is_array($var)){
            foreach ($var as $item){
                $item = stripslashes($item);
                $item = strip_tags($item);
                $item = htmlentities($item);
                $res[] = $item;
            }
            return $res;
        }else{
            $var = stripslashes($var);
            $var = strip_tags($var);
            $var = htmlentities($var);
            return $var;
        }

    }

}
?>