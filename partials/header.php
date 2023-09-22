<header class="flex items-center justify-between flex-wrap bg-blue-600 p-6">
  <div class="flex items-center flex-shrink-0 text-white mr-6">
    <svg class="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54" xmlns="http://www.w3.org/2000/svg"><path d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/></svg>
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
      <a href="#responsive-header" class=" inline-block mt-0 text-teal-200 hover:text-white mr-4">
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