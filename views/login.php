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
</div>
<h4 class="text-center">Войдите в свой профиль</h4>

<? if(isset($ErrorStatus)): ?>
<div class="alert alert-danger" role="alert">
    <?=$ErrorStatus;?>
</div>
<? endif;?>

<div class="container">
    <form  method="post" action="/login">
        <div class="form-group">
            <label for="name">Имя</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Введите ваше имя">
        </div>
        <div class="form-group">
            <label for="password">Пароль</label>
            <input type="password" name="pass" class="form-control" id="password" placeholder="Введите ваш пароль">
        </div>

        <button type="submit" class="btn btn-primary">Войти</button>
    </form>
    <p align="right"><a href="/registry">Зарегистрироваться</a></p>
</div>

</body>
</html>