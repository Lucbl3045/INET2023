<div class="w-2/3">
    <div class="bg-slate-50 rounded-xl mt-5 ml-10 p-5 border-blue-500 border w-full">
        <table class="table-fixed">
        <thead>
            <tr>
            <th class="border-b font-medium py-3.5 px-5 text-gray-800 text-left ">Paciente</th>
            <th class="border-b font-medium py-3.5 px-5 text-gray-800 text-left ">Entrada</th>
            <th class="border-b font-medium py-3.5 px-5 text-gray-800 text-left ">Salida</th>
            <th class="border-b font-medium py-3.5 px-5 text-gray-800 text-left ">Desde</th>
            <th class="border-b font-medium py-3.5 px-5 text-gray-800 text-left ">Nivel de Emergencia</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach($currentCalls as $call){ ?>
            <tr>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                    <?= $call["nombrePaciente"] ?>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                    <?= $call["tiempoDeLlamada"] ?>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                    <?= $call["tiempoDeRespuesta"] ?>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                    <?= $call["nombreDispositivo"] ?>
                </td>
                <td class="font-medium py-3.5 px-5 text-gray-700 text-left">
                    <?= $call["nivelDeEmergencia"] ?>
                </td>
            </tr>
            <?php } ?>
            
            
        </tbody>
        </table>
    </div>
</div>