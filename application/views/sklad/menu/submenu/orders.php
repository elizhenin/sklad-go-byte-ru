<form name="form_add" method="POST" action="/sklad/orders"><input
        type="hidden" name="operation" value="add"/><input type="submit" value="Новый"/>
</form>
<form name="form_list" method="POST" action="/sklad/orders">
    <input type="hidden" name="operation" value="close">
    <input type="submit" value="Список"/>
</form>
