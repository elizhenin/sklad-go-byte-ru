<tr id="basket-tr<?=$item['id']?>">
    <td><?=$item['sku']?></td>
    <td><?=$item['name']?></td>
    <td><?=$item['price']?> р.</td>
    <td>
        <div onclick="basket_del(<?=$item['id']?>);" style="cursor: pointer">
            [X]
        </div>
    </td>
</tr>