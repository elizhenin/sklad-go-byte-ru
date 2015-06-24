<h1>Пользователи(города)</h1>

<table style="width:100%">
    <thead style="background-color: dimgray">
    <td></td>
    <td>Город</td>
    <td>Логин</td>
    <td>Входил</td>
    <td>Права</td>
    </thead>
    <tbody>
    <?php
    if(!empty($items)) {
        foreach ($items as $item) {
            ?>
            <tr>
                <td>

                    <form class="symbols" name="form<?= $item['id'] ?>edit" method="POST" style="display:inline;float:left;"><input
                            type="hidden" name="users_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="edit"/><input type="submit" value="&#x270E;" title="Редактировать"/>
                    </form>
                    <?php
                    if($item['deleted']){
                        ?>
                        <form class="symbols" name="form<?= $item['id'] ?>enable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="users_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="enable"/><input type="submit" value="&#10005;" title="Включить"/>
                        </form>
                        <?php
                    }else {
                        ?>
                        <form class="symbols" name="form<?= $item['id'] ?>disable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="users_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="disable"/><input type="submit" value="&#10003;" title="Отключить"/>
                        </form>
                    <?php
                    }
                        ?>
                </td>
                <td><?= $item['name'] ?></td>
                <td><?= $item['login'] ?></td>
                <td><?= $item['lastenter'] ?><br> IP <?= $item['lastip'] ?></td>
                <td>
                    <?=($item['rights']=='super')?'Суперпользователь':''?>
                    <?=($item['rights']=='content')?'Контент-менеджер':''?>
                    <?=($item['rights']=='sale')?'Продавец':''?>
                </td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>

