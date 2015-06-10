<form method="POST">
    <table style="width:100%">
        <tbody>
        <tr>
            <td style="text-align: right">
                Модель:
            </td>
            <td style="text-align: left">
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

                        function split(val) {
                            return val.split(/,\s*/);
                        }

                        function extractLast(term) {
                            return split(term).pop();
                        }

                        $("#models")
                                // don't navigate away from the field on tab when selecting an item
                            .bind("keydown", function (event) {
                                if (event.keyCode === $.ui.keyCode.TAB &&
                                    $(this).autocomplete("instance").menu.active) {
                                    event.preventDefault();
                                }
                            })
                            .autocomplete({
                                minLength: 0,
                                source: function (request, response) {
                                    // delegate back to autocomplete, but extract the last term
                                    response($.ui.autocomplete.filter(
                                        availableModels, extractLast(request.term)));
                                },
                                focus: function () {
                                    // prevent value inserted on focus
                                    return false;
                                },
                                select: function (event, ui) {
                                    var terms = split(this.value);
                                    // remove the current input
                                    terms.pop();
                                    // add the selected item
                                    terms.push(ui.item.value);
                                    // add placeholder to get the comma-and-space at the end
                                    this.value = terms.join("");
                                    return false;
                                }
                            });
                    });
                </script>

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
                Комментарий:
            </td>
            <td style="text-align: left">
                <textarea
                    name="comments"><?= (!empty($item['comments'])) ? $item['comments'] : '' ?></textarea>
            </td>
        </tr>
        <tr>
            <td style="text-align: right">
                Код:
            </td>
            <td style="text-align: left">
                <input type="text" name="sku" value="<?= (!empty($item['sku'])) ? $item['sku'] : '' ?>"/>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="hidden" name="operation" value="<?= $operation ?>">
    <input type="hidden" name="id" value="<?= (!empty($item['id'])) ? $item['id'] : '' ?>">
    <input type="submit" value="Сохранить">
</form>

<script>

</script>

