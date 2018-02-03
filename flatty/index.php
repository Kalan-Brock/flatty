<?php

// Flatty API Handler, by Kalan Brock @ The Biggest Nerd

function __autoload($class)
{
    $parts = explode('\\', $class);
    require end($parts) . '.php';
}

use Flatty\FlattyAPI;

$config = new \Flatty\FlattyConfig();
$api = new FlattyAPI($config);

// yep, that't it :)

