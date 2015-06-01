<h1><?php
    if (!empty($alias)) {
        ?>
        <form name="form_back" method="GET" style="float:left"
              action="/catalog/<?= substr($alias, 0, strrpos($alias, '/')) ?>">
            <input type="submit" value="<- Назад"/>
        </form>
    <?php } ?> / <?= (empty($name)) ? '' : $name ?></h1>

<ul style="display: inline-block">
<?php
if (!empty($items['categories']))
    foreach ($items['categories'] as $item) { ?>
        <li style="display: inline-block">
            <a href="/catalog/<?= $alias ?><?= (empty($alias)) ? '' : '/' ?><?= $item['alias'] ?>"><?= $item['menu'] ?></a>
        </li>
    <?php } ?>
</ul>
<td>

    <h2>Товар</h2>
    <table style="width:100%">
        <thead style="background-color: dimgray">
        <td>Код</td>
        <td>Название</td>
        <td>Цена</td>
        </thead>
        <tbody>
        <?php
        if (!empty($items['models'])) {
            foreach ($items['models'] as $item) {
                ?>
                <tr>
                    <td><?= $item['sku'] ?></td>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['price'] ?> р.</td>
                </tr>
            <?php
            }
        }
        ?>
        </tbody>
    </table>
