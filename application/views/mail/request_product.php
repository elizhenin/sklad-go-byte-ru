<p><strong>Город: </strong><?=$city ?></p>
<p><strong>Имя: </strong><?= $input['name'] ?></p>
<p><strong>Телефон: </strong><?= $input['phone'] ?></p>
<p><strong>Дата: </strong><?= date("H:i d-m-Y", time()) ?></p>
<p><strong>Email: </strong><?= $input['email'] ?></p>

<table>
    <tbody>
    <tr>
        <th width="310">Название</th>
        <th >Код</th>
    </tr>
             <tr>
                <td>
                    <a href=""><?= $input['model'] ?></a>
                </td>
                 <td>
                     <a href=""><?= $input['sku'] ?></a>
                 </td>
            </tr>
    </tbody>
</table>