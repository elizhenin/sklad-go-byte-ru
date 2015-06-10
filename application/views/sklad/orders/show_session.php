<h1>Продажи сессии</h1>
<table style="width:100%">
<tbody>

    <?php
    if(!empty($items)) {
        ?>
        <tr>
            <td>
                Итого: <b><?=$items['total_products']?></b> шт. товаров на сумму <b><?=$items['total_cash']?></b> руб. в проведенных документах
            </td>
        </tr>
        <?php
        unset($items['total_products'],$items['total_cash']);

        foreach ($items as $item) {
            ?>
            <tr>
                <td colspan="5"><h2>Ордер</h2></td>
            </tr>
            <tr><td>
                    <table style="width:100%">
                    <thead style="background-color: dimgray">
                <td style="width: 80px;text-align: center"><a title="Не проведен: физически лежит на складе, зарезервирован но не продан, можно освободить и перепродать; Проведен: товар оплачен, вручен клиенту.">?</a></td>
                <td>Дата</td>
                <td>Комментарий</td>
                <td>№ телефона</td>
                <td>Сессия</td>
    </thead>
    <tbody>
    <tr>
        <td>
            <?php
            if ($item['complete'] &&($rights !='super')) {echo 'проведен';}else{
                ?>
                <form name="form<?= $item['id'] ?>edit" method="POST" style="display:inline;float:left;"><input
                        type="hidden" name="orders_id"
                        value="<?= $item['id'] ?>"/><input
                        type="hidden" name="operation" value="edit"/><input type="submit" value="&#x270E;"
                                                                            title="Редактировать"/>
                </form>
                <?php
                if ($item['complete']) {
                    ?>
                    <form name="form<?= $item['id'] ?>enable" method="POST" style="display:inline;float:left;">
                        <input
                            type="hidden" name="orders_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="disable"/><input type="submit" value="Х"
                                                                                   title="Отменить проводку"/>
                    </form>
                <?php
                } else {
                    ?>
                    <form name="form<?= $item['id'] ?>disable" method="POST" style="display:inline;float:left;">
                        <input
                            type="hidden" name="orders_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="enable"/><input type="submit"
                                                                                  value="$$"
                                                                                  title="Провести"/>
                    </form>
                <?php
                }
            }
            ?>
        </td>
        <td><?=$item['date']?></td>

        <td><?=$item['text']?></td>
        <td><?=$item['phone']?></td>
        <td><?=$item['session']?>&nbsp;
            <form name="form<?= $item['id'] ?>add" method="POST" style="display:inline;float:right;" action="/sklad/orders/<?=$item['session']?>">
                <input
                    type="hidden" name="products_id"
                    value="<?= $item['id'] ?>"/><input
                    type="hidden" name="operation" value="add"/><input type="submit" value="+" title="Добавить в эту сессию" />
            </form></td>
    </tr>
        <?php
            if(!empty($item['products'])){
                ?>
    <tr>
        <td colspan="5">
            <h3>Товары</h3>
            <table style="width: 100%">
                <thead style="background-color: dimgray">
                <td>Код</td>
                <td>Название</td>
                <td>Деньги</td>
                </thead>
                <tbody>
                <?php
                    foreach ($item['products'] as $product) {
                        ?>
                        <tr>
                            <td><?= $product['sku'] ?></td>
                            <td><?= $product['name'] ?></td>
                            <td><?= $product['price_out'] ?> руб</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </td>
    </tr>
    <?php
            }
        ?>
            </tbody>
                        </table>
                    </td>
                </tr>
            <?php
        }
    }
    ?>
    </tbody>
</table>

