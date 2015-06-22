<div class="main-content">
<div class="catalog new col span_1_of_3">
    <div class="catalog-item-wrapper">
        <h5><span class="ie8hack"></span> <span class="bg_before"><span class="ie8hack"></span></span> <span
                class="bg_after"></span></h5>
        <?php
        if (!empty($ModelsNew)) {
            foreach ($ModelsNew as $item) {
                ?>
                <div class="catalog-item ">
                    <div class="item-image"><a class="link"
                                               href="/catalog/<?= $item['categorys_id'] ?>_<?= $item['categorys_alias'] ?>/<?= $item['alias'] ?>">
                            <img
                                class="item_img" itemprop="image"
                                src="/images/sklad/<?= (!empty($item['file'])) ? $item['file'] : 'no-image.png' ?>"
                                width="75"
                                alt="<?= (!empty($item['alt'])) ? $item['alt'] : $item['alias'] ?>"
                                title="<?= $item['name'] ?>"
                                ></a></div>
                    <div class="item-info">
                        <p class="item-title"><a
                                href="/catalog/<?= $item['categorys_id'] ?>_<?= $item['categorys_alias'] ?>/<?= $item['alias'] ?>"><span
                                    itemprop="name"><?= $item['name'] ?></span></a>
                        </p>

                        <div class="item-price">
                            <div class="old-price-wrapper"><span
                                    class="old-price"><?= $item['other_price'] ?></span></div>
                            <div class="sale-price-wrapper"><span class="sale-price"> <?= $item['price'] ?>
                                    руб </span></div>
                        </div>

                        <div class="button-buy" onclick="basket_add(<?= $item['id'] ?>);">[Купить]</div>
                        <div style="clear:both"></div>
                    </div>
                    <!--  item-info -->
                </div>
                <!-- catalog-item -->
            <?php
            }
        }
        ?>

        <div class="catalog-item last-item"></div>
        <!-- catalog-item -->
    </div>
    <!-- catalog-item-wrapper -->
</div>
<!-- catalog -->

<div class="catalog leader col span_1_of_3"><span class="ie8hack_left"></span>
    <h5><span class="ie8hack"></span></h5>

    <div class="catalog-item-wrapper">
        <?php
        if (!empty($ModelsLeader)) {
            foreach ($ModelsLeader as $item) {
                ?>
                <div class="catalog-item ">
                    <div class="item-image"><a class="link"
                                               href="/catalog/<?= $item['categorys_id'] ?>_<?= $item['categorys_alias'] ?>/<?= $item['alias'] ?>">
                            <img
                                class="item_img" itemprop="image"
                                src="/images/sklad/<?= (!empty($item['file'])) ? $item['file'] : 'no-image.png' ?>"
                                width="75"
                                alt="<?= (!empty($item['alt'])) ? $item['alt'] : $item['alias'] ?>"
                                title="<?= $item['name'] ?>"
                                ></a></div>
                    <div class="item-info">
                        <p class="item-title"><a
                                href="/catalog/<?= $item['categorys_id'] ?>_<?= $item['categorys_alias'] ?>/<?= $item['alias'] ?>"><span
                                    itemprop="name"><?= $item['name'] ?></span></a>
                        </p>

                        <div class="item-price">
                            <div class="old-price-wrapper"><span
                                    class="old-price"><?= $item['other_price'] ?></span></div>
                            <div class="sale-price-wrapper"><span class="sale-price"> <?= $item['price'] ?>
                                    руб </span></div>
                        </div>

                        <div class="button-buy" onclick="basket_add(<?= $item['id'] ?>);">[Купить]</div>
                        <div style="clear:both"></div>
                    </div>
                    <!--  item-info -->
                </div>
                <!-- catalog-item -->
            <?php
            }
        }
        ?>
        <div class="catalog-item last-item"></div>
        <!-- catalog-item -->
    </div>
    <!-- catalog-item-wrapper -->
</div>
<!-- catalog -->

<div class="catalog special col span_1_of_3">
    <div class="catalog-item-wrapper">
        <h5><span class="ie8hack"></span> <span class="bg_before"></span> <span class="bg_after"><span
                    class="ie8hack"></span></span></h5>
        <?php
        if (!empty($ModelsSpecial)) {
            foreach ($ModelsSpecial as $item) {
                ?>
                <div class="catalog-item ">
                    <div class="item-image"><a class="link"
                                               href="/catalog/<?= $item['categorys_id'] ?>_<?= $item['categorys_alias'] ?>/<?= $item['alias'] ?>">
                            <img
                                class="item_img" itemprop="image"
                                src="/images/sklad/<?= (!empty($item['file'])) ? $item['file'] : 'no-image.png' ?>"
                                width="75"
                                alt="<?= (!empty($item['alt'])) ? $item['alt'] : $item['alias'] ?>"
                                title="<?= $item['name'] ?>"
                                ></a></div>
                    <div class="item-info">
                        <p class="item-title"><a
                                href="/catalog/<?= $item['categorys_id'] ?>_<?= $item['categorys_alias'] ?>/<?= $item['alias'] ?>"><span
                                    itemprop="name"><?= $item['name'] ?></span></a>
                        </p>

                        <div class="item-price">
                            <div class="old-price-wrapper"><span
                                    class="old-price"><?= $item['other_price'] ?></span></div>
                            <div class="sale-price-wrapper"><span class="sale-price"> <?= $item['price'] ?>
                                    руб </span></div>
                        </div>

                        <div class="button-buy" onclick="basket_add(<?= $item['id'] ?>);">[Купить]</div>
                        <div style="clear:both"></div>
                    </div>
                    <!--  item-info -->
                </div>
                <!-- catalog-item -->
            <?php
            }
        }
        ?>
        <div class="catalog-item last-item"></div>
        <!-- catalog-item -->
    </div>
    <!-- catalog-item-wrapper -->
</div>
<!-- catalog -->
</div>