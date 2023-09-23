## Escritorio para INET

  
Requiere habilitado el override por htaccess si se está usando apache o una mimica de esas reglas si es nginx. Ejemplo de vHost apache:
```
<VirtualHost *:80>
    ServerAdmin contact@localhost
    DocumentRoot "/srv/inet"
    ServerName inet.ejemplo.ar
    ServerAlias inet.localhost
    <Directory "/srv/inet">
        AllowOverride All
    </Directory>
    Options FollowSymLinks
</VirtualHost>
```

Pasos de configuración:
 - Se debe importar la base de datos a una instancia de MYSQL aparte.  
 - Hay que tener composer instalado y ejecutar `composer install` en el  directorio del proyecto.
 - Hay que renombrar el archivo `.env_example` a `.env` y ingresar ahí las credenciales correctas





