<?php

router();

function router() {
    $routes = get_routes();
    $name = '';

    if (empty($routes)) {
        views('home');
        return;
    }
    
    switch ($routes[0]) {

        case 'send':
            $post_name = ! empty($_POST['name']) ? ucfirst($_POST['name']) : "";
            views('send', array('name' => $post_name));
            break;

        case 'from':
            $name = ! empty($routes[1]) ? ucfirst($routes[1]) : "";
            views('card', array('name' => $name));
            break;
            
        default:
            views('home');
            break;
    }
}

function views ($file, $data = array()) {
    include "views/partials/header.php";
    // include "views/partials/menu.php";

    include "views/".$file.".php";

    include "views/partials/footer.php";
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