<form name="form_add" method="POST" action="/sklad/storages"><input
        type="hidden" name="operation" value="add"/><input type="submit" value="Создать склад" />
</form>
<form>
    <input type="button" value="" disabled>
</form>
<form name="form_rules" method="GET" action="/sklad/storages_rules">
    <input type="submit" value="Правила перемещения" />
</form>
<form name="form_add_rule" method="POST" action="/sklad/storages_rules"><input
        type="hidden" name="operation" value="add"/><input type="submit" value="Добавить правило" />
</form>
