<h1>Категория</h1>
<form method="POST">
    <table style="width:100%">
        <tbody>
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
                Меню:
            </td>
            <td style="text-align: left">
                <input type="text" name="menu" value="<?= (!empty($item['menu'])) ? $item['menu'] : '' ?>"/>
            </td>
        </tr>

        <tr>
            <td style="text-align: right">
                Родитель:
            </td>
            <td style="text-align: left">
                <select name="id_parent">
                    <option
                        value="0" <?= ( $parent == 0) ? 'selected="selected"' : '' ?>>(нет)</option>
                    <?php
                    if (!empty($categorys)) {
                        foreach ($categorys as $category) {
                            ?>
                            <option
                                value="<?= $category['id'] ?>" <?= ( $parent == $category['id']) ? 'selected="selected"' : '' ?>><?= $category['name'] ?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
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
                description:
            </td>
            <td style="text-align: left">
                <textarea name="description"><?= (!empty($item['description'])) ? $item['description'] : '' ?></textarea>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="operation" value="<?= $operation ?>">
    <input type="hidden" name="id" value="<?= (!empty($item['id'])) ? $item['id'] : '' ?>">
    <input type="submit" value="Сохранить">
</form>


