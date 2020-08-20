<?php


namespace Core\Routing;


class ParametrizedRoute extends Route
{

    private $parameterName;

    /**
     * ParametrizedRoute constructor.
     * @param $parameterName
     */
    public function __construct($parameterName)
    {
        parent::__construct();
        $this->parameterName = $parameterName;
    }


    public function handle(Request $request, $path = null)
    {
        if ($path == null) {
            throw new \Exception('Path parameter '.$this->parameterName.' not found in request.');
        }
        $request->set($this->parameterName, $path);
        parent::handle($request);
    }

    /**
     * @return mixed
     */
    public function getParameterName()
    {
        return $this->parameterName;
    }


}