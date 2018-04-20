<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title><?=$title;?></title>
</head>
<body>
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal">Семейная книга</h5>
    <nav class="my-2 my-md-0 mr-md-3">

        <!--   Отображение части меню, если залогинился Отец или Мать соответственно      -->
        <?if(isset($parentMenu)):?>
            <?if($parentMenu == 'Mother') :?>
                <a class="p-2 text-dark" href="/newtask">Создать задание</a>
            <?endif;?>

            <?if($parentMenu == 'Father') :?>
                <a class="p-2 text-dark" href="/executors">Назначить на задание</a>
            <?endif;?>
        <?endif;?>
        <a class="p-2 text-dark" href="/">Задания</a>
        <a class="p-2 text-dark" href="/tasks">Готовые задания</a>
    </nav>
    <a class="btn btn-outline-primary" href="/logout">Выйти</a>
</div>

<h4 class="text-center">Добавьте новое задание</h4>

<? if(isset($ErrorStatus)): ?>
    <div class="alert alert-danger" role="alert">
        <?=$ErrorStatus;?>
    </div>
<? endif;?>

<? if(isset($successStatus)): ?>
    <div class="alert alert-success" role="alert">
        <?=$successStatus;?>
    </div>
<? endif;?>

<div class="container">

    <form method="post" action="/newtask">
        <div class="form-group">

            <textarea class="form-control" name="task" id="task" rows="4"></textarea>

        </div>

        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>

</div>

</body>
</html>