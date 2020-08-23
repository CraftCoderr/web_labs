<?php


namespace Core;


class Files
{

    public static function file($name)
    {
        global $config;
        $filename = $config['files'] . $name;
        return $filename;
    }


}