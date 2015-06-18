<!DOCTYPE HTML>
<html>
<head>
    <meta name="keywords" content="<?= (!empty($keywords)) ? $keywords : '' ?>"/>
    <meta name="description" content="<?= (!empty($description)) ? $description : '' ?>"/>
    <title><?= (!empty($title)) ? $title : '' ?></title>

    <script src="/js/jquery.js"></script>
    <script src="/js/jquery-ui.js"></script>
    <script src="/js/jquery.magnific-popup.min.js"></script>
    <script src="/js/jquery.liColl.js"></script>
    <script src="/js/main.js"></script>
    <script src="/js/plugins.js"></script>


    <link type="text/css" rel="stylesheet" href="/style/magnific-popup.css">
    <link type="text/css" rel="stylesheet" href="/style/fancybox.css">
    <link type="text/css" rel="stylesheet" href="/style/general.css">
    <link type="text/css" rel="stylesheet" href="/js/paralax/paralax.css">
    <link href='http://fonts.googleapis.com/css?family=Play:700|Poiret+One|Open+Sans:300&subset=cyrillic,latin' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Didact+Gothic&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Lobster&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed:300&subset=latin,cyrillic' rel='stylesheet' type='text/css'>
    <script>
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
<div id="wrapper">
<header id="header">
    <section id="header-top">
        <div class="main-content">
            <div class="logo col span_1_of_3"><a href="/" title=""> <span class="halflogo"></span> <img
                        src="/images/logo.png"> </a></div>
            <div class="basket col span_1_of_3"> <span class="cart_line">
          <div class="sale-basket-small">
              <div class="basket-small-header">
                  <div class="basket-icon empty"></div>
                  <a class="your-cart" href="/personal/cart/">Корзина</a> <span class="basket-small-dropdown"></span>

                  <div class="to-cart" href="/personal/cart/"><span class="total-count">пуста</span> <span
                          class="total-sum-text">на сумму </span> <span class="total-sum">0 руб</span></div>
              </div>
              <div class="basket-small-body">
                  <table class="basket-small-table">
                      <tbody>
                      <tr>
                          <td><h3>Ваша корзина пуста</h3></td>
                          <td></td>
                      </tr>
                      <tr></tr>
                      </tbody>
                  </table>
                  <a class="make-order-yes" href="/personal/order/make/">Оформить заказ</a></div>
              <!-- basket-small-body -->

          </div>
          <!-- sale-basket-small --> </span></div>
            <div class="user-menu col span_1_of_3">
                <nav id="cart">
                    <div class="block-content">
                        <p class="auth"></p>
                        <ul class="help-menu-links">
                            <li><a href="/login/?backurl=%2F">Войти на сайт</a></li>
                            <li><a href="/login/?register=yes&amp;backurl=%2Findex.php">Зарегистрироваться</a></li>
                            <li class="dropdown"><a href="#">Помощь</a> <img src="/images/downarrow.png">
                                <ul class="sub-menu">
                                    <li><a href="/contacts">Контакты</a></li>
                                    <li><a href="/">Корпоративный отдел</a></li>
                                    <li><a href="/">Помощь покупателю</a></li>
                                </ul>
                            </li>
                        </ul>
                        <p></p>
                    </div>
                    <div class="corners">
                        <div class="corner left-bottom"></div>
                        <div class="corner right-bottom"></div>
                    </div>
                </nav>
            </div>
            <!-- user-menu -->
        </div>
        <!-- main-content -->
    </section>
    <!-- header-top -->

    <section class="tolanding" style="right: -100%;">
        <h2><a href="/landing/" target="_blank">Что такое дисконт?</a></h2>
    </section>

    <!-- -------------------------------------------------------- -->
    <section id="header-menu">
        <div id="header-menu-wrapper">
            <div class="main-content">
                <div class="menu-left">
                    <div class="phone-number"><img src="/images/phone_icon.png"> 8 (473) 200-10-95</div>
                    <div class="cities">
                        <ul>
                            <li class="active-city"><a href="/"><?= (!empty($ActiveCity)) ? $ActiveCity['name'] : '' ?></a>
                                <ul class="sub-cities">
                                    <?php foreach ($CitysList as $city) { ?>
                                        <li>
                        <a href="/" <?= $city['name'] == $ActiveCity['name'] ? 'class="active"' : 'onclick="selectCity(' . $city['id'] . ')"' ?>>
                            <?= $city['name'] ?>
                        </a>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <nav class="main-menu">
                    <ul id="horizontal-multilevel-menu">
                        <li><a href="/userpages/others.php" class="root-item">Наличие++</a></li>
                        <?=Goodies::ShowCatalogMenu($menu,'/catalog',true)?>
                        </ul>
                    <ul>
                    <div class="menu-clear-left"></div>
                </nav>
            </div>
            <!-- main-content -->
            <div class="background-shadow-bottom"></div>
        </div>
    </section>
    <!-- header-menu -->




</header>
<?=(!empty($tpl_head))?$tpl_head:''?>

<div class="add-to-cart-message hide"><span>Товар добавлен в корзину!</span> <span> Оформить заказ? <a
            class="make-order-yes" href="/personal/order/make/">Да</a> <a href=""
                                                                          class="add-to-cart-no">Нет</a> </span>
</div>
<section id="workarea">
        <?= (!empty($page)) ? $page : '' ?>
</section>
<footer id="footer">
    <div class="headshot">
        <div class="main-content">
            <h3>товар, представленный на данном сайте</h3>

            <h2>проверен на работоспособность</h2>
        </div>
        <!-- main-content -->
    </div>
    <div class="footer-social-links">
        <div class="main-content">
            <div><a class="tw" rel="nofollow"></a> <a class="vk" href="http://vk.com/gobyte" target="_blank"
                                                      rel="nofollow"></a> <a class="fb"
                                                                             href="http://www.facebook.com/IronBuy"
                                                                             target="_blank" rel="nofollow"></a></div>
        </div>
        <!-- main-content -->
    </div>
    <nav class="footer-menu">

        <div class="main-content">
            <div class="col span_1_of_2">
                <div class="left-menu">
                    <ul>
                        <li><a href="/about/howto/">Контакты</a></li>
                        <li><a href="/about/delivery/">Помощь покупателю</a></li>
                        <li><a href="http://vk.com/topic-43410877_27364881" target="_blank">Оставить отзыв</a></li>
                        <li><a href="/distributors/">Поставщикам</a></li>
                    </ul>
                </div>
            </div>
            <div class="col span_1_of_2 right-menu">
                <ul class="store-horizontal">
                    <li><a href="/userpages/others.php">Наличие++</a></li>
                    <li><a href="/catalog/laptops_tablets/">Ноутбуки</a></li>
                    <li><a href="/catalog/tablets/">Планшеты </a></li>
                    <li><a href="/catalog/smartphones_and_cellphones/">Телефоны</a></li>
                    <li><a href="/catalog/photo/">Фототехника</a></li>
                    <li><a href="/catalog/auto/">Авто</a></li>
                    <li><a href="/catalog/game_consoles/">Игровые приставки</a></li>
                </ul>
            </div>
        </div>
        <!-- main-content -->
    </nav>
</footer>
</div>
</body>
</html>