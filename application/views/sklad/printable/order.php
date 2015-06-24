<h1>Ордер</h1>

            Товары
            <table style="width: 100%">
                <thead style="background-color: dimgray">
                <td>Код</td>
                <td>Название</td>
                <td>Цена</td>
                </thead>
                <tbody>
                <?php
                if (!empty($products)) {
                    foreach ($products['products'] as $product)
                    if(empty($product['moneyback']) && empty($product['returned'])){
                        ?>
                        <tr>
                            <td><?= $product['sku'] ?></td>
                            <td><?= $product['name'] ?></td>
                            <td>
                               <?= $product['price_out'] ?>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                    <td colspan="3" style="text-align: right">
                        <b>Итого:</b>
                    </td>
                    <td>
                        <b><?= $products['cash'] ?> руб</b>
                    </td>
                <?php
                }
                ?>
                </tbody>
            </table>


Комментарий:<?= (!empty($item['text'])) ? $item['text'] : '' ?>
Контактный телефон:<?= (!empty($item['phone'])) ? $item['phone'] : '' ?>
Проведен:
<input type="checkbox" <?= (!empty($item['complete'])) ? 'checked="checked"' : '' ?>readonly="readonly"/>
