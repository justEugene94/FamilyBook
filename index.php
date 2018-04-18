<?php

include 'config.php';
header("Content-Type: text/html; charset='utf-8'");

function __autoload($file){
    if(file_exists('controllers/' . $file . '.php')){
        require_once 'controllers/' . $file . '.php';
    }
    else {
        require_once 'models/' . $file . '.php';
    }
}

//if(!$_SESSION['id']){
//
//    $request_uri = explode('/', $_SERVER['REQUEST_URI']);
//
//    switch ($request_uri[1]){
//        case 'Login':
////            require 'controllers/Login.php';
//            $init = new Login();
//            $init->login();
//            break;
//    }
//
//    $init = new Login();
//    echo $init->get_body();
//
//}
//else{
//    $init = new Index();
//    echo $init->get_body();
//}

session_start();

$request_uri = explode('?', $_SERVER['REQUEST_URI'], 2);

if($_SESSION['id']) {

    //Routing mvc
    switch ($request_uri[0]) {

        // Home page
        case "/":
            $init = new Index();
            echo $init->get_body();
            break;
        case "/logout":
            $init = new Auth();
            echo $init->logout();
            break;
        // Everything else
        default:
            header('HTTP/1.0 404 Not Found');
            require_once 'views/404.php';
            break;
    }
}else{
    //Авторизация

    $init = new Auth();

    switch ($request_uri[0]) {

        // Login page
        case "/" :
            echo $init->get_body();
            break;
        case '/login' :
            echo $init->login();
            break;
        // Registry page
        case "/registry" :
            echo $init->registry();
            break;

    }
}





?>