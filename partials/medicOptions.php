<div class="p-6 space-y-4 p-8">

  <h1 class="text-2xl font-bold  text-black">
            Datos de Médico
  </h1>
  <div class="space-y-4">
    
    <div>
      <label for="dni" class="block mb-2 text-sm font-medium text-gray-900">DNI</label>
      <input type="number" name="dni" id="dni"  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-primary-600 block w-full p-2.5 " placeholder="••••••••" required>
    </div>
    <div>
      <label for="nombre" class="block mb-2 text-sm font-medium text-gray-900">Nombre</label>
      <input type="text" name="nombre" id="nombre"  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-primary-600 block w-full p-2.5 " placeholder="••••••••" required>
    </div>
    <div>
      <label for="apellido" class="block mb-2 text-sm font-medium text-gray-900">Apellido</label>
      <input type="text" name="apellido" id="apellido"  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-primary-600 block w-full p-2.5 " placeholder="••••••••" required>
    </div>

    <div>
      <label for="zona" class="block mb-2 text-sm font-medium text-gray-900">Zona</label>
      <select name="zona" class="block py-2.5 px-0 text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-200 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 peer">
      <?php
      foreach($zones as $zone){ ?>
        <option value='<?=$zone?>'>
          <?=$zone?> 
        </option>
      <?php } ?>
      </select>
    </div>
  </div>
</div>