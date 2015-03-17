<ul>
    <?php
    if ($rights == 'super') {
        ?>
        <li>
            <a href="/sklad/users">Пользователи</a>
        </li>
        <li>
            <a href="/sklad/storages">Склады</a>
        </li>

        <li>
            <a href="/sklad/categories">Модели</a>

        </li>
    <?php
    }
    ?>
    <?php
    if ($rights == 'content') {
    ?>

    <li>
        <a href="/sklad/categories">Модели</a>

    </li>
<?php
}
    ?>

    <li>
        <a href="/sklad/orders">Продажи</a>
    </li>
    <li>
        <a href="/sklad/products">Товары</a>
    </li>
</ul>