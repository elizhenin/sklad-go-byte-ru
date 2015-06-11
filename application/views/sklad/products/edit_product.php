<form method="POST">
    <table style="width:100%">
        <tbody>
        <tr>
            <td style="text-align: right;width: 20%">
                <input id="m_sku" class="no-enter" autofocus="autofocus" type="text" onkeyup="check_model();" placeholder="код модели">
                Модель:
            </td>
            <td style="text-align: left">

                <div style="text-align: left;width: 100%">
                    <input type="text" id="models" name="models" value="<?php
                    if(!empty($models) && !empty($item['id_models']))
                    foreach($models as $one)
                    if($one['id']==$item['id_models'])
                    {echo $one['name'];}?>">
                </div>

            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Склад:
            </td>
            <td style="text-align: left">
                <select name="id_storage">
                    <?php
                    if (!empty($item['id_storage'])) {
                        ?>
                        <option value="<?= $item['id_storage'] ?>" selected="selected">(не менять)</option>
                        ?>
                    <?php
                    }
                    if (!empty($storages))
                        foreach ($storages as $one) {
                            ?>
                            <option value="<?= $one['id'] ?>"><?= $one['name'] ?></option>
                        <?php
                        }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Код:
            </td>
            <td style="text-align: left">
                <input class="no-enter" type="text" name="sku" value="<?= (!empty($item['sku'])) ? $item['sku'] : '' ?>"/>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Комментарий:
            </td>
            <td style="text-align: left">
                <textarea
                    name="comments"><?= (!empty($item['comments'])) ? $item['comments'] : '' ?></textarea>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="operation" value="<?= $operation ?>">
    <input type="hidden" name="id" value="<?= (!empty($item['id'])) ? $item['id'] : '' ?>">
    <input type="submit" value="Сохранить">
</form>

<script>
    $(function () {
        var availableModels = [
            <?php
             if(!empty($models))
              foreach($models as $one){
             ?>
            "<?=$one['name']?>",
            <?php
        }
        ?>
        ];
        $( "#models" ).autocomplete({
            source: availableModels
        });

    });
</script>
<script>

    function check_model() {
        product = $('#m_sku').val();
        jQuery.ajax({
            url: '/ajax/checkModel',
            type: 'POST',
            data: {sku: product},
            success: function (data) {
                if (data != '') {
                    fields = JSON.parse(data);
                    $("#models").val(fields.name);
                } else {
                    $("#name").val('');
                }
            }
        });
    }
</script>
