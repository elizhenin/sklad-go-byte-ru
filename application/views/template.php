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
    <link type="text/css" rel="stylesheet" href="/style/general.css">
    <link type="text/css" rel="stylesheet" href="/js/paralax/paralax.css">
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
//НАЧАЛО

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
                                    <li><a href="/about/howto/">Контакты</a></li>
                                    <li><a href="/about/howto/corporate.php">Корпоративный отдел</a></li>
                                    <li><a href="/about/delivery/">Помощь покупателю</a></li>
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
                            <li class="active-city"><a href="/">Воронеж</a>
                                <ul class="sub-cities">
                                    <li><a href="http://lipetsk.go-byte.ru/">Липецк</a></li>
                                    <li><a href="http://blg.go-byte.ru/">Белгород</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
                <nav class="main-menu">
                    <ul id="horizontal-multilevel-menu">
                        <li><a href="/userpages/others.php" class="root-item">Наличие++</a></li>
                        <li><a href="/catalog/laptops_tablets/" class="root-item">Ноутбуки</a></li>
                        <li class="item-1"><a href="/catalog/tablets/" class="root-item">Планшеты </a>
                            <ul>
                                <li><a href="/catalog/books/">Книги</a></li>
                                <li><a href="/catalog/tablet_pc/">Планшеты</a></li>
                            </ul>
                        </li>
                        <li class="item-2"><a href="/catalog/smartphones_and_cellphones/" class="root-item">Телефоны</a>
                            <ul>
                                <li><a href="/catalog/smartphones/">Смартфоны</a></li>
                                <li><a href="/catalog/mobile_phones/">Мобильные телефоны</a></li>
                            </ul>
                        </li>
                        <li class="item-3"><a href="/catalog/photo/" class="root-item">Фототехника</a>
                            <ul>
                                <li><a href="/catalog/slr_cameras/">Зеркальные фотоаппараты</a></li>
                                <li><a href="/catalog/compact_cameras/">Компактные фотоаппараты</a></li>
                                <li><a href="/catalog/ultrazoom_cameras/">Ультразум фотоаппараты</a></li>
                                <li><a href="/catalog/lenses/">Объективы</a></li>
                            </ul>
                        </li>
                        <li class="item-4"><a href="/catalog/auto/" class="root-item">Авто</a>
                            <ul>
                                <li><a href="/catalog/dvrs/">Видеорегистраторы</a></li>
                                <li><a href="/catalog/radar_detectors/">Радар-детекторы</a></li>
                                <li><a href="/catalog/navigators/">Навигаторы</a></li>
                            </ul>
                        </li>
                        <li><a href="/catalog/game_consoles/" class="root-item">Игровые приставки</a></li>
                    </ul>
                    <div class="menu-clear-left"></div>
                </nav>
            </div>
            <!-- main-content -->
            <div class="background-shadow-bottom"></div>
        </div>
    </section>
    <!-- header-menu -->

    <!-- -------------------------------------------------------- -->

    <section id="header-promo">
        <div id="da-slider" class="da-slider">
            <div class="da-slide slide-4 da-slide-current">
                <div class="slide4-wrapper">
                    <div class="rightText">
                        <h3>Нас уже больше 30000 человек</h3>

                        <p>Нам доверяют, <a href="http://vk.com/topic-43410877_27364881" target="_blank">нас
                                благодарят</a> за возможность купить крутые гаджеты по доступной цене!</p>

                        <h2>СПАСИБО ВАМ!</h2>
                    </div>
                    <a href="http://vk.com/gobyte" target="_blank"><img class="vk-widget plax"
                                                                        src="/images/promo/slide4/vk.png"
                                                                        data-xrange="20" data-yrange="0"
                                                                        style="top: 0px; left: 50.4624277456647px;"></a>
                    <img class="soldier-1 plax" src="/images/promo/slide4/1.png"
                         data-xrange="50" data-yrange="50" style="top: 94.2045454545455px; left: 96.1560693641619px;">
                    <img class="soldier-2 plax" src="/images/promo/slide4/2.png"
                         data-xrange="20" data-yrange="20" style="top: 299.681818181818px; left: 110.462427745665px;">
                    <img class="soldier-3 plax" src="/images/promo/slide4/3.png"
                         data-xrange="80" data-yrange="40" style="top: 359.363636363636px; left: 297.849710982659px;">
                    <img class="soldier-4 plax" src="/images/promo/slide4/4.png"
                         data-xrange="180" data-yrange="100" style="top: 118.409090909091px; left: 430.161849710983px;">
                    <img class="soldier-5 plax" src="/images/promo/slide4/5.png"
                         data-xrange="140" data-yrange="70" style="top: 323.886363636364px; left: 449.236994219653px;">
                </div>
            </div>
            <div class="da-slide slide-2">
                <h3 class="da-discount discount-title">Скидки!!!</h3>
                <img class="da-discount discount-1" src="/images/promo/slide2/1.png"
                     alt=""> <img class="da-discount discount-2"
                                  src="/images/promo/slide2/2.png" alt=""> <img
                    class="da-discount discount-3" src="/images/promo/slide2/3.png"
                    alt=""> <img class="da-discount discount-4"
                                 src="/images/promo/slide2/4.png" alt=""></div>
            <nav class="da-arrows"><span class="da-arrows-prev"></span> <span class="da-arrows-next"></span></nav>
            <nav class="da-dots"><span class="da-dots-current"></span><span></span></nav>
        </div>
        <div class="preorder-form-wrap" style="display: none;">
            <div class="preorder-close"></div>
            <form class="preorder-form" name="preorder" method="POST" action="/preorder/make_preorder_ajax.php">
                <h2>Оформление предзаказа</h2>
                <input type="hidden" name="ID" value="0">
                <input type="hidden" name="CITY" value="41">

                <p>
                    <label for="NAME">Ваше имя</label>
                    <input type="text" name="NAME" value="">
                </p>

                <p>
                    <label for="PHONE">Телефон</label>
                    <input type="text" name="PHONE" value="">
                </p>

                <p>
                    <label for="EMAIL">Email</label>
                    <input type="email" name="EMAIL" value="">
                </p>

                <p>
                    <input type="submit" name="PREORDER" value="Бронировать">
                </p>
            </form>
            <div class="success-message" style="display:none;">
                <h3>Ваш заказ отправлен.</h3>

                <p>Мы свяжемся с Вами после поступления товара.</p>
            </div>
            <p class="invalid" style="display:none;">Заполните все поля</p>
        </div>
    </section>
    <!-- header-promo -->

    <section id="headshot">
        <div class="main-content">
            <h3 class="default">на все товары</h3>

            <h2>мы предоставляем гарантию</h2>
        </div>
        <!-- main-content -->
    </section>
    <div class="add-to-cart-message hide"><span>Товар добавлен в корзину!</span> <span> Оформить заказ? <a
                class="make-order-yes" href="/personal/order/make/">Да</a> <a href=""
                                                                              class="add-to-cart-no">Нет</a> </span>
    </div>
</header>
<section id="workarea">
<div class="main-content">
<div class="catalog new col span_1_of_3">
    <div class="catalog-item-wrapper">
        <h5><span class="ie8hack"></span> <span class="bg_before"><span class="ie8hack"></span></span> <span
                class="bg_after"></span></h5>

        <div class="catalog-item ">
            <div class="item-image"><a class="link" href="/catalog/smartphones/apple_iphone_6_plus_64gb/"><img
                        class="item_img" itemprop="image"
                        src="/upload/resize_cache/iblock/10b/75_75_16a9cdfeb475445909b854c588a1af844/10b9f74c716e789fe199713b4b3b039b.png"
                        width="75" alt=""></a></div>
            <div class="item-info">
                <p class="item-title"><a href="/catalog/smartphones/apple_iphone_6_plus_64gb/"><span itemprop="name">Apple iPhone 6 Plus 64Gb</span></a>
                </p>

                <div class="item-price">
                    <div class="old-price-wrapper"><span class="old-price">76 000 руб</span></div>
                    <div class="sale-price-wrapper"><span class="sale-price"> 49 900 руб </span></div>
                </div>
                <a class="button-buy" href="/index.php?action=ADD2BASKET&amp;id=2586" id="2586">Купить</a>

                <div style="clear:both"></div>
            </div>
            <!--  item-info -->
        </div>
        <!-- catalog-item -->

        <div class="catalog-item ">
            <div class="item-image"><a class="link"
                                       href="/catalog/laptops_tablets/apple_macbook_air_13_early_2014_md761ru_b/"><img
                        class="item_img" itemprop="image"
                        src="/upload/resize_cache/iblock/b84/75_75_16a9cdfeb475445909b854c588a1af844/b84361dc174e9e8c74970f1a4dc1752b.png"
                        width="75" alt=""></a></div>
            <div class="item-info">
                <p class="item-title"><a
                        href="/catalog/laptops_tablets/apple_macbook_air_13_early_2014_md761ru_b/"><span
                            itemprop="name">Apple MacBook Air 13 Early 2014 MD761RU/B</span></a></p>

                <div class="item-price">
                    <div class="old-price-wrapper"><span class="old-price">65 000 руб</span></div>
                    <div class="sale-price-wrapper"><span class="sale-price"> 49 900 руб </span></div>
                </div>
                <a class="button-buy" href="/index.php?action=ADD2BASKET&amp;id=2519" id="2519">Купить</a>

                <div style="clear:both"></div>
            </div>
            <!--  item-info -->
        </div>
        <!-- catalog-item -->

        <div class="catalog-item ">
            <div class="item-image"><a class="link"
                                       href="/catalog/laptops_tablets/iru_c1501b_i7_4700mq_8gb_1tb_hd4600_15_6/"><img
                        class="item_img" itemprop="image"
                        src="/upload/resize_cache/iblock/1f5/75_75_16a9cdfeb475445909b854c588a1af844/1f5ab62cd12d206caac7b979eae09e4f.png"
                        width="75" alt=""></a></div>
            <div class="item-info">
                <p class="item-title"><a href="/catalog/laptops_tablets/iru_c1501b_i7_4700mq_8gb_1tb_hd4600_15_6/"><span
                            itemprop="name">IRU C1501B I7-4700MQ/8GB/1TB/HD4600/15,6"</span></a></p>

                <div class="item-price">
                    <div class="old-price-wrapper"><span class="old-price">30 000 руб</span></div>
                    <div class="sale-price-wrapper"><span class="sale-price"> 24 900 руб </span></div>
                </div>
                <a class="button-buy" href="/index.php?action=ADD2BASKET&amp;id=2597" id="2597">Купить</a>

                <div style="clear:both"></div>
            </div>
            <!--  item-info -->
        </div>
        <!-- catalog-item -->

        <div class="catalog-item  last-item">
            <div class="item-image"><a class="link" href="/catalog/laptops_tablets/dell_inspiron_3737/"><img
                        class="item_img" itemprop="image"
                        src="/upload/resize_cache/iblock/9e0/75_75_16a9cdfeb475445909b854c588a1af844/9e0d285cb207578fe8f92c63f74b5359.png"
                        width="75" alt=""></a></div>
            <div class="item-info">
                <p class="item-title"><a href="/catalog/laptops_tablets/dell_inspiron_3737/"><span itemprop="name">Dell Inspiron 3737</span></a>
                </p>

                <div class="item-price">
                    <div class="old-price-wrapper"><span class="old-price">28 000 руб</span></div>
                    <div class="sale-price-wrapper"><span class="sale-price"> 24 900 руб </span></div>
                </div>
                <a class="button-buy" href="/index.php?action=ADD2BASKET&amp;id=2108" id="2108">Купить</a>

                <div style="clear:both"></div>
            </div>
            <!--  item-info -->
        </div>
        <!-- catalog-item -->
    </div>
    <!-- catalog-item-wrapper -->
</div>
<!-- catalog -->

<div class="catalog leader col span_1_of_3"><span class="ie8hack_left"></span>
    <h5><span class="ie8hack"></span></h5>

    <div class="catalog-item-wrapper">
        <div class="catalog-item ">
            <div class="item-image"><a class="link" href="/catalog/smartphones/samsung_i9505_galaxy_s4/"><img
                        class="item_img" itemprop="image"
                        src="/upload/resize_cache/iblock/da8/75_75_16a9cdfeb475445909b854c588a1af844/da8f05a38783730b15b2c79821347c93.png"
                        width="75" alt=""></a></div>
            <div class="item-info">
                <p class="item-title"><a href="/catalog/smartphones/samsung_i9505_galaxy_s4/"><span itemprop="name">Samsung I9505 Galaxy S4</span></a>
                </p>

                <div class="item-price">
                    <div class="old-price-wrapper"><span class="old-price">21 990 руб</span></div>
                    <div class="sale-price-wrapper"><span class="sale-price"> 15 500 руб </span></div>
                </div>
                <a class="button-buy" href="/index.php?action=ADD2BASKET&amp;id=1886" id="1886">Купить</a>

                <div style="clear:both"></div>
            </div>
            <!--  item-info -->
        </div>
        <!-- catalog-item -->

        <div class="catalog-item ">
            <div class="item-image"><a class="link" href="/catalog/smartphones/sony_xperia_z_ultra/"><img
                        class="item_img" itemprop="image"
                        src="/upload/resize_cache/iblock/a62/75_75_16a9cdfeb475445909b854c588a1af844/a629babcadd374398d6858843f644426.png"
                        width="75" alt=""></a></div>
            <div class="item-info">
                <p class="item-title"><a href="/catalog/smartphones/sony_xperia_z_ultra/"><span itemprop="name">Sony Xperia Z Ultra</span></a>
                </p>

                <div class="item-price">
                    <div class="old-price-wrapper"><span class="old-price">20 000 руб</span></div>
                    <div class="sale-price-wrapper"><span class="sale-price"> 13 900 руб </span></div>
                </div>
                <a class="button-buy" href="/index.php?action=ADD2BASKET&amp;id=1718" id="1718">Купить</a>

                <div style="clear:both"></div>
            </div>
            <!--  item-info -->
        </div>
        <!-- catalog-item -->

        <div class="catalog-item ">
            <div class="item-image"><a class="link" href="/catalog/smartphones/sony_xperia_z/"><img class="item_img"
                                                                                                    itemprop="image"
                                                                                                    src="/upload/resize_cache/iblock/2b7/75_75_16a9cdfeb475445909b854c588a1af844/2b74a270e37f1a03566fa84e15f6e878.png"
                                                                                                    width="52"
                                                                                                    alt=""></a></div>
            <div class="item-info">
                <p class="item-title"><a href="/catalog/smartphones/sony_xperia_z/"><span
                            itemprop="name">SONY Xperia Z</span></a></p>

                <div class="item-price">
                    <div class="old-price-wrapper"><span class="old-price">14 490 руб</span></div>
                    <div class="sale-price-wrapper"><span class="sale-price"> 12 900 руб </span></div>
                </div>
                <a class="button-buy" href="/index.php?action=ADD2BASKET&amp;id=443" id="443">Купить</a>

                <div style="clear:both"></div>
            </div>
            <!--  item-info -->
        </div>
        <!-- catalog-item -->

        <div class="catalog-item  last-item">
            <div class="item-image"><a class="link" href="/catalog/smartphones/sony_xperia_m2/"><img class="item_img"
                                                                                                     itemprop="image"
                                                                                                     src="/upload/resize_cache/iblock/712/75_75_16a9cdfeb475445909b854c588a1af844/7120dfc6c1774f2993c596c245f1eabc.png"
                                                                                                     width="75" alt=""></a>
            </div>
            <div class="item-info">
                <p class="item-title"><a href="/catalog/smartphones/sony_xperia_m2/"><span itemprop="name">SONY Xperia M2</span></a>
                </p>

                <div class="item-price">
                    <div class="old-price-wrapper"><span class="old-price">12 000 руб</span></div>
                    <div class="sale-price-wrapper"><span class="sale-price"> 9 900 руб </span></div>
                </div>
                <a class="button-buy" href="/index.php?action=ADD2BASKET&amp;id=2173" id="2173">Купить</a>

                <div style="clear:both"></div>
            </div>
            <!--  item-info -->
        </div>
        <!-- catalog-item -->
    </div>
    <!-- catalog-item-wrapper -->
</div>
<!-- catalog -->

<div class="catalog special col span_1_of_3">
    <div class="catalog-item-wrapper">
        <h5><span class="ie8hack"></span> <span class="bg_before"></span> <span class="bg_after"><span
                    class="ie8hack"></span></span></h5>

        <div class="catalog-item ">
            <div class="item-image"><a class="link" href="/catalog/smartphones/iphone_6_128gb/"><img class="item_img"
                                                                                                     itemprop="image"
                                                                                                     src="/upload/resize_cache/iblock/180/75_75_16a9cdfeb475445909b854c588a1af844/1800f19650b4b0388fe3e268d395a0e0.png"
                                                                                                     width="75" alt=""></a>
            </div>
            <div class="item-info">
                <p class="item-title"><a href="/catalog/smartphones/iphone_6_128gb/"><span itemprop="name">iPhone 6 128GB</span></a>
                </p>

                <div class="item-price">
                    <div class="old-price-wrapper"><span class="old-price">65 000 руб</span></div>
                    <div class="sale-price-wrapper"><span class="sale-price"> 49 900 руб </span></div>
                </div>
                <a class="button-buy" href="/index.php?action=ADD2BASKET&amp;id=2584" id="2584">Купить</a>

                <div style="clear:both"></div>
            </div>
            <!--  item-info -->
        </div>
        <!-- catalog-item -->

        <div class="catalog-item ">
            <div class="item-image"><a class="link" href="/catalog/smartphones/iphone_6_16gb/"><img class="item_img"
                                                                                                    itemprop="image"
                                                                                                    src="/upload/resize_cache/iblock/e9a/75_75_16a9cdfeb475445909b854c588a1af844/e9abc05b21c6b369b4d4b02595d2006b.png"
                                                                                                    width="75"
                                                                                                    alt=""></a></div>
            <div class="item-info">
                <p class="item-title"><a href="/catalog/smartphones/iphone_6_16gb/"><span
                            itemprop="name">iPhone 6 16GB</span></a></p>

                <div class="item-price">
                    <div class="old-price-wrapper"><span class="old-price">49 000 руб</span></div>
                    <div class="sale-price-wrapper"><span class="sale-price"> 39 900 руб </span></div>
                </div>
                <a class="button-buy" href="/index.php?action=ADD2BASKET&amp;id=2583" id="2583">Купить</a>

                <div style="clear:both"></div>
            </div>
            <!--  item-info -->
        </div>
        <!-- catalog-item -->

        <div class="catalog-item ">
            <div class="item-image"><a class="link" href="/catalog/smartphones/sony_xperia_z3_compact/"><img
                        class="item_img" itemprop="image"
                        src="/upload/resize_cache/iblock/1d1/75_75_16a9cdfeb475445909b854c588a1af844/1d1c23b18fac0e4f5fd788d2bbd10b5a.png"
                        width="75" alt=""></a></div>
            <div class="item-info">
                <p class="item-title"><a href="/catalog/smartphones/sony_xperia_z3_compact/"><span itemprop="name">Sony Xperia Z3 Compact</span></a>
                </p>

                <div class="item-price">
                    <div class="old-price-wrapper"><span class="old-price">30 000 руб</span></div>
                    <div class="sale-price-wrapper"><span class="sale-price"> 22 900 руб </span></div>
                </div>
                <a class="button-buy" href="/index.php?action=ADD2BASKET&amp;id=2142" id="2142">Купить</a>

                <div style="clear:both"></div>
            </div>
            <!--  item-info -->
        </div>
        <!-- catalog-item -->

        <div class="catalog-item  last-item">
            <div class="item-image"><a class="link" href="/catalog/tablet_pc/samsung_galaxy_tab_pro_8_4_lte/"><img
                        class="item_img" itemprop="image"
                        src="/upload/resize_cache/iblock/92d/75_75_16a9cdfeb475445909b854c588a1af844/92d9cf102cee03faeea2be4b47c2938c.png"
                        width="75" alt=""></a></div>
            <div class="item-info">
                <p class="item-title"><a href="/catalog/tablet_pc/samsung_galaxy_tab_pro_8_4_lte/"><span
                            itemprop="name">Samsung Galaxy Tab Pro 8.4 LTE T325 </span></a></p>

                <div class="item-price">
                    <div class="old-price-wrapper"><span class="old-price">20 000 руб</span></div>
                    <div class="sale-price-wrapper"><span class="sale-price"> 16 500 руб </span></div>
                </div>
                <a class="button-buy" href="/index.php?action=ADD2BASKET&amp;id=2308" id="2308">Купить</a>

                <div style="clear:both"></div>
            </div>
            <!--  item-info -->
        </div>
        <!-- catalog-item -->
    </div>
    <!-- catalog-item-wrapper -->
</div>
<!-- catalog -->

</div>
<!-- main-content -->
</section>
<!-- workarea -->

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
    <nav class="footer-menu"><a class="copyright" href="http://gowhiterabbit.ru/" target="_blank"></a>

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


//КОНЕЦ
<div class="choto">
    Город:
    <div class="city-button">
        <span><?= (!empty($ActiveCity)) ? $ActiveCity['name'] : '' ?></span>
    </div>


    <?= (!empty($page)) ? $page : '' ?>


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
</div>
</body>
</html>