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
                <td style="width: 80px"></td>
                <td>Сессия</td>
                <td>Комментарий</td>
                <td>№ телефона</td>
                <td>Дата</td>
    </thead>
    <tbody>

            <tr>
                <td>

                    <form name="form<?= $item['id'] ?>edit" method="POST" style="display:inline;float:left;"><input
                            type="hidden" name="orders_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="edit"/><input type="submit" value="&#x270E;" title="Редактировать" />
                    </form>
                    <?php
                    if($item['complete']){
                        ?>
                        <form name="form<?= $item['id'] ?>enable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="orders_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="enable"/><input type="submit" value="&#10003;" title="Проведен" />
                        </form>
                        <?php
                    }else {
                        ?>
                        <form name="form<?= $item['id'] ?>disable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="orders_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="disable"/><input type="submit" value="&#10005;" title="Не проведен" />
                        </form>
                    <?php
                    }
                        ?>
                </td>
                <td><a href="/sklad/orders/<?=$item['session']?>"><?=$item['session']?></a>&nbsp;
                    <form name="form<?= $item['id'] ?>add" method="POST" style="display:inline;float:right;" action="/sklad/orders/<?=$item['session']?>">
                        <input
                            type="hidden" name="products_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="add"/><input type="submit" value="+" title="Новый на основании" />
                    </form></td>
                <td><?=$item['text']?></td>
                <td><?=$item['phone']?></td>

                <td><?=$item['date']?></td>
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
