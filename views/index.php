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
        <a class="p-2 text-dark" href="/logout">Выйти</a>
    </nav>

</div>
<h4 class="text-center">Время сделать что-то полезное для дома</h4>
<div class="container">
    <form>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Задание</th>
                <th scope="col">Статус</th>
                <th scope="col">Выполнил</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($content as $item):?>
            <tr>
                <th><?=$item['id'];?></th>
                <td><?=$item['family_id'];?></td>
                <td><?=$item['task'];?></td>
                <td><?=$item['status'];?></td>
                <td><button type="submit" class="btn btn-success">Выполнил</button></td>
            </tr>
            <? endforeach;?>
            </tbody>
        </table>
    </form>
</div>

</body>
</html>