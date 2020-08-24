<?php


namespace Core;


class Controller
{

    protected function render($view, $model = []) {
        global $renderer;
        $renderer->render($view, $model);
        exit();
    }

    protected function redirect($path)
    {
        header('Location: ' . $path);
        exit();
    }

}