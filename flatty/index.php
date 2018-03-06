<?php

// Flatty Loader, by Kalan Brock @ The Biggest Nerd
// We love hacky projects! Give us a shout, I'm probably awake. - kalan@thebiggestnerd.com

function __autoload($class)
{
    $parts = explode('\\', $class);
    require end($parts) . '.php';
}

use Flatty\FlattyAPI;

if (!array_key_exists('HTTP_ORIGIN', $_SERVER))
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];

try {
    $api = new FlattyAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $api->processAPI();
} catch (Exception $e) {
    echo json_encode(array('error' => $e->getMessage()));
}

// yep, that't it :)

