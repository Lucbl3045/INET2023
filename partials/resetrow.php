<tr id="r<?=reset($row)?>">
    <?php foreach ($columnNames as $column) {
        if ($column!=="contrasenia"){?>
    <td class="font-medium py-3.5 px-5 text-gray-700  text-left">
        <?= $row[$column] ?>
    </td>
    <?php }} ?>
    <td class="font-medium py-3.5 px-5 text-gray-700  text-left">
    <button hx-post='/editrow/<?=$table?>/<?=reset($row)?>' hx-target='#r<?=reset($row)?>' hx-swap='outerHTML' class="rounded-md bg-blue-400 p-2">✏️</button>
    </td>
    <td class="font-medium py-3.5 px-5 text-gray-700  text-left ">
    <button hx-post='/deleterow/<?=$table?>/<?=reset($row)?>' hx-target='#r<?=reset($row)?>' hx-swap='outerHTML' class="rounded-md bg-blue-400 p-2">❌</button>
    </td>

</tr>