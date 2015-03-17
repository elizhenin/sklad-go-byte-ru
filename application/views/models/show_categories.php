<h1><?php
    if (!empty($alias)) {
        ?>
        <form name="form_back" method="GET" style="float:left" action="/sklad/categories/<?= substr($alias, 0, strrpos($alias, '/')) ?>">
            <input type="submit" value="<- Назад"/>
        </form>
    <?php } ?> / <?=(empty($name))?'':$name?></h1>


<table style="width:100%">
    <tbody>
    <tr style="width: 50%">
        <td>
            <h2>Подкатегории</h2>
            <form name="form_add" method="POST" style="float:left"><input
                    type="hidden" name="operation" value="add"/><input type="submit" value="Добавить" <?=($rights=='super')?'':'disabled="disabled"'?>/>
            </form>
<table style="width:100%">
    <thead style="background-color: dimgray">
    <td></td>
    <td>Название</td>
    <td>Меню</td>
    <td>Изменена</td>
    </thead>
    <tbody>
    <?php
    if(!empty($items['categories'])) {
        foreach ($items['categories'] as $item) {
            ?>
            <tr>
                <td>

                    <form name="form<?= $item['id'] ?>edit" method="POST" style="display:inline;float:left;"><input
                            type="hidden" name="category_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="edit"/><input type="submit" value="&#x270E;" title="Редактировать" <?=($rights=='super')?'':'disabled="disabled"'?>/>
                    </form>
                    <?php
                    if($item['deleted']){
                        ?>
                        <form name="form<?= $item['id'] ?>enable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="category_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="enable"/><input type="submit" value="&#10005;" title="Включить" <?=($rights=='super')?'':'disabled="disabled"'?>/>
                        </form>
                    <?php
                    }else {
                        ?>
                        <form name="form<?= $item['id'] ?>disable" method="POST" style="display:inline;float:left;">
                            <input
                                type="hidden" name="category_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="disable"/><input type="submit" value="&#10003;" title="Отключить" <?=($rights=='super')?'':'disabled="disabled"'?>/>
                        </form>
                    <?php
                    }
                    ?>
                </td>
                <td><a href="/sklad/categories/<?= $alias ?><?= (empty($alias)) ? '' : '/' ?><?= $item['alias'] ?>"><?= $item['name'] ?></a></td>
                <td><?= $item['menu'] ?></td>
                <td><?= $item['modificated'] ?></td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>
</td>
        <td>

    <h2>Модели этой категории</h2>
    <form name="form_add" method="POST" style="float:left" action="/sklad/models"><input
            type="hidden" name="operation" value="add"/><input type="submit" value="Добавить"/>
    </form>
    <br>

    <table style="width:100%">
        <thead style="background-color: dimgray">
        <td></td>
        <td>Код</td>
        <td>Название</td>
        <td>Цена</td>
        <td>Мин.цена</td>
        <td>Изменен</td>
        </thead>
        <tbody>
        <?php
        if(!empty($items['models'])) {
            foreach ($items['models'] as $item) {
                ?>
                <tr>
                    <td>

                        <form name="form<?= $item['id'] ?>edit" method="POST" style="display:inline;float:left;" action="/sklad/models"><input
                                type="hidden" name="models_id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="edit"/><input type="submit" value="&#x270E;" title="Редактировать"/>
                        </form>
                        <?php
                        if($item['deleted']){
                            ?>
                            <form name="form<?= $item['id'] ?>enable" method="POST" style="display:inline;float:left;" action="/sklad/models">
                                <input
                                    type="hidden" name="models_id"
                                    value="<?= $item['id'] ?>"/><input
                                    type="hidden" name="operation" value="enable"/><input type="submit" value="&#10005;" title="Включить"/>
                            </form>
                        <?php
                        }else {
                            ?>
                            <form name="form<?= $item['id'] ?>disable" method="POST" style="display:inline;float:left;" action="/sklad/models">
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
    </td>
    </tr>
    </tbody>
    </table>
