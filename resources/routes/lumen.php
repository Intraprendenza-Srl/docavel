<?php

/** @var Laravel\Lumen\Routing\Router $router */

//This is the route for the documentation info page.
$router->get('info', [function () { return view('docavel::partials.info'); }, 'as' => 'info']);

//This is the route for the root documentation view page.
$router->get('', [function () { return view('docavel::documentation'); }, 'as' => 'root']);
