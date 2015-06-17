<?php
$product = $item['product'];
$specifications = $item['specifications'];
$images = $item['images'];
?>

Название
<div><?= $product['name'] ?></div>
Краткое описание(около цен)
<div><?= $product['short_text'] ?></div>
Чужая цена
<div><?= $product['other_price'] ?></div>
Наша цена
<div><?= $product['price'] ?></div>
Фоточге:
<div>
    <?php
    foreach ($images as $image) {
        ?>
        <img src="/images/sklad/<?= $image['file'] ?>" alt="<?= $image['alt'] ?>">
    <?php
    }
    ?>
</div>
Полное описание(таб-1)
<div><?= $product['text'] ?></div>
Характеристики(таб-2):
<ul>
    <?php
    foreach($spec_groups as $group){
        ?>
        <li style="display: block"><h2><?=$group['name']?></h2>
            <ul>
                <?php
                foreach ($specifications as $one)
                if($one['group_id']==$group['id']){
                    ?>
                    <li style="display: block">
                        <?= $one['name'] ?>:<?= $one['value'] ?>
                        <?= ($one['manual']) ? '<span style="color: red">Проверено руками</span>' : '' ?>
                    </li>
                <?php
                }
                ?>
            </ul>
            <hr>
            </li>
        <?php
    }
    ?>
</ul>
Комплектация(таб-3):
<div><?= $product['complectation'] ?></div>


