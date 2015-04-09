<ul style="text-align: center;">

    <li class="icon-users <?=(Request::current()->action()=='users')?'menu_active':''?>">
        <a href="/sklad/users"><span></span><br>Пользователи</a>
    </li>
    <li class="icon-storages <?=(Request::current()->action()=='storages' || Request::current()->action()=='storages_rules')?'menu_active':''?>">
        <a href="/sklad/storages"><span></span><br>Склады</a>
    </li>

    <li class="icon-models <?=(Request::current()->action()=='categories' || Request::current()->action()=='models' || Request::current()->action()=='specifications' || Request::current()->action()=='specifications_groups')?'menu_active':''?>">
        <a href="/sklad/categories"><span></span><br>Модели</a>
    </li>

    <li>
    </li>

    <li class="icon-products <?=(Request::current()->action()=='products')?'menu_active':''?>">
        <a href="/sklad/products"><span></span><br>Товары</a>
    </li>
    <li class="icon-orders <?=(Request::current()->action()=='orders')?'menu_active':''?>">
        <a href="/sklad/orders"><span></span><br>Продажи</a>
    </li>

</ul>