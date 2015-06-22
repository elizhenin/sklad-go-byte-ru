<div class="main-content">
    <h1><?php
        if (!empty($alias)) {
            ?>

        <?php } ?> / <?= (empty($name)) ? '' : $name ?></h1>


    <div class="breadcrumb">
        <ul>
            <li><a href="/catalog/" title="Все разделы">Все разделы</a></li>

            <?php
            if (!empty($breadcrumbs))
                foreach (array_reverse($breadcrumbs) as $one) {
                    ?>
                    <li class="breadcrumb-arrow"></li>
                    <li><a href="/catalog/<?= $one['id'] ?>_<?= $one['alias'] ?>"
                           title="<?= $one['name'] ?>"><?= $one['name'] ?></a></li>
                <?php
                }
            ?>
        </ul>
    </div>

    <div class="catalog-switch"><a href="												http://www.go-byte.ru/catalog/
											">В наличии</a> <a> | </a> <a href="												http://www.go-byte.ru/userpages/others.php
											">Прочие товары</a> <a> | </a> <a href="												http://www.go-byte.ru/userpages/futuredelivery.php
											">Будущие поставки</a> <a> | </a> <a
            href="http://www.go-byte.ru/userpages/chocobox.php">Шоколадная коробка</a>
    </div>
<!--    <div class="catalog-item-sorting">-->
<!--        <label>Сортировать по:</label>-->
<!--        <a href="/" class="selected asc" rel="nofollow">названию</a>-->
<!--        <a href="/" rel="nofollow">цене</a>-->
<!--        <a href="/" rel="nofollow">новизне</a>-->
<!--    </div>-->

    <div class="catalog-item-list">
        <?php
        if (!empty($items['models'])) {
            foreach ($items['models'] as $item) {
                ?>
                <div class="catalog-item">
                    <div class="catalog-item-info">
                        <div class="catalog-item-image col span_2_of_12">
                            <a href="/catalog/<?= $item['product']['categorys_id'] ?>_<?= $item['product']['categorys_alias'] ?>/<?= $item['product']['alias'] ?>">
                                <img
                                    src="/images/sklad/<?= (!empty($item['image'])) ? $item['image']['file'] : 'no-image.png' ?>"
                                    width="180" height="180"
                                    alt="<?= (!empty($item['image'])) ? $item['image']['alt'] : $item['product']['alias'] ?>"
                                    title="<?= (!empty($item['product'])) ? $item['product']['name'] : '' ?>">
                            </a>
                        </div>
                        <div class="catalog-item-desc col span_7_of_12">
                            <div class="catalog-item-title"><a
                                    href="/catalog/<?= $item['product']['categorys_id'] ?>_<?= $item['product']['categorys_alias'] ?>/<?= $item['product']['alias'] ?>">
                                    <h2><?= $item['product']['name'] ?></h2>
                                </a></div>
                            <div class="catalog-item-preview-text">
                                <table class="properties" width="100%" cellspacing="1" cellpadding="1" border="0"
                                       style="border-collapse: collapse;">
                                    <tbody>
                                    <?php
                                    if (!empty($item['specifications']))
                                        foreach ($item['specifications'] as $specification) {
                                            ?>
                                            <tr>
                                                <td class="name-it"><?= $specification['name'] ?></td>
                                                <td><?= $specification['value'] ?></td>
                                            </tr>
                                        <?php
                                        }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="catalog-item-buy col span_3_of_12">
                            <div class="catalog-item-price clearfix">
                                <div class="numbers">
                                    <span class="economy"><?= $item['product']['other_price'] ?> руб.</span>
                                    <span class="sale-price"><?= $item['product']['price'] ?> руб.</span>
                                </div>
                                <?php
                                if($item['product']['id_citys'] == $current_city_id)
                                {
                                    ?>
                                    <div class="button-buy" onclick="basket_add(<?= $item['product']['id'] ?>);">В корзину</div>
                                    <?php
                                }else
                                {
                                    ?>
                                    <div class="button-preorder" onclick="basket_add(<?= $item['product']['id'] ?>);">Заказать</div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
        }
        ?>
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