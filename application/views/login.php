<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=1024">
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <link type="text/css" rel="stylesheet" href="/style/style.css">

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
        <input type="text" name="login">

        <p>Пароль</p>
        <input type="password" name="password"><br>
        <input class="button" type="submit" value="Вход">
    </form>
</div>
</body>
</html>