<?php

require_once __DIR__.'/router.php';


get('/', 'controllers/index.php');

post('/registerform', 'controllers/registerform.php'); //PARA PROBAR, BORRAR DESPUES
post('/login', 'controllers/login.php');
post('/logout', 'controllers/logout.php');
post('/register', 'controllers/register.php');
post('/calls', 'controllers/calls.php');
post('/admin', 'controllers/admin.php');
post('/editrow/$table/$id', 'controllers/editrow.php');
post('/deleterow/$table/$id', 'controllers/deleterow.php');
post('/resetrow/$table/$id', 'controllers/resetrow.php');
post('/changerow/$table/$id', 'controllers/changerow.php');

post('/medicOptions', 'controllers/medicOptions.php');
post('/empty', 'partials/empty.php');

post('/user/$id', 'views/user');



get('/callback/$name', function($name){
  echo "Callback executed. The name is $name";
});








any('/404','views/404.php');
