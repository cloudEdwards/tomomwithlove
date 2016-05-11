<?php


function router() {
    $routes = get_routes();
    $name = '';

    if (empty($routes)) {
        views('home');
        return;
    }
    
    switch ($routes[0]) {

        case 'send':
            send();
            break;

        case 'from':

            from($routes);
            break;

        case 'wall':

            wall();
            break;
            
        default:
            home();
            break;
    }
}


function get_routes() { 
    $base_url = getCurrentUri();
    $routes = array();
    $routes = explode('/', $base_url);
    $clean_routes = array();

    foreach($routes as $route) {
        if(trim($route) != '') {
            array_push($clean_routes, $route);
        } 
    }
    return $clean_routes;
}

/*
strip the script name from URL i.e.  http://www.something.com/search/book/fitzgerald will become /search/book/fitzgerald
*/
function getCurrentUri() {
    $basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
    $uri = substr($_SERVER['REQUEST_URI'], strlen($basepath));
    if (strstr($uri, '?')) $uri = substr($uri, 0, strpos($uri, '?'));
    $uri = '/' . trim($uri, '/');
    return $uri;
}