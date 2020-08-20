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
        $this->root->handle($request);
    }

    public function route($method, $pattern, $handler) {
        $parts = explode('/', $pattern);
        array_shift($parts);
        $current = $this->root;
        $count = count($parts);
        for ($i = 0; $i < $count; $i++) {
            $next = null;
            if (preg_match('({([a-zA-Z]+)})', $parts[$i], $m)) {
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
                $next = $current->getChild($parts[$i]);
                if ($next == null) {
                    $next = new Route();
                    $current->addChild($next, $parts[$i]);
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
    }


}