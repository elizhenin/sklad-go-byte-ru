<ul>
    <li class="icon-orders <?=(Request::current()->action()=='orders')?'menu_active':''?>">
        <a href="/sklad/orders"><span></span><br>Продажи</a>
    </li>
    <li class="icon-products <?=(Request::current()->action()=='products')?'menu_active':''?>">
        <a href="/sklad/products"><span></span><br>Товары</a>
    </li>>
</ul>