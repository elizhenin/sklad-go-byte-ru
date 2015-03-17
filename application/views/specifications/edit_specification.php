<form method="POST">
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
                <input type="text" name="title" value="<?= (!empty($item['title'])) ? $item['title'] : '' ?>"/>
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
                <input type="text" name="short_text" value="<?= (!empty($item['short_text'])) ? $item['short_text'] : '' ?>"/>
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
                <input type="text" name="in_price" value="<?= (!empty($item['in_price'])) ? $item['in_price'] : '' ?>"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                price:
            </td>
            <td style="text-align: left">
                <input type="text" name="price" value="<?= (!empty($item['price'])) ? $item['price'] : '' ?>"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                complete:
            </td>
            <td style="text-align: left">
                <textarea name="complete"><?= (!empty($item['complete'])) ? $item['complete'] : '' ?></textarea>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                description:
            </td>
            <td style="text-align: left">
                <textarea name="description"><?= (!empty($item['description'])) ? $item['description'] : '' ?></textarea>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                keywords:
            </td>
            <td style="text-align: left">
                <textarea name="keywords"><?= (!empty($item['keywords'])) ? $item['keywords'] : '' ?></textarea>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="operation" value="<?= $operation ?>">
    <input type="hidden" name="id" value="<?= (!empty($item['id'])) ? $item['id'] : '' ?>">
    <input type="submit" value="Сохранить">
</form>


