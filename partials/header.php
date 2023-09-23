<header class="flex items-center justify-between flex-wrap bg-blue-600 p-6">
  <div class="flex items-center flex-shrink-0 text-white mr-6">
    <img class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" src="img/blanco.png" >
    <span class="font-semibold text-xl tracking-tight">Código Azul</span>
  </div>

  <div class=" flex-grow flex items-center w-auto">
    <div class="text-sm flex-grow">
      <a hx-post="/calls" hx-target="#main" class="cursor-pointer  inline-block  text-teal-200 hover:text-white mr-4">
        Alertas
      </a>
      <?php if ($_SESSION["isAdmin"]){ ?>
      <a hx-post="/admin" hx-target="#main" class="cursor-pointer inline-block mt-0 text-teal-200 hover:text-white mr-4">
        Administración
      </a>
      <a hx-post="/registerform" hx-target="#main" class="cursor-pointer inline-block mt-0 text-teal-200 hover:text-white mr-4">
        Creación de Usuarios
      </a>
      <a hx-post="/reports" hx-target="#main" class=" inline-block mt-0 text-teal-200 hover:text-white mr-4">
        Reportes
      </a>
      <?php } ?>
    </div>
    <div>
      <a hx-post='/logout' hx-target="body" class="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 mt-0">Cerrar Sesión</a>
    </div>
  </div>
</header>
<section id="main">