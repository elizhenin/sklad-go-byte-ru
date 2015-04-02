<h1>Товары</h1>
<form style="float: left;display: inline-block" method="get">
    <input name="filter" type="text" placeholder="поиск: код или название" onchange="this.form.submit();">
</form>
<table style="width:100%">
    <thead style="background-color: dimgray">
    <td></td>
    <td>Код</td>
    <td>Модель</td>
    <td>Склад</td>
    <td>Продан</td>
    <td>Дата продажи</td>
    </thead>
    <tbody>
    <?php
    if(!empty($items)) {
        foreach ($items as $item) {
            ?>
            <tr>
                <td>

                    <form name="form<?= $item['id'] ?>edit" method="POST" style="display:inline;float:left;"><input
                            type="hidden" name="products_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="edit"/><input type="submit" value="&#x270E;" title="Редактировать" <?= ($rights != 'sale') ? '' : 'disabled="disabled"' ?>/>
                    </form>
                    <?php
                    if($item['deleted']){
                        ?>
                        <form name="form<?= $item['id'] ?>enable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="products_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="enable"/><input type="submit" value="&#10005;" title="Включить" <?= ($rights != 'sale') ? '' : 'disabled="disabled"' ?>/>
                        </form>
                        <?php
                    }else {
                        ?>
                        <form name="form<?= $item['id'] ?>disable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="products_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="disable"/><input type="submit" value="&#10003;" title="Отключить" <?= ($rights != 'sale') ? '' : 'disabled="disabled"' ?>/>
                        </form>
                    <?php
                    }
                        ?>
                </td>
                <td><?= $item['sku'] ?></td>
                <td><a href="/sklad/products/<?=$item['alias']?>"><?= $item['model'] ?></a></td>
                <td><?= $item['storage'] ?></td>
                <td><form><input type="checkbox" name="out" <?=(!empty($item['out']))?'checked="checked"':''?>" disabled/></form></td>
                <td><?= $item['date_out'] ?></td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>

