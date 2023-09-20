<?php

require_once __DIR__.'/router.php';


get('/', 'controllers/index.php');

post('/user/$id', 'views/user');



get('/callback/$name', function($name){
  echo "Callback executed. The name is $name";
});








any('/404','views/404.php');
