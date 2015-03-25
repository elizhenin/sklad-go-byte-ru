<h1>Ордер на продажу</h1>

<?php
if(empty($id_orders)){
    ?>
    (для добавления товаров сначала сохраните ордер)
<?php
}else{
    ?>
    <table style="width:100%">
        <tbody>

        <tr>
            <td colspan="2">
                <table style="width: 100%">
                    <thead style="background-color: dimgray">
                    <td style="width: 5%;">
                    </td>
                    <td style="text-align: left">
                        Товар <form><input type="submit" value="test"><input name="test" type="text"></form>
                    </td>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </td>
        </tr>

        </tbody>
    </table>
<?php
}
?>


<form method="post" name="order">
    <input type="hidden" name="operation" value="<?= $operation ?>">
    <input type="hidden" name="id" value="<?= (!empty($item['id'])) ? $item['id'] : '' ?>">
    <table style="width:100%">
        <tbody>
        <tr>
            <td style="text-align: right">
                Комментарий:
            </td>
            <td style="text-align: left">
                <input type="text" name="text" value="<?= (!empty($item['text'])) ? $item['text'] : '' ?>"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Сессия:
            </td>
            <td style="text-align: left">

                <select name="id_sessions" >
                    <option value="0">(новая)</option>
                    <?php
                    if (!empty($sessions))
                        foreach ($sessions as $one) {
                            ?>
                            <option
                                value="<?= $one['id'] ?>" <?= (!empty($session) && $one['id'] == $session) ? 'selected="selected"' : '' ?>>#<?=$one['id']?>&nbsp;(<?=$one['created']?>)</option>
                        <?php
                        }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td style="text-align: right">
                Контактный телефон:
            </td>
            <td style="text-align: left">
                <input type="text" name="phone" value="<?= (!empty($item['phone'])) ? $item['phone'] : '' ?>"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Confirm:
            </td>
            <td style="text-align: left">
                <input type="checkbox" name="confirm" <?=(!empty($item['confirm']))?'checked="confirm"':''?>"/>
            </td>
        </tr>

        </tbody>
    </table>
    <input type="submit" value="Сохранить">
</form>




