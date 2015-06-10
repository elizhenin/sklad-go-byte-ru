<h1>Продажи</h1>
<table style="width:100%">
    <thead style="background-color: dimgray">
    <td style="width: 80px"><a title="Не проведен: физически лежит на складе, зарезервирован но не продан, можно освободить и перепродать; Проведен: товар оплачен, вручен клиенту.">?</a></td>
    <td>Дата</td>
    <td>Комментарий</td>
    <td>№ телефона</td>
    <td>Сессия</td>
    </thead>
    <tbody>
    <?php
    if(!empty($items)) {
        foreach ($items as $item) {
            ?>
            <tr>
                <td>
                    <?php
            if ($item['complete'] &&($rights !='superuser')) {}else{
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
                <td><a href="/sklad/orders/<?=$item['session']?>" title="Показать продажи этой сессии"><?=$item['session']?></a>&nbsp;
                    <form name="form<?= $item['id'] ?>add" method="POST" style="display:inline;float:right;" action="/sklad/orders/<?=$item['session']?>">
                        <input
                            type="hidden" name="products_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="add"/><input type="submit" value="+" title="Добавить в эту сессию" />
                    </form></td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>

