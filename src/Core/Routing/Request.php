<?php


namespace Core\Routing;


class Request
{
    private $path;
    private $fullPath;
    private $parameters;
    private $form;
    public $method;

    /**
     * Request constructor.
     * @param $fullPath
     */
    public function __construct($fullPath)
    {
        $this->fullPath = $fullPath;
        $this->path = explode('/', $fullPath);
        array_shift($this->path);
        $this->method = $_SERVER['REQUEST_METHOD'];
    }


    public function popPath()
    {
        return array_shift($this->path);
    }

    public function set($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    public function get($key)
    {
        return $this->parameters[$key];
    }

    public function attributes() {
        return $_GET;
    }

    public function form() {
        if ($this->form == null) {
            $this->form = $_POST;
        }
        return $this->form;
    }

}