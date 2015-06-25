<form method="POST" action="/sklad/products"><input
        type="hidden" name="operation" value="add"/><input type="submit" value="Добавить товар" title="Добавить новый товар"/>
</form>
<form method="POST" action="/sklad/products"><input
        type="hidden" name="operation" value="products_move_prepare"/><input type="submit" value="Перемещение" title="Переместить товары на другой склад"/>
</form>
<form method="POST" action="/sklad/products"><input
        type="hidden" name="operation" value="export_prepare"/><input type="submit" value="Выгрузка товаров" title="Экспорт товаров в файл"/>
</form>
<form>
    <input type="button" value="" disabled>
</form>
<form method="POST" action="/sklad/products"><input
        type="hidden" name="operation" value="products_return_prepare"/><input type="submit" value="Возврат товара" title="Сформировать возврат товара"/>
</form>
