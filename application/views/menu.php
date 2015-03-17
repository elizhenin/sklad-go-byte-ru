<ul>
    <?php
    if($rights == 'super'){
        ?>
        <li>
            <a href="/sklad/users">Пользователи</a>
        </li>
        <li>
            <a href="/sklad/storages">Склады</a>
        </li>
        <li>
            <a href="/sklad/models">Модели</a>
            <ul>
                <li>
                    <a href="/sklad/models_categories">Категории</a>
                </li>
            </ul>
        </li>
    <?php
    }
    ?>

    <li>
        <a href="/sklad/orders">Продажи</a>
    </li>
    <li>
        <a href="/sklad/models">Товары</a>
    </li>
</ul>