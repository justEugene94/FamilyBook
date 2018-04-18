<?php

abstract class AController {

    protected function render($file, $params){
        extract($params);
        ob_start();
        include('views/'. $file . '.php');
        return ob_get_clean();
    }

    protected function validator($request){

        $pattern = '/^[а-яА-ЯёЁa-zA-Z0-9]+$/';

        foreach ($request as $item){
            if(preg_match($pattern, $item)){
                $arr[] = $item;
            }
            else{
                return false;
            }
        }
        return $arr;
    }


}
?>