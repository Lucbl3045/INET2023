<section id="main">
  <div class="flex flex-col items-center justify-center px-3 py-3 mx-auto h-screen">
    <div class="w-full bg-white rounded-lg shadow mt-0 max-w-md">
      <div class="p-6 space-y-4 p-8">
        <div id="errors"></div>
        <div class="flex items-center justify-center">
          <img class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" src="img/azul.png" >

          <p class="text-center text-3xl font-bold text-blue-600"> Código Azul</p><!--ACA VA LOGO-->
        </div>
        <h1 class="text-2xl font-bold  text-black">
                    Iniciar Sesión
        </h1>
        <form hx-target="body" hx-post="/login" class="space-y-4">
          <div>
            <label for="id" class="block mb-2 text-sm font-medium text-gray-900 ">ID del personal</label>
            <input type="number" min="0" step="1" oninput="validity.valid||(value='')" name="id" id="id_form" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-primary-600 block w-full p-2.5" placeholder="•••" required>
          </div>
          <div>
            <label for="password" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
            <input type="password" name="password" id="password"  class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:border-primary-600 block w-full p-2.5 " placeholder="••••••••" required>
          </div>

          <button type="submit" class="w-full text-white bg-blue-600 hover:bg-blue-700 rounded-lg text-sm px-5 py-2.5 text-center">Loguearse</button>
        </form>
      </div>
    </div>
  </div>
</section>