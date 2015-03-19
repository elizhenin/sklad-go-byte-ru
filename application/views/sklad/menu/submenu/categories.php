<form name="form_add" method="POST" action="/sklad/categories"><input
        type="hidden" name="operation" value="add"/><input type="submit" value="Создать категорию" <?=($rights=='super')?'':'disabled="disabled"'?>/>
</form>
<form name="form_add" method="POST" style="float:left" action="/sklad/models"><input
        type="hidden" name="operation" value="add"/><input type="submit" value="Создать модель"/>
</form>