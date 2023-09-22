<section id="main">
  <form hx-target="#main" hx-post="/register" class="flex flex-row items-center justify-center px-3 py-3 mx-auto h-screen">
    <div class="w-full bg-white rounded-lg shadow mt-0 max-w-md">
      <div class="p-6 space-y-4 p-8">

        <h1 class="text-2xl font-bold  text-black">
                    Creación de Usuarios
        </h1>
        <div class="space-y-4">
          
          <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
            <input type="password" name="password" id="password"  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-primary-600 block w-full p-2.5 " placeholder="••••••••" required>
          </div>
          
          <div >
            <label for="isAdmin" class="block mb-2 text-sm font-medium text-gray-900">Es Admin?</label>
            <div class="flex flex-row">
              <div class="flex flex-row p-2">
                <label for="isAdmin" class="p-1">Si</label>
                <input hx-post="empty" hx-target="#medicOptions" value=1 type="radio" name="isAdmin" id="isAdmin"  class=" text-left  bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-primary-600 block  p-2.5 " required selected value=1>
              </div>
              <div class="flex flex-row p-2">
                <label for="isNotAdmin" class="p-1">No</label>
                <input hx-post="medicOptions" hx-target="#medicOptions" value=0 type="radio" name="isAdmin" id="isNotAdmin"  class="text-left  bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-primary-600 block  p-2.5 " required value=0>
              </div>
            </div>
          </div>

          <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 rounded-lg text-sm px-5 py-2.5 text-center">Crear Usuario</button>
        </div>
      </div>
      
    </div>
    <div id="medicOptions" class="w-full bg-white rounded-lg shadow mt-0 max-w-md mx-5">
      
      
    </div>
  </form>
</section>