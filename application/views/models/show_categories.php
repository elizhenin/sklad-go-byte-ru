<h1>Категории</h1>
<?php
if (!empty($alias)) {
    ?>
    <form name="form_back" method="GET" style="float:left" action="/sklad/models_categories/<?= substr($alias, 0, strrpos($alias, '/')) ?>">
        <input type="submit" value="<- Назад"/>
    </form>
<?php } ?>
<form name="form_add" method="POST" style="float:left"><input
        type="hidden" name="operation" value="add"/><input type="submit" value="Добавить"/>
</form>
<table style="width:100%">
    <thead style="background-color: dimgray">
    <td></td>
    <td>Название</td>
    <td>Меню</td>
    <td>modificated</td>
    </thead>
    <tbody>
    <?php
    if(!empty($items)) {
        foreach ($items as $item) {
            ?>
            <tr>
                <td>

                    <form name="form<?= $item['id'] ?>edit" method="POST" style="display:inline;float:left;"><input
                            type="hidden" name="category_id"
                            value="<?= $item['id'] ?>"/><input
                            type="hidden" name="operation" value="edit"/><input type="submit" value="&#x270E;" title="Редактировать"/>
                    </form>
                </td>
                <td><a href="/sklad/models_categories/<?= $alias ?><?= (empty($alias)) ? '' : '/' ?><?= $item['alias'] ?>"><?= $item['name'] ?></a></td>
                <td><?= $item['menu'] ?></td>
                <td><?= $item['modificated'] ?></td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>

