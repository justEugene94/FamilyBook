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
<h4 class="text-center">Регистрация</h4>

<? if(isset($ErrorStatus)): ?>
    <div class="alert alert-danger" role="alert">
        <?=$ErrorStatus;?>
    </div>
<? endif;?>

<div class="container">

    <form  method="post" action="/registry">

        <div class="form-group">

            <div class="form-row">
                <div class="col-md-6">
                    <label for="name">Имя</label>
                    <input type="text" name="name" class="form-control" id="name" placeholder="Введите ваше имя">
                </div>

                <div class="col-md-6">
                    <label class="mr-sm-2" for="family_memder_id">Член семьи</label>
                    <select name="family_member_id" class="custom-select mr-sm-2" id="family_memder_id">

                        <? foreach ($members as $item):?>
                        <option value="<?=$item['id'];?>"><?=$item['member'];?></option>
                        <? endforeach; ?>

                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">

            <div class="form-row">

                <div class="col-md-6">
                    <label for="password">Пароль</label>
                    <input type="password" name="pass" class="form-control" id="password" placeholder="Введите ваш пароль">
                </div>

                <div class="col-md-6">
                    <label for="password">Повторите Пароль</label>
                    <input type="password" name="pass_confirm" class="form-control" id="password" placeholder="Повторите ваш пароль">
                </div>

            </div>

        </div>

        <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
    </form>

</div>
</body>
</html>