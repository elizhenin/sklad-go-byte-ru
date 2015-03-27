<h1>Продажи</h1>
<table style="width:100%">
    <thead style="background-color: dimgray">
    <td style="width: 80px"></td>
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

                    <form name="form<?= $item['id'] ?>edit" method="POST" style="display:inline;float:left;"><input
                            type="hidden" name="orders_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="edit"/><input type="submit" value="&#x270E;" title="Не проведен" />
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
                                type="hidden" name="operation" value="disable"/><input type="submit" value="&#10005;" title="Отменить" />
                        </form>
                    <?php
                    }
                        ?>
                </td>
                    <td><?=$item['date']?></td>
                <td><?=$item['text']?></td>
                <td><?=$item['phone']?></td>
                <td><a href="/sklad/orders/<?=$item['session']?>"><?=$item['session']?></a>&nbsp;
                    <form name="form<?= $item['id'] ?>add" method="POST" style="display:inline;float:right;" action="/sklad/orders/<?=$item['session']?>">
                        <input
                            type="hidden" name="products_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="add"/><input type="submit" value="+" title="Новый на основании" />
                    </form></td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>

