<h1>Разрешение на перемещение</h1>
<form method="POST">
    <table style="width:100%">
        <tbody>
        <tr>
            <td style="text-align: right">
               Откуда:
            </td>
            <td style="text-align: left">
                <select name="from">
                    <?php
                    if(!empty($storages)){
                        foreach($storages as $storage){
                            ?>
                            <option value="<?=$storage['id']?>" <?=(!empty($item['from'])&&$item['from']==$storage['id'])?'selected="selected"':''?>><?=$storage['name']?></option>
                    <?php
                        }
                    }
                    ?>
                    </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Куда:
            </td>
            <td style="text-align: left">
                <select name="to">
                    <?php
                    if(!empty($storages)){
                        foreach($storages as $storage){
                            ?>
                            <option value="<?=$storage['id']?>" <?=(!empty($item['to'])&&$item['to']==$storage['id'])?'selected="selected"':''?>><?=$storage['name']?></option>
                        <?php
                        }
                    }
                    ?>
                </select>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="operation" value="<?=$operation?>">
    <input type="hidden" name="id" value="<?=(!empty($item['id']))?$item['id']:''?>">
    <input type="submit" value="Сохранить">
</form>


