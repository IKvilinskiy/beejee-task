<?php


namespace App\Services\Router;


use App\Services\Router\Strategy\StrategyInterface;
use App\Services\ServiceContainer;

/**
 * Class HttpRouter
 * @package App\Services\Router
 */
class HttpRouter implements RouterInterface
{
    const DEFAULT_CONTROLLER = 'default';
    const DEFAULT_ACTION = 'index';

    /**
     * @var StrategyInterface
     */
    private StrategyInterface $strategy;

    /**
     * HttpRouter constructor.
     * @param StrategyInterface $strategy
     */
    public function __construct(StrategyInterface $strategy)
    {
        $this->strategy = $strategy;
    }

    /**
     * @throws \Exception
     */
    public function run(): void
    {
        $route = $this->strategy
            ->parseRequest($_SERVER['REQUEST_URI']);

        if ($route->getControllerName() === null)
            $route->setControllerName(self::DEFAULT_CONTROLLER);

        if ($route->getActionName() === null)
            $route->setActionName(self::DEFAULT_ACTION);

        $controllerClassName = $this->strategy->getControllerClass($route);
        $methodName = $this->strategy->getActionMethod($route);

        if (
            !$controllerClassName
            || !$methodName
            || !class_exists($controllerClassName)
            || !method_exists($controllerClassName, $methodName)
        ) {
            throw new \Exception('Page not found', 404);
        }

        $controller = new $controllerClassName(ServiceContainer::getInstance()->getRenderer());

        $controller->$methodName();
    }
}
