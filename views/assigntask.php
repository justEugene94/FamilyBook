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

<? if(isset($done)):?>
    <h4 class="text-center"><?=$done?></h4>
<?else:?>
    <h4 class="text-center">Раздайте задания</h4>
<?endif;?>

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
    <? if(is_array($content)): ?>
        <table class="table">
            <thead class="thead-light">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Имя</th>
                <th scope="col">Задание</th>
                <th scope="col">Статус</th>
                <th scope="col">Назначить</th>
            </tr>
            </thead>
            <tbody>
            <? foreach ($content as $item):?>
                <tr>
                    <form method="post" action="/executors">
                        <th><?=$item['id'];?></th>
                        <td>
                            <select name="family_id" id="family_id">
                                <? foreach ($names as $user) :?>

                                    <option value="<?=$user['id'];?>"><?=$user['name'];?></option>

                                <?endforeach;?>
                            </select>
                        </td>
                        <td><?=$item['task'];?></td>
                        <td><?=$item['status'];?></td>
                        <td>

                                <input type="hidden" name="id" value="<?=$item['id']?>">
                                <button type="submit" class="btn btn-success">Назначить</button>

                        </td>
                    </form>
                </tr>
            <? endforeach;?>

            </tbody>
        </table>
    <?else:?>
        <p align="center"><img  src="/images/man.png"/></p>
        <h3 class="text-center">Все задания назначены</h3>
    <?endif;?>
</div>

</body>
</html>