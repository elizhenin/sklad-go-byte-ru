<?php
$product = $item['product'];
$specifications = $item['specifications'];
$images = $item['images'];
?>
<div class="catalog-element">
    <section class="catalog-element-top">
        <section class="element-title">
            <div class="main-content">
                <div class="element-title-wrapper">
                    <h1><?= $product['name'] ?></h1>
                </div>
            </div>
        </section>
        <div class="main-content">
            <div class="catalog-element-photo col span_4_of_7">
                <ul id="prod-gal">
                        <?php
                        foreach ($images as $image) {
                            ?>
                            <li>
                                <img src="/images/sklad/<?= $image['file'] ?>" alt="<?= $image['alt'] ?>">
                            </li>
                        <?php
                        }
                        ?>
                </ul>
                <script>$(function(){ $('#prod-gal').pikachoose(); });</script>
            </div>
            <div class="catalog-element-buy col span_3_of_7">
                <div class="content-col">
                    <p><?= $product['short_text'] ?></p>
                    <span class="sale-price">
                        <!-- Добавить проверку на наличие. В наличии = класс notnull ; Нет в наличии = класс absolute-null -->
                    <span class="notnull">В наличии</span>
                        <!-- ------ -->
                    <div class="numbers">
                        <span class="old-price">
                            <span class="old-price-value"> <?= $product['other_price'] ?> руб </span>
                        </span>
                            <span class="price"> <?= $product['price'] ?> руб </span>
                    </div>
                        <!-- Добавить проверку на наличие. Классы для кнопок такие же, как в списке товаров -->
                        <?php
                        if($product['id_citys'] == $current_city_id)
                        {
                            ?>
                            <div class="button-buy" onclick="basket_add(<?= $product['id'] ?>);">В корзину</div>
                        <?php
                        }else
                        {
                            ?>
                            <div class="button-preorder" onclick="basket_add(<?= $product['id'] ?>);">Заказать</div>
                        <?php
                        }
                        ?>
                        <!-- ------------- -->
                    </span>
                    <p class="note"><span class="starrequired">*</span>ЦВЕТ И ТОЧНУЮ КОМПЛЕКТАЦИЮ УТОЧНЯЙТЕ ПО ТЕЛЕФОНУ</p>
                    <p class="note"><span class="starrequired">*</span>Доставка <b>от 5000 рублей</b> - БЕСПЛАТНО!</p>
                    <p class="note"><span class="starrequired">*</span>Товар в ограниченном количестве, уточняйте наличие по телефону.</p>
                    <div class="icons-wrapper">
                        <h6>На данный товар распространяется</h6>
                        <img src="/images/warranty.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
<section class="catalog-element-bottom">
    <div class="main-content">
        <div class="catalog-element-description col span_4_of_7">
            <div id="prod-tabs">

                <ul>
                    <li>
                        <a href="#descr">Описание</a>
                    </li>
                    <li>
                        <a href="#tech">Характеристики</a>
                    </li>
                    <li>
                        <a href="#conf">Комплектация</a>
                    </li>
                </ul>


                <div id="descr"><?= htmlspecialchars_decode($product['text']) ?></div>
                <div id="tech">
                    <ul class="techs">
                        <?php
                        foreach($spec_groups as $group){
                            ?>
                            <li class="fst"><h2><?=$group['name']?></h2>
                                <ul class="intechs">
                                    <?php
                                    foreach ($specifications as $one)
                                        if($one['group_id']==$group['id']){
                                            ?>
                                            <li class="snd">
                                                <div class="name"><span><?= $one['name'] ?></span></div>
                                                <div class="value"><?= $one['value'] ?><?= ($one['manual']) ? '<span class="proof">Проверено руками</span>' : '' ?></div>
                                            </li>
                                        <?php
                                        }
                                    ?>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div id="conf"><p><?= $product['complectation'] ?></p></div>

            </div>
        </div>


    </div>

</section>

</div>
