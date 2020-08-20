<?php


namespace Core\View;


class Renderer
{

    private $viewsPath;
    private $viewExtension;

    /**
     * Renderer constructor.
     * @param $viewsPath
     */
    public function __construct($viewsPath, $viewExtension = '.view.php')
    {
        $this->viewsPath = $viewsPath;
        $this->viewExtension = $viewExtension;
    }

    public function render($view, $model = []) {
//        echo 'Rendering: '.$this->viewsPath . $view . $this->viewExtension;
        include $this->viewsPath . $view . $this->viewExtension;
    }


}