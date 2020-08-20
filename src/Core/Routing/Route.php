<?php


namespace Core\Routing;


use Exception;

class Route
{

    protected $routes;
    protected $handler;

    public function __construct($handler = null)
    {
        $this->handler = $handler;
        $this->routes = [];
    }


    public function handle(Request $request, $path = null)
    {
        $childPath = $request->popPath();
        if ($childPath == null) {
            if ($this->handler != null) {
                $handler = $this->handler;
                if (isset($handler)) {
                    $handler($request);
                    return;
                }
            } else {
                $childPath = $request->method;
            }
        }
        if (array_key_exists($childPath, $this->routes)) {
            $this->routes[$childPath]->handle($request);
            return;
        }
        if (array_key_exists('/', $this->routes))
        {
            $this->routes['/']->handle($request, $childPath);
            return;
        }
        throw new RouteNotFound("Route not found!");
    }

    public function getChild($path = '/') {
        return $this->routes[$path];
    }

    public function addChild($route, $path = '/') : bool
    {
        if (array_key_exists($path, $this->routes)) {
            return false;
        }
        $this->routes[$path] = $route;
        return true;
    }

}