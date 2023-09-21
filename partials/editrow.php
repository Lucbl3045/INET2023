    <tr id='e<?=$id?>'>
    
        <input type='hidden' name='idColumn' value='<?=$idColumnName?>'>
        <input type='hidden' name='table' value='<?=$table?>'>
<?php foreach ($colTypes as $colName=>$colType){ ?>
    <td class="">
    <?php
    switch ($colType){
        case 'int':
            ?><input name='<?=$colName?>' type='number' value="<?=$row[$colName]?>"  class="includefor<?=$id?> w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        case 'varchar':
            ?><input name='<?=$colName?>' type='text' value="<?=$row[$colName]?>" class="includefor<?=$id?> w-3/4 items-center p-1 m-1 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><?php
            break;
        case 'datetime':
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
} ?>
    <td class="font-medium py-3.5 px-5 text-gray-700  text-left">
    <button hx-post='/changerow/<?=$table?>/<?=$id?>' hx-target='#e<?=$id?>' hx-swap='outerHTML' hx-include='.includefor<?=$id?>' class="rounded-md bg-blue-400 p-2">✔</button>
    </td>
    <td class="font-medium py-3.5 px-5 text-gray-700  text-left ">
    <button hx-post='/resetrow/<?=$table?>/<?=$id?>' hx-target='#e<?=$id?>' hx-swap='outerHTML' class="rounded-md bg-blue-400 p-2">✖</button>
    
    </td>
    
    </tr>
