<h1>Модель</h1>
<table style="width:100%;">
<tbody>
<tr style="width: 50%">
<td>
    <form method="POST">
        <h2>Параметры</h2>
        <table style="width:100%">
            <tbody>
            <tr>
                <td style="text-align: right">
                    Код товара:
                </td>
                <td style="text-align: left">
                    <input type="text" name="sku" value="<?= (!empty($item['sku'])) ? $item['sku'] : '' ?>"/>
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    Название:
                </td>
                <td style="text-align: left">
                    <input type="text" name="name" value="<?= (!empty($item['name'])) ? $item['name'] : '' ?>"/>
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    Заголовок:
                </td>
                <td style="text-align: left">
                    <input type="text" name="title"
                           value="<?= (!empty($item['title'])) ? $item['title'] : '' ?>"/>
                </td>
            </tr>

            <tr>
                <td style="text-align: right">
                    Категория:
                </td>
                <td style="text-align: left">
                    <select name="id_categorys">
                        <?php
                        if (!empty($categorys)) {
                            foreach ($categorys as $category) {
                                ?>
                                <option
                                    value="<?= $category['id'] ?>" <?= (!empty($item['id_categorys']) && $item['id_categorys'] == $category['id']) ? 'selected="selected"' : '' ?>><?= $category['name'] ?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    short_text:
                </td>
                <td style="text-align: left">
                    <input type="text" name="short_text"
                           value="<?= (!empty($item['short_text'])) ? $item['short_text'] : '' ?>"/>
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    text:
                </td>
                <td style="text-align: left">
                    <textarea name="text"><?= (!empty($item['text'])) ? $item['text'] : '' ?></textarea>
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    in_price:
                </td>
                <td style="text-align: left">
                    <input type="text" name="in_price"
                           value="<?= (!empty($item['in_price'])) ? $item['in_price'] : '' ?>"/>
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    price:
                </td>
                <td style="text-align: left">
                    <input type="text" name="price"
                           value="<?= (!empty($item['price'])) ? $item['price'] : '' ?>"/>
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    complete:
                </td>
                <td style="text-align: left">
                    <textarea
                        name="complete"><?= (!empty($item['complete'])) ? $item['complete'] : '' ?></textarea>
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    description:
                </td>
                <td style="text-align: left">
                    <textarea
                        name="description"><?= (!empty($item['description'])) ? $item['description'] : '' ?></textarea>
                </td>
            </tr>
            <tr>
                <td style="text-align: right">
                    keywords:
                </td>
                <td style="text-align: left">
                    <textarea
                        name="keywords"><?= (!empty($item['keywords'])) ? $item['keywords'] : '' ?></textarea>
                </td>
            </tr>
            </tbody>
        </table>
        <input type="hidden" name="operation" value="<?= $operation ?>">
        <input type="hidden" name="id" value="<?= (!empty($item['id'])) ? $item['id'] : '' ?>">
        <input type="submit" value="Сохранить">
    </form>
</td>
<td style="vertical-align: top;">
    <h2>Спецификации</h2>
    <?php
    if (!empty($item['id'])) {
        ?>

        <table style="width: 100%">
            <thead style="background-color: dimgray">
            <td style="text-align: left">
                <form name="form_add" method="POST" style="float:left;" action="/sklad/specifications">
                    <input type="hidden" name="operation" value="model_add"/>
                    <input type="hidden" name="id_models" value="<?= $item['id'] ?>"/>
                    <input type="submit" value="Добавить"/>
                    <select name="id_specifications">
                        <option value="0">(создать)</option>
                        <?php
                        if (!empty($specifications)) {
                            foreach ($specifications as $one) {
                                ?>
                                <option value="<?= $one['id'] ?>"><?= $one['name'] ?></option>
                            <?php
                            }
                        }
                        ?>
                    </select>
                    <input type="text" name="name" placeholder="или введите название">
                </form>
            </td>
            </thead>
        </table>
    <form action="/sclad/specifications">
        <table style="width: 100%">
            <thead style="background-color: dimgray">
            <td>
            </td>
            <td>
                Название
            </td>
            <td>
                Значение
            </td>
            <td>
                Важный
            </td>
            <td>
                Вручную
            </td>
            <td>
                Изменен
            </td>
            </thead>
            <tbody>
            <?php
            if (!empty($model_specifications)) {
                foreach ($model_specifications as $one) {
                    ?>
                    <tr>
                        <td>
<label><input type="checkbox" name="delete_<?=$item['id']?>"/>Удалить</label>
                        </td>
                        <td><?=$one['specification']?> </td>
                        <td><input type="text" value="<?=$one['value']?>" name="value_<?=$item['id']?>"/></td>

                        <td><input type="checkbox" <?= (empty($one['important']))?'':'checked="checked"' ?> name="important_<?=$item['id']?>"/></td>
                        <td><input type="checkbox" <?= (empty($one['manual']))?'':'checked="checked"' ?> name="manual_<?=$item['id']?>"/></td>
                        <td><?=$one['modificated']?></td>
                    </tr>
                <?php
                }
            }
            ?>
            </tbody>
        </table>
        <input type="hidden" name="operation" value="model_update">
        <input type="hidden" name="id_models" value="<?= (!empty($item['id'])) ? $item['id'] : '' ?>">
        <input type="submit" value="Сохранить">
        </form>
    <?php
    } else {
        ?>
        (сначала сохраните модель)
    <?php
    }
    ?>
</td>
</tr>
</tbody>
</table>


