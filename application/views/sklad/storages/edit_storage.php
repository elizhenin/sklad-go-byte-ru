<form method="POST">
    <table style="width:100%">
        <tbody>
        <tr>
<td style="text-align: right">
    Название:
</td>
            <td style="text-align: left">
<input type="text" name="name" value="<?=(!empty($item['name']))?$item['name']:''?>"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Наличие:
            </td>
            <td style="text-align: left">
                <input type="checkbox" name="present" <?=(!empty($item['present']))?'checked="checked"':''?>"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
               Город:
            </td>
            <td style="text-align: left">
                <select name="id_citys">
                    <?php
                    if(!empty($citys)){
                        foreach($citys as $city){
                            ?>
                            <option value="<?=$city['id']?>" <?=(!empty($item['id_citys'])&&$item['id_citys']==$city['id'])?'selected="selected"':''?>><?=$city['name']?></option>
                    <?php
                        }
                    }
                    ?>
                    </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Прибытие:
            </td>
            <td style="text-align: left">
                <input type="text" name="arrive" value="<?=(!empty($item['arrive']))?$item['arrive']:''?>"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Транзит:
            </td>
            <td style="text-align: left">
                <input type="checkbox" name="transit" <?=(!empty($item['transit']))?'checked="checked"':''?>"/>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="operation" value="<?=$operation?>">
    <input type="hidden" name="storage_id" value="<?=(!empty($item['id']))?$item['id']:''?>">
    <input type="submit" value="Сохранить">
</form>


