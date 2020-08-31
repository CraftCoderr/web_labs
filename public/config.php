<?php

$config = [
    'debug' => false,
    'database' => [
        'host' => 'mysql',
        'name' => 'dev',
        'user' => 'root',
        'password' => 'secret'
    ],
    'files' => dirname(__DIR__) . '/files/',
    'root' => __DIR__,
];

if (!defined("PATH_SEPARATOR"))
    define("PATH_SEPARATOR", getenv("COMSPEC")? ";" : ":");
ini_set("include_path", ini_get("include_path").PATH_SEPARATOR.dirname(__FILE__));
