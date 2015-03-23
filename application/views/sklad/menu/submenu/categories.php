<form method="get" action="/sklad/categories">
    <input type="submit" value="Категории" <?=($rights!='sale')?'':'disabled="disabled"'?>>
</form>
<form>
    <input type="button" value="" disabled>
</form>
<form name="" method="POST" action="<?=(Request::initial()->action()=='categories')?'':'/sklad/categories'?>"><input
        type="hidden" name="operation" value="add"/><input type="submit" value="Создать категорию" <?=($rights=='super')?'':'disabled="disabled"'?>/>
</form>
<form name="" method="POST" style="float:left" action="/sklad/models"><input
        type="hidden" name="operation" value="add"/><input type="submit" value="Создать модель" <?=($rights!='sale')?'':'disabled="disabled"'?>/>
</form>
<form>
    <input type="button" value="" disabled>
</form>
<form method="get" action="/sklad/specifications">
    <input type="submit" value="Спецификации" <?=($rights!='sale')?'':'disabled="disabled"'?>>
</form>
<form method="get" action="/sklad/specifications_groups">
    <input type="submit" value="Группы спецификаций" <?=($rights!='sale')?'':'disabled="disabled"'?>>
</form>
<form>
    <input type="button" value="" disabled>
</form>
<form method="get" action="/sklad/models">
    <input type="submit" value="Все модели" <?=($rights!='sale')?'':'disabled="disabled"'?>>
</form>
