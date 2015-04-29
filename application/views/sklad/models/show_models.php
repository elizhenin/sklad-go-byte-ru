<h1>Модели</h1>
<table class="crossmid" style="width:100%">
    <thead style="background-color: dimgray">
    <td></td>
    <td>Код</td>
    <td>Название</td>
    <td>Категория</td>
    <td>price</td>
    <td>in_price</td>
    <td>modificated</td>
    </thead>
    <tbody>
    <?php
    if(!empty($items)) {
        foreach ($items as $item) {
            ?>
            <tr>
                <td>

                    <form name="form<?= $item['id'] ?>edit" method="POST" style="display:inline;float:left;"><input
                            type="hidden" name="models_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="edit"/><input type="submit" value="&#x270E;" title="Редактировать"/>
                    </form>
                    <?php
                    if($item['deleted']){
                        ?>
                        <form name="form<?= $item['id'] ?>enable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="models_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="enable"/><input type="submit" value="&#10005;" title="Включить"/>
                        </form>
                        <?php
                    }else {
                        ?>
                        <form name="form<?= $item['id'] ?>disable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="models_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="disable"/><input type="submit" value="&#10003;" title="Отключить"/>
                        </form>
                    <?php
                    }
                        ?>
                </td>
                <td><?= $item['sku'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><?=(empty($categorys[$item['id_categorys']]))?'(недопустимая категория)':$categorys[$item['id_categorys']]['name']?></td>
                <td><?= $item['price'] ?></td>
                <td><?= $item['in_price'] ?></td>
                <td><?= $item['modificated'] ?></td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>

