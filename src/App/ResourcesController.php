<?php


namespace App;


use Core\Files;

class ResourcesController
{

    public function uploaded($id) {
        $filename = Files::uploaded($id);
        if (file_exists($filename)) {
            $handle = fopen($filename, 'r');
            header("Content-Type: image");
            header("Content-Length: " . filesize($filename));
            fpassthru($handle);
        }
        exit();
    }

}