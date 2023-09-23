    <tr id='einsert'>
    
        <input type='hidden' name='idColumn' value='<?=$idColumnName?>'>
        <input type='hidden' name='table' value='<?=$table?>'>
<?php foreach ($colTypes as $colName=>$colType){ 
    
    if ($colName!=="contrasenia"){?>
    <td class="">
    <?php
    if ($colName=='ubicacion'){ ?>
        <select name="ubicacion" class="includeforinsert w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
            <option   value="cama" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">cama</option>
            <option  value="baño" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">baño</option>
            <option  value="otro" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">otro</option>
        </select>
    <?php continue; }
    if ($colName=='nivelDeEmergencia'){ ?>
        <select name="nivelDeEmergencia" class="includeforinsert w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500">
            <option  value="1" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">1</option>
            <option  value="2" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">2</option>
            <option value="3" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">3</option>
            <option  value="4" class="items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50">4</option>
        </select>
    <?php continue; }
    switch ($colType){
        case 'int':
            ?><input name='<?=$colName?>' type='number' value=""  class="includeforinsert w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        case 'varchar':
        case 'enum':
            ?><input name='<?=$colName?>' type='text' value="" class="includeforinsert w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        case 'datetime':
            ?><input name='<?=$colName?>' type='datetime-local' value="" class="includeforinsert w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        case 'date':
            ?><input name='<?=$colName?>' type='<?=$colType?>' value="" class="includeforinsert w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        case 'tinyint':
            ?><input name='<?=$colName?>' type='number' max=0 min=1 value="" class="includeforinsert w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        case 'text':
            ?><textarea name='<?=$colName?>' class="includeforinsert w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"></textarea><?php
            break;
        case 'char':
            ?><input name='<?=$colName?>' type='text' maxlength=1 value='' class="includeforinsert w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        default:
            break;
    } ?>
    </td>
    
    <?php
}} ?>
    <td class="font-medium py-3.5 px-5 text-gray-700  text-left">
    <button hx-post='/addrow/<?=$table?>' hx-target='#einsert' hx-swap='outerHTML' hx-include='.includeforinsert' class="rounded-md bg-blue-400 p-2">✔</button>
    </td>
    <td class="font-medium py-3.5 px-5 text-gray-700  text-left ">
    <button hx-post='/empty' hx-target='#einsert' hx-swap='outerHTML' class="rounded-md bg-blue-400 p-2">✖</button>
    
    </td>
    
    </tr>
