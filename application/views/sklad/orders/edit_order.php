<h1>Ордер на продажу</h1>

<?php
if (empty($id_orders)) {
    ?>
    (для добавления товаров сначала сохраните ордер)
<?php
} else {
?>
<table style="width:100%">
    <tbody>

    <tr>
        <td>
            <?php
            if (($item['complete']) && ($rights != 'super')) {
                echo '<span class="prov">проведен</span>';
            } else {
                ?>
                <table style="width: 100%">
                    <thead style="background-color: dimgray">
                    <td style="text-align: left" colspan="4">
                        Добавить товар
                        <form method="POST" class="no-enter">
                            <input type="hidden" name="operation" value="add_product">
                            <input type="hidden" name="id_orders" value="<?= $id_orders ?>">
                            <input id="id_products" type="hidden" name="id_products"
                                   value="<?= (empty($buyit)) ? '' : $buyit['id'] ?>">
                            <input id="sku" autofocus="autofocus" name="sku" type="text" onkeyup="check_product();"
                                   placeholder="код товара" value="<?= (empty($buyit)) ? '' : $buyit['sku'] ?>">
                            <label>Название:
                                <input id="name" type="text" value="<?= (empty($buyit)) ? '' : $buyit['name'] ?>"
                                       readonly>
                            </label>
                            <label>Цена:
                                <input id="price" type="text" value="<?= (empty($buyit)) ? '' : $buyit['price'] ?>"
                                       name="price_out">руб
                            </label>
                            <label>мин:
                                <input id="in_price" type="text"
                                       value="<?= (empty($buyit)) ? '' : $buyit['in_price'] ?>"
                                       readonly>руб
                            </label>

                            <input type="submit" value="Добавить" title="добавить в ордер">
                        </form>
                    </td>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            <?php
            }
            ?>
        </td>
    </tr>
    <tr>
        <td>
            <table style="width:100%">
                <tbody>

                <tr>
                    <td>
                        Товары
                        <table style="width: 100%">
                            <thead style="background-color: dimgray">
                            <td>
                            </td>
                            <td>Код</td>
                            <td>Название</td>
                            <td>Цена</td>
                            </thead>
                            <tbody>
                            <?php
                            if (!empty($products)) {
                                foreach ($products['products'] as $product) {

                                    ?>
                                    <tr <?=(!empty($product['moneyback'])?'class="moneyback"':'')?>>
                                        <td style="width: 40px">
                                            <?php
                                            if (($item['complete']) && ($rights != 'super')) {
                                                ?>
                                                <form class="symbols" name="form<?= $product['id'] ?>return" method="POST"
                                                      style="display:inline;float:left;">
                                                    <input type="hidden" name="id" value="<?= $product['id'] ?>"/>
                                                    <input type="hidden" name="product"
                                                           value="<?= $product['id_products'] ?>">
                                                    <input type="hidden" name="operation" value="moneyback_product"/>
                                                    <input type="submit" value="Moneyback" title="Манибэк товара" <?=(!empty($product['moneyback'])?'disabled="disabled"':'')?>/>
                                                </form>
                                            <?php
                                            } else {
                                                ?>
                                                <form class="symbols" name="form<?= $product['id'] ?>delete" method="POST"
                                                      style="display:inline;float:left;">
                                                    <input type="hidden" name="id" value="<?= $product['id'] ?>"/>
                                                    <input type="hidden" name="product"
                                                           value="<?= $product['id_products'] ?>">
                                                    <input type="hidden" name="operation" value="remove_product"/>
                                                    <input type="submit" value="&#10005;" title="Удалить из ордера"/>
                                                </form>
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?= $product['sku'] ?></td>
                                        <td><?= $product['name'] ?></td>
                                        <td><form class="symbols" name="form<?= $product['id'] ?>cash" method="POST">
                                                <input type="hidden" name="id" value="<?=(!empty($item['complete']))?'':$product['id']?>"/>
                                                <input type="hidden" name="product"
                                                       value="<?=(!empty($item['complete']))?'':$product['id_products']?>">
                                                <input type="hidden" name="operation" value="<?=(!empty($item['complete']))?'':'alterprice_product'?>"/>
                                                <input type="text" name="price_out" title="минимум <?=$product['in_price']?>" value="<?= $product['price_out'] ?>" style="width: 100px;text-align: right" <?=(!empty($item['complete']))?'readonly="readonly"':''?>/> руб
                                                <input type="submit" value="Применить" title="Внести изменения" <?=(!empty($item['complete']))?'style="display:none;"':''?>/>
                                            </form>
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
                    </td>
                </tr>

                </tbody>
            </table>
            <?php
            }
            ?>


            <form method="post" name="order">
                <input type="hidden" name="operation" value="<?= $operation ?>">
                <input type="hidden" name="id" value="<?= (!empty($item['id'])) ? $item['id'] : '' ?>">
                <table style="width:100%">
                    <tbody>
                    <tr>
                        <td style="text-align: right">
                            Комментарий:
                        </td>
                        <td style="text-align: left">
                            <input type="text" name="text" value="<?= (!empty($item['text'])) ? $item['text'] : '' ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right">
                            Сессия:
                        </td>
                        <td style="text-align: left">

                            <select name="session">
                                <option value="0">(новая)</option>
                                <?php
                                if (!empty($sessions))
                                    foreach ($sessions as $one) {
                                        ?>
                                        <option
                                            value="<?= $one['id'] ?>" <?= (!empty($item['session']) && $one['id'] == $item['session']) ? 'selected="selected"' : '' ?>><?= $one['id'] ?>
                                            &nbsp;(<?= $one['created'] ?>)
                                        </option>
                                    <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="text-align: right">
                            Контактный телефон:
                        </td>
                        <td style="text-align: left">
                            <input type="text" name="phone"
                                   value="<?= (!empty($item['phone'])) ? $item['phone'] : '' ?>"/>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: right">
                            Проведен:
                        </td>
                        <td style="text-align: left">
                            <input type="checkbox"
                                   name="complete" <?= (!empty($item['complete'])) ? 'checked="checked"' : '' ?>"/>
                        </td>
                    </tr>

                    </tbody>
                </table>
                <input type="submit" value="Сохранить и Закрыть">
            </form>


            <script>

                function check_product() {
                    product = $('#sku').val();
                    jQuery.ajax({
                        url: '/ajax/checkProduct',
                        type: 'POST',
                        data: {sku: product},
                        success: function (data) {
                            if (data != '') {
                                fields = JSON.parse(data);
                                $("#name").val(fields.name);
                                $("#price").val(fields.price);
                                $("#in_price").val(fields.in_price);
                                $("#id_products").val(fields.id);
                            } else {
                                $("#name").val('');
                                $("#price").val('');
                                $("#in_price").val('');
                                $("#id_products").val('')
                                ;
                            }
                            ;
                        }
                    });
                }
            </script>

