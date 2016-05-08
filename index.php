<?php

$env = 'local';

$GLOBALS['ENV'] = $env;
$GLOBALS['BASE_URL'] = $env == 'local' ? 'localhost/tomomwithlove' : 'tomomwith.love';
$GLOBALS['SUB_DOM'] = $env == 'local' ? '/tomomwithlove' : '';
$GLOBALS['ENV_NAME'] = $env == 'local' ? '-local' : '';

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
            send();
            break;

        case 'from':

            from($routes);
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

function from($routes) {
    $name = ! empty($routes[1]) ? ucfirst(urldecode($routes[1])) : "";
    $name_id = ! empty($routes[2]) ? ucfirst(urldecode($routes[2])) : 1;

    $results = mysqlQuery('get-text', 'messages',
        array(
            'name_id' => $name_id, 
            'name' => $name, 
        )
    );

    $text = $results['text'];
    views('card', array('name' => $name, 'text' => $text));
}

function send() {
    if (empty($_POST)) {
        views('send', array('link' =>'cloud')); 
        return;
    }
    $post_name = ! empty($_POST['name']) ? ucfirst($_POST['name']) : "";
    $text = ! empty($_POST['text']) ? $_POST['text'] : "";
    $privacy = ! empty($_POST['privacy']) ? $_POST['privacy'] : "";

    $name_id = saveMessage($post_name, $text, $privacy);

    $link = $name_id > 1 ? $post_name."/".$name_id : $post_name; 

    views('send', array('link' => $link)); 
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

function saveMessage($name, $text, $privacy) {
    $name_id = getNameId($name);

    mysqlQuery('save-message', 'messages',
        array(
            'name_id' => $name_id, 
            'name' => $name, 
            'text' => $text, 
        )
    );

    return $name_id;
}

function getNameId($name) {
    $results = mysqlQuery('count-names', 'messages', array('name' => $name));

    return intval($results['name_id']) + 1;
}

function mysqlQuery($query, $table, $data){
    $servername = 'localhost';
    $username = "wp";
    $password = "wp";
    $dbname = "tomomwithlove";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $data_clean = array();
    foreach ($data as $key => $value) {
        $data_clean[$key] = $conn->real_escape_string($value);
    }


    // Check connection
    if ($conn->connect_error) {
        return "Connection failed: " . $conn->connect_error;
    } 

    $columns = '';
    $values = '';
    $sql = '';

    switch ($query) {
        case 'save-message':
            foreach ($data_clean as $key => $value) {
                $columns .= $key.", ";
                $values .= "'".$value."', ";
            }
            $columns = "(".substr($columns, 0, -2).")";
            $values = "(".substr($values, 0, -2).")";
            $sql = "INSERT INTO ".$table." ".$columns." VALUES ".$values;
            break;
        
        case 'count-names':
            $sql = "SELECT `name_id` FROM ".$table." WHERE `name` = '".$data_clean['name']
            ."' ORDER BY `name_id` DESC LIMIT 1";
            break;

        case 'get-text':
            $sql = "SELECT text FROM ".$table." WHERE `name` = '".$data_clean['name']
            ."' AND `name_id` = ".$data_clean['name_id'];
            break;

        default:
            break;
    }
    
    $results = $conn->query($sql);

    if ($results !== true) {
        return $results->fetch_assoc();
    } else {
        // echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();

}