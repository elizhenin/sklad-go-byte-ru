<div class="main-content">
    <h1><?php
        if (!empty($alias)) {
            ?>
            <form name="form_back" method="GET" style="float:left"
                  action="/catalog/<?= substr($alias, 0, strrpos($alias, '/')) ?>">
                <input type="submit" value="<- Назад"/>
            </form>
        <?php } ?> / <?= (empty($name)) ? '' : $name ?></h1>

    <ul style="display: inline-block">
        <?php
        if (!empty($items['categories']))
            foreach ($items['categories'] as $item) {
                ?>
                <li style="display: inline-block">
                    <a href="/catalog/<?= $alias ?><?= (empty($alias)) ? '' : '/' ?><?= $item['alias'] ?>"><?= $item['menu'] ?></a>
                </li>
            <?php } ?>
    </ul>
    <td>

        <h2>Модели этой категории</h2>
        <table style="width:100%">
            <thead style="background-color: dimgray">
            <td></td>
            <td>Код</td>
            <td>Название</td>
            <td>Цена</td>
            </thead>
            <tbody>
            <?php
            if (!empty($items['models'])) {
                foreach ($items['models'] as $item) {
                    ?>
                    <tr>
                        <td><?= $item['sku'] ?></td>
                        <td><?= $item['name'] ?></td>
                        <td><?= $item['price'] ?></td>
                    </tr>
                <?php
                }
            }
            ?>
            </tbody>
        </table>


        <div class="breadcrumb">
            <ul>
                <li><a href="/catalog/" title="Все разделы">Все разделы</a></li>
                <li class="breadcrumb-arrow"></li>
                <li><a href="/catalog/laptops_tablets/" title="Ноутбуки">Ноутбуки</a></li>
            </ul>
        </div>

        <div class="catalog-switch"><a href="												http://www.go-byte.ru/catalog/
											">В наличии</a> <a> | </a> <a href="												http://www.go-byte.ru/userpages/others.php
											">Прочие товары</a> <a> | </a> <a href="												http://www.go-byte.ru/userpages/futuredelivery.php
											">Будущие поставки</a> <a> | </a> <a
                href="http://www.go-byte.ru/userpages/chocobox.php">Шоколадная коробка</a>
        </div>
        <div class="catalog-item-sorting">
            <label>Сортировать по:</label>
            <a href="/" class="selected asc" rel="nofollow">названию</a>
            <a href="/" rel="nofollow">цене</a>
            <a href="/" rel="nofollow">новизне</a>
        </div>
        <div class="catalog-item-list">
            <div class="catalog-item">
                <div class="catalog-item-info">
                    <div class="catalog-item-image col span_2_of_12">
                        <a href="/catalog/laptops_tablets/apple_macbook_air_13_early_2014_md761ru_b/">
                            <img
                                src="/upload/resize_cache/iblock/b84/180_180_16a9cdfeb475445909b854c588a1af844/b84361dc174e9e8c74970f1a4dc1752b.png"
                                width="180" height="180"
                                alt="Apple MacBook Air 13 Early 2014 MD761RU/B"
                                title="Apple MacBook Air 13 Early 2014 MD761RU/B">
                        </a>
                    </div>
                    <div class="catalog-item-desc col span_7_of_12">
                        <div class="catalog-item-title"><a
                                href="/catalog/laptops_tablets/apple_macbook_air_13_early_2014_md761ru_b/">
                                <h2>Apple MacBook Air 13 Early 2014 MD761RU/B</h2>
                            </a></div>
                        <div class="catalog-item-preview-text">
                            <table class="properties" width="100%" cellspacing="1" cellpadding="1" border="0"
                                   style="border-collapse: collapse;">
                                <tbody>
                                <tr>
                                    <td class="name-it">Процессор</td>
                                    <td>Intel® Core™
                                        i5
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-it">Частота
                                        (МГц)
                                    </td>
                                    <td>1400</td>
                                </tr>
                                <tr>
                                    <td class="name-it">Количество
                                        ядер
                                    </td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td class="name-it">Оперативная
                                        память (Мб)
                                    </td>
                                    <td>4096</td>
                                </tr>
                                <tr>
                                    <td class="name-it">Диагональ
                                        дисплея (дюйм)
                                    </td>
                                    <td>13.3</td>
                                </tr>
                                <tr>
                                    <td class="name-it">Разрешение
                                        дисплея
                                    </td>
                                    <td>1440x900</td>
                                </tr>
                                <tr>
                                    <td class="name-it">Видеокарта</td>
                                    <td>Intel® HD Graphics
                                        5000
                                    </td>
                                </tr>
                                <tr>
                                    <td class="name-it">Количество
                                        USB-портов
                                    </td>
                                    <td>2</td>
                                </tr>
                                <tr>
                                    <td class="name-it">ОС</td>
                                    <td>Mac OS
                                        X
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="catalog-item-buy col span_3_of_12">
                        <div class="catalog-item-price clearfix">
                            <div class="numbers"><span class="economy">65000 руб.</span> <span class="sale-price">49 900 руб</span>
                            </div>
                            <form class="form-add-to-cart"
                                  action="/bitrix/urlrewrite.php?SEF_APPLICATION_CUR_PAGE_URL=%2Fcatalog%2Flaptops_tablets%2Findex.php%3Fsort%3Dname%26order%3Dasc"
                                  method="post" enctype="multipart/form-data">
                                <input type="hidden" name="quantity" value="1">
                                <input type="hidden" name="id" value="2519">
                                <input type="hidden" name="action" value="ADD2BASKET">
                                <!-- <input type="submit" name="actionBUY" value="Купить"> -->
                                <input type="submit" name="actionADD2BASKET" value="В корзину">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="catalog-item-separator"></div>
        </div>
        <div class="catalog-section-list">
            <ul>
                <li><a href="/catalog/laptops_tablets/">Ноутбуки</a><sup>(16)</sup></li>
                <li><a href="/catalog/tablets/">Планшеты</a><sup>(16)</sup></li>
                <li><a href="/catalog/books/">Книги</a><sup>(16)</sup></li>
                <li><a href="/catalog/tablet_pc/">Планшеты</a><sup>(16)</sup></li>
                <li><a href="/catalog/smartphones_and_cellphones/">Телефоны</a><sup>(16)</sup></li>
                <li><a href="/catalog/smartphones/">Смартфоны</a><sup>(16)</sup></li>
                <li><a href="/catalog/mobile_phones/">Мобильные телефоны</a><sup>(16)</sup></li>
                <li><a href="/catalog/photo/">Фототехника</a><sup>(16)</sup></li>
                <li><a href="/catalog/slr_cameras/">Зеркальные фотоаппараты</a><sup>(16)</sup></li>
                <li><a href="/catalog/compact_cameras/">Компактные фотоаппараты</a><sup>(16)</sup>
                </li>
                <li><a href="/catalog/ultrazoom_cameras/">Ультразум фотоаппараты</a><sup>(16)</sup>
                </li>
                <li><a href="/catalog/auto/">Авто</a><sup>(16)</sup></li>
                <li><a href="/catalog/dvrs/">Видеорегистраторы</a><sup>(16)</sup></li>
                <li><a href="/catalog/radar_detectors/">Радар-детекторы</a><sup>(16)</sup></li>
                <li><a href="/catalog/navigators/">Навигаторы</a><sup>(16)</sup></li>
                <li><a href="/catalog/game_consoles/">Игровые приставки</a><sup>(16)</sup></li>
            </ul>
        </div>

</div>