<h1>Выгрузка</h1>
<form method="post">
<input type="hidden" name="operation" value="export_complete">
    <label>Выберите склад:
    <select name="storage">
        <?php
        if(!empty($storages))
        foreach($storages as $storage){
            ?>
            <option value="<?=$storage['id']?>"><?=$storage['name']?></option>
        <?php
        }
        ?>
    </select>
    </label>
    <input type="submit" value="Сформировать">
</form>