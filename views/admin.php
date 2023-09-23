<form hx-post="/admin" hx-target="#main" hx-trigger="change" class="my-5 mx-5">
	<select name="table" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
    <?php
	foreach(DB::$dataTables as $dataTable){ ?>
		<option value='<?=$dataTable?>' <?= $dataTable === $table ? ' selected':'' ?> >
            <?=$dataTable?> 
        </option>
	<?php } ?>
	</select>
</form>
<form hx-post='/admin' hx-target='#main' class="my-5 mx-5">
    <input type='text' name='query' value="<?=isset($searchQuery) ? $searchQuery : ""?>" placeholder="🔍 Búsqueda" class="block w-full p-4  text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 " >
	<input type='hidden' name='table' value='<?= $table ?>'>
	<input type='hidden' name='page' value=0>
	<input type='submit' class="hidden">
</form>

<div class="mx-5 my-5">
<?php for ($i = 0 ; $i < count($pageSymbols) ; $i++) { ?>
    <form class="inline" hx-target="#main" hx-post='/admin'>
        <input type="hidden" name='query'  value='<?=$searchQuery?>'>
        <input type="hidden" name='page'  value='<?=$pageNumbers[$i]?>'>
        <input type="hidden" name='table'  value='<?=$table?>'>
        <button type="submit" class="py-1 px-3 ml-1 rounded-sm bg-blue-400 text-white"> 
            <?= $pageSymbols[$i] ?> 
        </button><span>&nbsp;</span>
    </form>
<?php } ?>
</div>



<div class="">
    <div class="bg-slate-50 rounded-xl mt-5 mx-5 p-3 border-blue-500 border overflow-auto">
        <table class="table-fixed">
        <thead>
            <tr id="tablenames">
	        <?php foreach ( $columnNames as $column ){ 
                if ($column!=="contrasenia"){?>
            <th class="border-b font-bold py-3.5 pl-3 text-gray-800 text-center "><?= $column ?></th>
		    <?php }} ?>
            </tr>
        </thead>
        <tbody id="rowsbody">
            <?php foreach($rows as $row){ ?>
            <tr id="r<?=reset($row)?>">
		        <?php foreach ($columnNames as $column){
                    if ($column!=="contrasenia"){?>
                <td class="font-medium py-3.5 px-5 text-gray-700  text-left">
                    <?=$row[$column]?>
                </td>
		        <?php }} ?>
                <td class="font-medium py-3.5 px-5 text-gray-700  text-left">
                <button hx-post='/editrow/<?=$table?>/<?=reset($row)?>' hx-target='#r<?=reset($row)?>' hx-swap='outerHTML' class="rounded-md bg-blue-400 p-2">✏️</button>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-700  text-left ">
                <button hx-post='/deleterow/<?=$table?>/<?=reset($row)?>' hx-target='#r<?=reset($row)?>' hx-swap='outerHTML' class="rounded-md bg-blue-400 p-2">❌</button>
                </td>

            </tr>
            <?php } ?>
            
            
        </tbody>
        </table>
    </div>
</div>

<div>
    <a href="/csvexport/<?=$table?>" download="export.csv" class="bg-blue-400 inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-blue-500 mt-4 mt-0 ml-20">Exportar CSV</a>
</div>

<?php if ($table!=="usuarios"){ ?>
    <div>
        <a hx-post='/newrow/<?=$table?>' hx-target="#rowsbody" hx-swap="beforeend" class="bg-blue-400 inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-blue-500 mt-4 mt-0 ml-20">Agregar</a>
    </div>
    <form id='format' hx-encoding='multipart/form-data' hx-target='#main' hx-post='/csvimport/<?=$table?>' class=" w-min flex flex-col bg-slate-50 rounded-xl mt-5 mx-5 p-3 border-blue-500 border overflow-auto">
        <label for="csv">Importar CSV en esta tabla</label>
        <input type='file' name='csv'  class=" min-w-max bg-blue-400 inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-blue-500   ">
        <input type='submit'  class=" min-w-max bg-blue-400 inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-blue-500 mt-4 ">
    </form>
 <?php } ?>




