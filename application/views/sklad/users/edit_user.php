<h1>Пользователь(город)</h1>
<form method="POST">
    <table style="width:100%">
        <tbody>
        <tr>
<td style="text-align: right">
    Город:
</td>
            <td style="text-align: left">
<input type="text" name="name" value="<?=(!empty($item['name']))?$item['name']:''?>"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                login & alias:
            </td>
            <td style="text-align: left">
                <input type="text" name="alias" value="<?=(!empty($item['login']))?$item['login']:''?>" placeholder="Оставьте пустым, будет создан автоматически"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Права:
            </td>
            <td style="text-align: left">
                <select name="rights">
                    <option value="sale" <?=(!empty($item['rights'])&&$item['rights']=='sale')?'selected="selected"':''?>>Продавец</option>
                    <option value="content" <?=(!empty($item['rights'])&&$item['rights']=='content')?'selected="selected"':''?>>Контент-менеджер</option>
                    <option value="super" <?=(!empty($item['rights'])&&$item['rights']=='super')?'selected="selected"':''?>>Суперпользователь</option>
                    </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Пароль:
            </td>
            <td style="text-align: left">
                <input type="password" name="password" placeholder="Задать новый"/>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="operation" value="<?=$operation?>">
    <input type="hidden" name="users_id" value="<?=(!empty($item['id']))?$item['id']:''?>">
    <input type="submit" value="Сохранить">
</form>


