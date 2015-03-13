<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=1024">
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <link type="text/css" rel="stylesheet" href="/style/style.css">
    <link type="text/css" rel="stylesheet" href="/style/magnific-popup.css">
    <link type="text/css" rel="stylesheet" href="/js/redactor/redactor.css">

    <script src="/js/jquery.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/redactor/redactor.min.js"></script>
    <script src="/js/redactor/lang/ru.js"></script>
    <script src="/js/manager.js"></script>
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
            $( "#datepicker" ).datepicker({ dateFormat: "dd-mm-yy" });
        });
    </script>
    <title><?$title?></title>
</head>
<body>
<div class="right">
    <h2><?=$title?></h2>
    <?=$menu?>
</div>
<div class="wrap">
    <?= $content ?>
</div>
<div class="top">
    <ul>
        <li>
            <a href="/" target="_blank">Открыть сайт</a>
        </li>
        <li>
            <a href="/sklad/logout">Выход</a>
        </li>
    </ul>
</div>
</body>
</html>