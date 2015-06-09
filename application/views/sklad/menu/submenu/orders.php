<form name="form_add" method="POST" action="/sklad/orders"><input
        type="hidden" name="operation" value="add"/><input type="submit" value="Новый" title="Создать ордер на продажу"/>
</form>
<form name="form_list" method="POST" action="/sklad/orders">
    <input type="hidden" name="operation" value="close">
    <input type="submit" value="Список" title="Вывести на экран все ордеры"/>
</form>
<form>
    <input type="button" value="" disabled>
</form>
<form name="form_list" method="POST" action="/sklad/orders">
    <input type="hidden" name="operation" value="release">
    <input type="submit" value="Освободить товар" title="Высвобождает товар из резерва (непроведенных ордеров) и удаляет пустые непроведенные ордеры"/>
</form>