<div class="w-2/3">
    <div class="bg-slate-50 rounded-xl mt-5 ml-10 p-5 border-blue-500 border w-full">
        <table class="table-fixed">
        <thead>
            <tr>
            <th class="border-b font-medium py-3.5 px-5 text-gray-800 text-left ">Paciente</th>
            <th class="border-b font-medium py-3.5 px-5 text-gray-800 text-left ">Entrada</th>
            <th class="border-b font-medium py-3.5 px-5 text-gray-800 text-left ">Salida</th>
            <th class="border-b font-medium py-3.5 px-5 text-gray-800 text-left ">Razón</th>
            <th class="border-b font-medium py-3.5 px-5 text-gray-800 text-left ">Notas</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach($currentVisits as $visit){ ?>
            <tr>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                    <?= $visit["nombre"]." ".$visit["apellido"] ?>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                    <?= $visit["tiempoLlegada"] ?>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                    <?= $visit["tiempoSalida"] ?>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                    <?= $visit["especialidadID"] ?>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                    <?= $visit["notas"]." ".$visit["apellido"] ?>
                </td>
            </tr>
            <?php } ?>
            <?php foreach($previousVisits as $visit){ ?>
            <tr class="bg-gray-200">
                <td class="font-medium py-3.5 px-5 text-gray-600 text-left">
                    <?= $visit["nombre"]." ".$visit["apellido"] ?>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-600 text-left">
                    <?= $visit["tiempoLlegada"] ?>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-600 text-left">
                    <?= $visit["tiempoSalida"] ?>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-600 text-left">
                    <?= $visit["especialidadID"] ?>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-600 text-left">
                    <?= $visit["notas"]." ".$visit["apellido"] ?>
                </td>
            </tr>
            <?php } ?>
            
        </tbody>
        </table>
    </div>
</div>