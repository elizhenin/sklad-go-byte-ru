<h1>Склады</h1>
    <form name="form_add" method="POST" style="float:left"><input
            type="hidden" name="operation" value="add"/><input type="submit" value="Добавить"/>
    </form>
<br>

<table style="width:100%">
    <thead style="background-color: dimgray">
    <td></td>
    <td>Город</td>
    <td>Название</td>
    <td>present</td>
    <td>arrive</td>
    <td>Транзит</td>
    </thead>
    <tbody>
    <?php
    if(!empty($items)) {
        foreach ($items as $item) {
            ?>
            <tr>
                <td>

                    <form name="form<?= $item['id'] ?>edit" method="POST" style="display:inline;float:left;"><input
                            type="hidden" name="storages_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="edit"/><input type="submit" value="&#x270E;" title="Редактировать"/>
                    </form>
                    <?php
                    if($item['deleted']){
                        ?>
                        <form name="form<?= $item['id'] ?>enable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="storages_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="enable"/><input type="submit" value="&#10005;" title="Включить"/>
                        </form>
                        <?php
                    }else {
                        ?>
                        <form name="form<?= $item['id'] ?>disable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="storages_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="disable"/><input type="submit" value="&#10003;" title="Отключить"/>
                        </form>
                    <?php
                    }
                        ?>
                </td>
                <td><?= $item['city'] ?></td>
                <td><?= $item['name'] ?></td>
                <td><?= (empty($item['present']))?'&#10005;':'&#10003;' ?></td>
                <td><?= $item['arrive'] ?></td>
                <td><?= (empty($item['transit']))?'&#10005;':'&#10003;' ?></td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>

