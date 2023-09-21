<form hx-post="/admin" hx-target="#main" hx-trigger="change" class="my-5 mx-5">
	<select name="table" class="block py-2.5 px-0 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
    <?php
	foreach($dataTables as $dataTable){ ?>
		<option value='<?=$dataTable?>' <?= $dataTable === $table ? ' selected':'' ?> >
            <?=$dataTable?> 
        </option>
	<?php } ?>
	</select>
</form>

<form action="" class="my-5 mx-5">
    <input type='text' name='query' value="<?=$searchQuery || ""?>" placeholder="🔍 Búsqueda" class="block w-full p-4  text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" >
	<input type='hidden' name='table' value='<?= $table ?>'>
	<input type='hidden' name='page' value=0>
	<input type='submit' class="hidden">
</form>

<div class="mx-5 my-5">
<?php for ($i = 0 ; $i < count($pageSymbols) ; $i++) { ?>
    <a hx-target="#main" hx-post='/admin?table=<?=$table?>&query=<?=$searchQuery?>&page=<?=$pageNumbers[$i]?>'> 
        <?= $pageSymbols[$i] ?> 
    </a><span>&nbsp;</span>
<?php } ?>
</div>



<div class="">
    <div class="bg-slate-50 rounded-xl mt-5 mx-5 p-3 border-blue-500 border ">
        <table class="table-fixed">
        <thead>
            <tr id="tablenames">
	        <?php foreach ( $columnNames as $column ){ ?>
            <th class="border-b font-medium py-3.5 px-auto text-gray-800 text-center "><?= $column ?></th>
		    <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($rows as $row){ ?>
            <tr id="r<?=reset($row)?>">
		        <?php foreach ($columnNames as $column) {?>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                    <?= $row[$column] ?>
                </td>
		        <?php } ?>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                <button onclick="editrow(<?= reset($row) ?>)">✏️</button>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                <button onclick="delrow(<?= reset($row) ?>)">❌</button>
                </td>

            </tr>
            <?php } ?>
            
            
        </tbody>
        </table>
    </div>
</div>