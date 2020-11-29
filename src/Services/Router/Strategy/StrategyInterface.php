<?php


namespace App\Services\Router\Strategy;


use App\Services\Router\Route;

/**
 * Interface StrategyInterface
 * @package App\Services\Router\Strategy
 */
interface StrategyInterface
{
    /**
     * @param string $request
     * @return Route
     */
    public function parseRequest(string $request): Route;

    /**
     * @param Route $route
     * @return string|null
     */
    public function getControllerClass(Route $route): ?string;

    /**
     * @param Route $route
     * @return string|null
     */
    public function getActionMethod(Route $route): ?string;
}
