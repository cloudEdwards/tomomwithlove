<?php

function views ($file, $data = array()) {
    include "views/partials/header.php";
    // include "views/partials/menu.php";

    include "views/".$file.".php";

    include "views/partials/footer.php";
}

function home() {
    views('home');
}

function from($routes) {
    $name = ! empty($routes[1]) ? ucfirst(urldecode($routes[1])) : "";
    $name_id = ! empty($routes[2]) ? ucfirst(urldecode($routes[2])) : 1;

    $text = getMessageSingle($name_id, $name);
    views('card', array('name' => $name, 'text' => $text));
}

function wall() {
    $messages = getMessages();
    views('wall', array('messages' => $messages));
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