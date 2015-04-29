<h1>Группы спецификаций</h1>
<table class="crossmid">
    <thead style="background-color: dimgray">
    <td style="width: 5%;">
    </td>
    <td style="text-align: left">
        <form name="form_add" method="POST" style="float:left;">
            <input type="hidden" name="operation" value="specifications_new"/>
            <input type="submit" value="Добавить"/>
            <input type="text" name="name" placeholder="название">
            <input type="text" name="order" placeholder="позиция">
        </form>
    </td>
    <td>Порядок</td>
    </thead>
    <tbody>
    <?php
    if (!empty($items)) {
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td>
                    <?php
                    if ($item['deleted']) {
                        ?>
                        <form name="form<?= $item['id'] ?>enable" method="POST" style="display:inline;float:right;">
                            <input
                                type="hidden" name="id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="specifications_enable"/><input type="submit"
                                                                                                     value="&#10005;"
                                                                                                     title="Включить"/>
                        </form>
                    <?php
                    } else {
                        ?>
                        <form name="form<?= $item['id'] ?>disable" method="POST" style="display:inline;float:right;">
                            <input
                                type="hidden" name="id"
                                value="<?= $item['id'] ?>"/><input
                                type="hidden" name="operation" value="specifications_disable"/><input type="submit"
                                                                                                      value="&#10003;"
                                                                                                      title="Отключить"/>
                        </form>
                    <?php
                    }
                    ?>
                </td>
                <td id="id<?= $item['id'] ?>" style="text-align: left">
                    <div title="Переименовать" onclick="edit_name('<?= $item['id'] ?>');"
                         style="cursor: pointer"><?= $item['name'] ?></div>
                </td>
                <td style="text-align: center">

                        <form name="form<?= $item['id'] ?>movedown" method="POST" style="display:inline-block;float: right">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>"/>
                            <input type="hidden" name="newpos" value="<?=$item['order']+1?>"?>
                            <input type="hidden" name="operation" value="specifications_move"/>
                            <input type="submit" value="&darr;" title="Вниз" <?=($item == end($items))?'disabled="disabled"':''?>/>
                        </form>

                        <form name="form<?= $item['id'] ?>moveup" method="POST" style="display:inline-block;float: left">
                            <input type="hidden" name="id" value="<?= $item['id'] ?>"/>
                            <input type="hidden" name="newpos" value="<?=$item['order']-1?>"?>
                            <input type="hidden" name="operation" value="specifications_move"/>
                            <input type="submit" value="&uarr;" title="Вверх" <?=($item == reset($items))?'disabled="disabled"':''?>/>
                        </form>

                    <div style="float: inherit">
                    <?=$item['order']?>
                        </div>
                </td>
            </tr>
        <?php
        }
    }
    ?>
    </tbody>
</table>

<script type="application/javascript">
    function edit_name(id) {
        edit_form = '<form name="name' + id + '" method="POST" style="display:inline;">' +
        '<input type="hidden" name="id" value="' + id + '"/>' +
        '<input type="hidden" name="operation" value="specifications_rename"/>' +
        '<input type="text" name="name" value="' + $('#id' + id + ' div').text() + '"/>' +
        '<input type="submit" value="&#10003;" title="Сохранить" />' +
        '</form>';
        $('#id' + id).html(edit_form);
    }
</script>