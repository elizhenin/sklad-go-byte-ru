<!DOCTYPE HTML>
<html>
<head>
<meta name="keywords" content="<?=(!empty($keywords))?$keywords:''?>" />
<meta name="description" content="<?=(!empty($description))?$description:''?>" />
<title><?=(!empty($title))?$title:''?></title>

    <script src="/js/jquery.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/jquery.liColl.js"></script>
    <link type="text/css" rel="stylesheet" href="/style/magnific-popup.css">
    <script>
        $(function () {
            $('.list_col').liColl({
                c_unit: '%',
                n_coll: 3,
                p_left: 0
            });
        });
        $(document).ready(function () {
            $('.city-button').magnificPopup({
                type: 'inline',
                items: {
                    src: '.city-block'
                },
                mainClass: 'mfp-with-zoom',
                zoom: {
                    enabled: true,
                    duration: 300,
                    easing: 'ease-in-out'
                }
            });
        });
        function selectCity(id) {
            $.post('/ajax/selectCity', {id: id}, function (data) {
                location.reload(true);
            });
        }
    </script>
</head>
<body>
Город:
<div class="city-button">
    <span><?=(!empty($ActiveCity))?$ActiveCity['name']:''?></span>
</div>


<?=(!empty($page))?$page:''?>


<div style="display: none">
    <div class="city-block">
        <h3>Выберите город:</h3>
        <ul class="list_col">
            <?php foreach ($CitysList as $city) { ?>
                <li>
                    <span <?= $city['name'] == $ActiveCity['name'] ? 'class="active"' : 'onclick="selectCity(' . $city['id'] . ')"' ?>>
                        <?= $city['name'] ?>
                    </span>
                </li>
            <?php } ?>
        </ul>
    </div>
</div>
</body>
</html>