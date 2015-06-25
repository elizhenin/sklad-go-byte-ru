<tr id="basket-tr<?=$item['id']?>">
    <td><?=$item['sku']?></td>
    <td><?=$item['name']?></td>
    <td><?=$item['price']?> р.</td>
    <td>
        <div class="basket-del" onclick="basket_del(<?=$item['id']?>);" >
            Удалить
        </div>
    </td>
</tr>