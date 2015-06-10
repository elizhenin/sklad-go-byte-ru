<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=1024">
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <link type="text/css" rel="stylesheet" href="/style/sklad/style.css">

    <title>Авторизация</title>
</head>
<body class="login">
<div class="wrap">
    <h1>Склад</h1>
    <?php if (!empty($error)) { ?>
        <p class="error">Ошибка авторизации</p>
    <?php } ?>
    <form method="post">
        <p>Логин</p>
        <select name="id">
            <?php
            if (!empty($items))
                foreach ($items as $one) {
                    ?>
                    <option value="<?=$one['id']?>" <?=($last == $one['id'])?'selected="selected"':''?>><?=$one['name']?></option>
                <?php
                }
            ?>
        </select>

        <p>Пароль</p>
        <input type="password" name="password" autofocus="autofocus"><br>
        <input class="button" type="submit" value="Вход">
    </form>
</div>
</body>
</html>