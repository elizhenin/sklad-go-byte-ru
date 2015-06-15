<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=1024">
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <link type="text/css" rel="stylesheet" href="/style/sklad/style.css">
    <script src="/js/sklad/jquery.js"></script>
    <script type="application/javascript">
        $(function () {
            var last_login = "<?=$last?>";
            var logins = [
                <?php
                if (!empty($items))
                    foreach ($items as $one) {
                        ?>
                {id:"<?= $one['id'] ?>", name:"<?= $one['name'] ?>"},
                <?php
                }
            ?>
            ];

            logins.forEach(function(value){
                    tmp = '<option value="'+value.id+'"';
                    if(value.name == last_login) {
                        tmp = tmp +'selected="selected"';
                    }
                    tmp = tmp +'>'+value.name+'</option>';
                    $("select").append($(tmp));
                }
            );
        });
    </script>
    <title>Авторизация</title>
</head>
<body class="login">
<div class="wrap">
    <h1>Склад</h1>
    <?php if (!empty($error)) { ?>
        <p class="error">Ошибка авторизации</p>
    <?php } ?>
    <form method="post">
        <div class="log">
        <span>Логин</span>
        <select name="id">

        </select>
        </div>
        <div class="clr"></div>
        <div class="pas">
        <span>Пароль</span>
        <input type="password" name="password" autofocus="autofocus">
        </div>
        <input class="button" type="submit" value="Вход">
    </form>
</div>

</body>
</html>