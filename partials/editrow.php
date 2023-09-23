    <tr id='e<?=$id?>'>
    
        <input type='hidden' name='idColumn' value='<?=$idColumnName?>'>
        <input type='hidden' name='table' value='<?=$table?>'>
<?php foreach ($colTypes as $colName=>$colType){ 
    
    if ($colName!=="contrasenia"){?>
    <td class="">
    <?php
    if ($colName=='ubicacion'){ ?>
        <select name="ubicacion" class="includefor<?=$id?> w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
            <option <?=$row[$colName]==="cama" ? "selected" : ""?>  value="cama" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">cama</option>
            <option <?=$row[$colName]==="baño" ? "selected" : ""?> value="baño" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">baño</option>
            <option <?=$row[$colName]==="otro" ? "selected" : ""?> value="otro" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">otro</option>
        </select>
    <?php continue; }
    if ($colName=='nivelDeEmergencia'){ ?>
        <select name="nivelDeEmergencia" class="includefor<?=$id?> w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
            <option <?=$row[$colName]==="1" ? "selected" : ""?> value="1" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">1</option>
            <option <?=$row[$colName]==="2" ? "selected" : ""?> value="2" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">2</option>
            <option <?=$row[$colName]==="3" ? "selected" : ""?> value="3" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">3</option>
            <option <?=$row[$colName]==="4" ? "selected" : ""?> value="4" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">4</option>
        </select>
    <?php continue; }
    switch ($colType){
        case 'int':
            ?><input name='<?=$colName?>' type='number' value="<?=$row[$colName]?>"  class="includefor<?=$id?> w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        case 'varchar':
        case 'enum':
            ?><input name='<?=$colName?>' type='text' value="<?=$row[$colName]?>" class="includefor<?=$id?> w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
            ?><input name='<?=$colName?>' type='<?=$colType?>' value="<?=$row[$colName]?>" class="includefor<?=$id?> w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
        case 'datetime':
            ?><input name='<?=$colName?>' type='datetime-local' value="<?=$row[$colName]?>" class="includefor<?=$id?> w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        case 'date':
            ?><input name='<?=$colName?>' type='<?=$colType?>' value="<?=$row[$colName]?>" class="includefor<?=$id?> w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        case 'tinyint':
            ?><input name='<?=$colName?>' type='number' max=0 min=1 value="<?=$row[$colName]?>" class="includefor<?=$id?> w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        case 'text':
            ?><textarea name='<?=$colName?>' class="includefor<?=$id?> w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?=$row[$colName]?></textarea><?php
            break;
        case 'char':
            ?><input name='<?=$colName?>' type='text' maxlength=1 value='<?=$row[$colName]?>' class="includefor<?=$id?> w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        default:
            break;
    } ?>
    </td>
    
    <?php
}} ?>
    <td class="font-medium py-3.5 px-5 text-gray-700  text-left">
    <button hx-post='/changerow/<?=$table?>/<?=$id?>' hx-target='#e<?=$id?>' hx-swap='outerHTML' hx-include='.includefor<?=$id?>' class="rounded-md bg-blue-400 p-2">✔</button>
    </td>
    <td class="font-medium py-3.5 px-5 text-gray-700  text-left ">
    <button hx-post='/resetrow/<?=$table?>/<?=$id?>' hx-target='#e<?=$id?>' hx-swap='outerHTML' class="rounded-md bg-blue-400 p-2">✖</button>
    
    </td>
    
    </tr>
