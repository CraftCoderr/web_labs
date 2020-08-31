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

    protected function header(string $key, $value)
    {
        header($key.': '.$value);
    }

    protected function response(string $response, $type = null)
    {
        if ($type != null) {
            $this->header('Content-Type', $type);
        }
        echo $response;
        exit();
    }

}