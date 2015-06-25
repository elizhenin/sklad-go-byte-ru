<div class="main-content">
    <h1>Корзина</h1>

    <?=(empty($message))?'':'<div class="feedback-message">'.$message.'</div>'?>

    Внимание! если какой-то товар внезапно исчез из списка - значит его приобрели прямо сейчас, чуть раньше вас

    <form method="POST">
        <table class="basket-table">
            <thead>
            <tr>
                <td>Код</td>
                <td>Название</td>
                <td>Цена</td>
                <td></td>
            </tr>
            </thead>
    <tbody id="basket-table-tbody">
    <tr><td>(Проверяем наличие...)</td></tr>
    </tbody>
        </table>
        Ваш контактный телефон:
        <input type="text" name="phone">
        <input type="submit" value="Заказать">
    </form>

    <script>
    setInterval (function(){basket_edit();}, 1000);
    </script>
</div>