<h1>Перемещение</h1>
<table style="width: 100%">
    <thead style="background-color: dimgray">
    <td style="text-align: left" colspan="4">
        Добавить товар
        <form>
            <input class="no-enter" id="sku" type="text"  placeholder="код товара" value="<?=(empty($sku))?'':$sku?>" autofocus="autofocus">
            <input type="button" value="+" onclick="add_product();">
        </form>
    </td>
    </thead>
    <tbody>
    </tbody>
</table>
<form method="post">
<input type="hidden" name="operation" value="products_move_complete">
    <label>Целевой склад:
    <select name="destination">
        <?php
        if(!empty($storages))
        foreach($storages as $storage){
            ?>
            <option value="<?=$storage['id']?>"><?=$storage['name']?></option>
        <?php
        }
        ?>
    </select>
    </label>
<table style="width:100%">
    <thead style="background-color: dimgray">
    <td></td>
    <td>Код</td>
    <td>Модель</td>
    <td>Склад</td>
    </thead>
    <tbody id="products">

    </tbody>
</table>
    <input type="submit" value="Переместить">
</form>
<script>
    function row_remove(id){
        $("#"+id).remove();
    }
    function add_product() {
        product = $('#sku').val();
        jQuery.ajax({
            url: '/ajax/addMoveProduct',
            type: 'POST',
            data: {sku: product},
            success: function (data) {
                if (data != '') {
                    fields = JSON.parse(data);
                    html =
                        '<tr id="row'+fields.id+'">' +
                        '<td>' + '<form><input type="button" value="X" onclick="row_remove(\'row'+fields.id+'\');"></form>' +
                        '<input type="hidden" name="items[]" value="'+fields.id+'">' +
                        '</td>' +
                        '<td>' + fields.sku +
                        '</td>' +
                        '<td>' + fields.name +
                        '</td>' +
                        '<td>' + fields.storage +
                        '</td>' +
                        '</tr>';
                    $("#products").html($("#products").html()+html);
                }
            }
        });
    }
</script>