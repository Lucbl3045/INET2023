
<form id="repform" hx-post='/reports' hx-target='#main' class="my-5 mx-5 flex flex-row align-center justify-evenly">
    <label for="initDate">Fecha Mínima: </label>
	<input  hx-post='/reports' hx-target='#main' hx-trigger="change" hx-include=".includere"   type='datetime-local' name='initDate' <?php if ($initDate) echo "value='$initDate'" ?> class="p-4 includere text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"> <br>
    <label for="endDate">Fecha Máxima: </label>
	<input  hx-post='/reports' hx-target='#main' hx-trigger="change" hx-include=".includere"   type='datetime-local' name='endDate' <?php if ($endDate) echo "value='$endDate'" ?> class="p-4 includere text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><br>
    <label for="zone">Zona: </label>
    <select form="repform" hx-post='/reports' hx-target='#main' hx-trigger="change" hx-include=".includere"   name="zone" class="includere block py-2.5 px-0 text-sm text-gray-500 bg-transparent border-blue border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
        <option value=''></option>
      <?php
      foreach($zones as $tzone=>$zoneID){ ?>
        <option value='<?=$zoneID?>' <?php if ($zoneID===intval($zone)) echo " selected" ?> >
          <?=$tzone?> 
        </option>
      <?php } ?>
    </select><br>
    <label for="origin">Origen: </label>
    <select  hx-post='/reports' hx-target='#main' hx-trigger="change" hx-include=".includere" form="repform"  name="origin" class="includere block py-2.5 px-0 text-sm text-gray-500 bg-transparent border-blue border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
        <option value=''></option>
        <option value='cama' <?php if ("cama"===$origin) echo " selected" ?>>cama</option>
        <option value='baño' <?php if ("baño"===$origin) echo " selected" ?>>baño</option>
        <option value='otro' <?php if ("otro"===$origin) echo " selected" ?>>otro</option>
    </select><br>
    <label for="medic">Medico ID: </label>
    <input hx-post='/reports' hx-target='#main' hx-trigger="change" hx-include=".includere"  type="number" name="medic" <?php if ($medic) echo "value='$medic'" ?> class="p-4 includere text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"><br>
	<button class="bg-blue-400 inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-blue-500 mt-4 mt-0 ml-20">Buscar</button><br>
</form> 

<div class="flex content-center justify-center border">
<div id="report" class="content-center">
    <h2>Reporte de Hospital</h2>
    <?php if ($showMedicName){ ?>
    <h3><?=$medicdata["nombre"]?> <?=$medicdata["apellido"]?></h3>
    <?php } ?>
    <br>
    <br>
    <span>Llamadas Atendidas: <?=$amountdata?></span><br>
    <span>Tiempo Promedio de Respuesta: <?=$avgdata*60/10000?> minutos</span><br><br>
    <span>Llamadas por Nivel de Emergencia</span><br>
    <table border=1>
        <tr>
            <th>Nivel</th>
            <th>Llamadas</th>
        </tr>
        <?php foreach($perLevels as $key=>$name){ ?>
        <tr>
            <th><?=$key?></th>
            <td><?=$name?></td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <span>Llamadas por zona</span><br>
    <table border=1>
        <tr>
            <th>Zona</th>
            <th>Llamadas</th>
        </tr>
        <?php foreach($perZones as $key=>$name){ ?>
        <tr>
            <th><?=$key?></th>
            <td><?=$name?></td>
        </tr>
        <?php } ?>
    </table>
    <br>
    <span>Llamadas por Origen</span><br>
    <table border=1>
        <tr>
            <th>Origen</th>
            <th>Llamadas</th>
        </tr>
        <?php foreach($perOrigins as $key=>$name){ ?>
        <tr>
            <th><?=$key?></th>
            <td><?=$name?></td>
        </tr>
        <?php } ?>
    </table>
</div>
</div>

<div>
    <button class="bg-blue-400 inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-blue-500 mt-4 mt-0 ml-20" onclick="
          let mywindow = window.open('', 'PRINT', 'height=650,width=900,top=100,left=150');
            mywindow.document.write(`<html><head><title>${title}</title>`);
            mywindow.document.write('</head><body >');
            mywindow.document.write(document.getElementById('report').innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
    ">PDF</button>
</div>

