<form method="POST" action="/sklad/products"><input
        type="hidden" name="operation" value="add"/><input type="submit" value="Добавить товар" <?=($rights!='sale')?'':'disabled="disabled"'?>/>
</form>
<form method="POST" action="/sklad/products"><input
        type="hidden" name="operation" value="products_move_prepare"/><input type="submit" value="Перемещение"/>
</form>
