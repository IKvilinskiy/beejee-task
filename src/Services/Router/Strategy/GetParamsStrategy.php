<?php


namespace App\Services\Router\Strategy;


use App\Services\Router\Route;

/**
 * Class GetParamsStrategy
 * @package App\Services\Router\Strategy
 */
class GetParamsStrategy implements StrategyInterface
{
    /**
     * @param string $request
     * @return Route
     */
    public function parseRequest(string $request): Route
    {
        $url = parse_url($request);
        $query = [];

        if (isset($url['query'])) parse_str($url['query'], $query);

        return new Route(
            $query['controller'] ?? null,
            $query['action'] ?? null
        );
    }

    /**
     * @param Route $route
     * @return string|null
     */
    public function getControllerClass(Route $route): ?string
    {
        if (($controller = $route->getControllerName()) != null) {
            return 'App\\Controllers\\'
                . $this->convertRouteParamToCamelCase($controller)
                . 'Controller';
        }

        return null;
    }

    /**
     * @param Route $route
     * @return string|null
     */
    public function getActionMethod(Route $route): ?string
    {
        if (($method = $route->getActionName()) != null) {
            return 'action'
                . $this->convertRouteParamToCamelCase($method);
        }

        return null;
    }

    /**
     * @param string $str
     * @return string
     */
    private function convertRouteParamToCamelCase(string $str): string
    {
        $routeParam = '';

        foreach (explode('-', $str) as $item)
            $routeParam .= ucfirst($item);

        return $routeParam;
    }
}
