<form method="POST">
    <table style="width:100%">
        <tbody>
        <tr>
<td style="text-align: right">
    Модель:
</td>
            <td style="text-align: left">

<select name="id_models">
    <?php
    if(!empty($models))
    foreach($models as $one){
        ?>
        <option value="<?=$one['id']?>" <?=(!empty($model) && $one['id']==$model)?'selected="selected"':''?>><?=$one['name']?></option>
    <?php
    }
    ?>
</select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Склад:
            </td>
            <td style="text-align: left">
                <select name="id_storage">
                    <?php
                    if(!empty($storages))
                        foreach($storages as $one){
                            ?>
                            <option value="<?=$one['id']?>" <?=(!empty($storage) && $one['id']==$storage)?'selected="selected"':''?>><?=$one['name']?></option>
                        <?php
                        }
                    ?>
                </select>
            </td>
        </tr>

        <tr>
            <td style="text-align: right">
                Код:
            </td>
            <td style="text-align: left">
                <input type="text" name="sku" value="<?=(!empty($item['sku']))?$item['sku']:''?>"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                out:
            </td>
            <td style="text-align: left">
                <input type="checkbox" name="out" <?=(!empty($item['out']))?'checked="checked"':''?>"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Комментарий:
            </td>
            <td style="text-align: left">
                <textarea
                    name="comments"><?= (!empty($item['comments'])) ? $item['comments'] : '' ?></textarea>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="operation" value="<?=$operation?>">
    <input type="hidden" name="id" value="<?=(!empty($item['id']))?$item['id']:''?>">
    <input type="submit" value="Сохранить">
</form>


