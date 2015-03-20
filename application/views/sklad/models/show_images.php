<form name="form_edit" method="POST" action="/sklad/images">
<table style="width:100%">
    <thead style="background-color: dimgray">
    <td></td>
    <td>Фото</td>
    <td>alt</td>
    <td>Важно</td>
    <td>Показывать</td>
    </thead>
    <tbody>
    <?php
    if(!empty($images)){
    foreach ($images as $image) {
        ?>

        <tr>
            <td>
                <label><input type="checkbox" name="delete_<?=$image['id']?>"/>Удалить</label>
            </td>
            <td><img alt="" src="/images/sklad/<?= $image['file'] ?>"
                     style="width:100px;height:100px;"></td>
            <td><input type="text" value="<?=$image['alt']?>" name="alt_<?=$image['id']?>"/></td>

            <td><input type="checkbox" <?= (empty($image['important']))?'':'checked="checked"' ?> name="important_<?=$image['id']?>"/></td>
            <td><input type="checkbox" <?= (empty($image['active']))?'':'checked="checked"' ?> name="active_<?=$image['id']?>"/></td>
        </tr>

    <?php
    }}
    ?>
    </tbody>
</table>
<input type="hidden" name="operation" value="images_update">
<input type="submit" value="Сохранить">
</form>