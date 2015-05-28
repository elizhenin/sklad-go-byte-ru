<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=1024">
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <link type="text/css" rel="stylesheet" href="/style/sklad/style.css">
    <link type="text/css" rel="stylesheet" href="/style/sklad/menu.css">
    <link type="text/css" rel="stylesheet" href="/style/sklad/icons.css">
    <link type="text/css" rel="stylesheet" href="/js/sklad/redactor/redactor.css">

    <script src="/js/sklad/jquery.js"></script>
    <script src="/js/sklad/redactor/redactor.min.js"></script>
    <script src="/js/sklad/redactor/lang/ru.js"></script>
    <script src="/js/sklad/manager.js"></script>
    <script>
        $(function(){
            $('.redactor').redactor({
                lang: 'ru',
                convertDivs: false,
                deniedTags: ['html', 'head', 'body', 'meta', 'applet'],
                minHeight: 400,
                imageUpload: '/ajax/imageUpload',
                toolbarFixedBox: true,
                removeEmpty: ['strong', 'em', 'span', 'p']
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            $('.shid').click(function(e) {
                $('.submenu').toggle(200, function(){
                    $('.wrap').toggleClass("newmarg");
                });
            });
            event.stopPropagation();
        })
    </script>
    <title><?$title?></title>
</head>
<body>
<div class="topmenu">
    <div class="shid">
        Скрыть\Показать
    </div>
    <?=$topmenu?>
</div>
<div class="menu">
    <?=$menu?>
</div>
<div class="submenu">
    <?=(!empty($submenu))?$submenu:''?>
</div>
<div class="wrap">
    <?= $content ?>
    <div class="statusbar">
        <?= $status ?>
    </div>
</div>

</body>
</html>