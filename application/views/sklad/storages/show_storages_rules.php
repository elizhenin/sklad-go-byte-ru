<h1>Разрешения на перемещения</h1>
<table style="width:100%">
    <thead style="background-color: dimgray">
    <td></td>
    <td>Из</td>
    <td>В</td>
     </thead>
    <tbody>
    <?php
    if(!empty($items)) {
        foreach ($items as $item) {
            ?>
            <tr>
                <td>

                    <form name="form<?= $item['id'] ?>edit" method="POST" style="display:inline;float:left;"><input
                            type="hidden" name="storages_rules_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="edit"/><input type="submit" value="&#x270E;" title="Редактировать"/>
                    </form>
                    <?php
                    if($item['deleted']){
                        ?>
                        <form name="form<?= $item['id'] ?>enable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="storages_rules_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="enable"/><input type="submit" value="&#10005;" title="Включить"/>
                        </form>
                        <?php
                    }else {
                        ?>
                        <form name="form<?= $item['id'] ?>disable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="storages_rules_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="disable"/><input type="submit" value="&#10003;" title="Отключить"/>
                        </form>
                    <?php
                    }
                        ?>
                </td>
                <td><?= $item['from'] ?></td>
                <td><?= $item['to'] ?></td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>

