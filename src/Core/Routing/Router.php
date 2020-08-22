<?php


namespace Core\Routing;


class Router
{

    private $methods = ['GET', 'HEAD', 'POST', 'PUT', 'DELETE', 'CONNECT', 'OPTIONS', 'TRACE', 'PATCH'];

    /**
     * @var Route
     */
    private $root;

    public function __construct()
    {
        $this->root = new Route();
    }


    public function handle(Request $request) {
        try {
            $this->root->handle($request);
        } catch (RouteNotFound $e) {
            global $config;
            if ($config['debug']) {
                throw $e;
            } else {
                http_response_code(404);
                echo "NOT FOUND";
                // handle not found 404
            }
        }
    }

    public function route($method, $pattern, $handler) : self {
        $parts = explode('/', $pattern);
        array_shift($parts);
        $current = $this->root;
        $count = count($parts);
        for ($i = 0; $i < $count; $i++) {
            $next = null;
            $part = $parts[$i] != '' ? $parts[$i] : '/';
            if (preg_match('({([a-zA-Z]+)})', $part, $m)) {
                $parameterName = $m[1];
                $next = $current->getChild();
                if ($next == null) {
                    $next = new ParametrizedRoute($parameterName);
                    $current->addChild($next);
                } else {
                    if ($next instanceof ParametrizedRoute) {
                        if ($next->getParameterName() != $parameterName) {
                            throw new RouteAlreadyExists('Route with parameter '.$next->getParameterName().' exists on same path: '.$pattern);
                        }
                    }
                }
            } else {
                $next = $current->getChild($part);
                if ($next == null) {
                    $next = new Route();
                    $current->addChild($next, $part);
                }
            }
            $current = $next;
        }

        $leaf = $current->getChild();
        if ($leaf == null) {
            $leaf = new Route();
            $current->addChild($leaf);
        }
        $method = strtoupper($method);
        if (in_array($method, $this->methods)) {
            $leaf->addChild(new Route($handler), $method);
        } else {
            $leaf->addChild(new Route($handler));
        }
        return $this;
    }


}