<?php

function saveMessage($name, $text, $privacy) {
    $name_id = getNameId($name);
    $columns = '';
    $values = '';
    $sql = '';

    $data = array(
        'name_id' => $name_id, 
        'name' => $name, 
        'text' => $text, 
        'privacy' => $privacy, 
    );

    $data = mysqlRealCleanString($data);
    foreach ($data as $value) {
        $values .= "'".$value."', ";
    }

    $values = "(".substr($values, 0, -2).")";
    $sql = "INSERT INTO messages (name_id, name, text, privacy) VALUES ".$values;

    mysqlQuery($sql);

    return $name_id;
}

function getMessageSingle($name_id, $name) {
    mysqlRealCleanString(array($name_id, $name));
    $sql = 'SELECT text FROM messages WHERE `name` = "'.$name
    .'" AND `name_id` = "'.$name_id.'"';
    $results = mysqlQuery($sql);

    return ! empty($results[0]['text']) ? $results[0]['text'] : false;
}

function getMessages() {
    $sql = 'SELECT `text` FROM messages WHERE `privacy` = "public" OR `privacy` = ""  ORDER BY `id` DESC LIMIT 1000';
    $results = mysqlQuery($sql);

    return ! empty($results) ? $results : false;    
}

function getNameId($name) {
    mysqlRealCleanString(array($name));
    $sql = "SELECT `name_id` FROM messages WHERE `name` = '".$name
    ."' ORDER BY `name_id` DESC LIMIT 1";
    $results = mysqlQuery($sql);

    return is_array($results) ? intval($results[0]['name_id']) + 1 : 1;    
}



